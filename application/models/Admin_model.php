<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }

        protected function generateSalt() {
                $salt = "xiORG17N6ayoEn6X3";
                return $salt;
        }

        protected function generateVerificationKey() {
                $length = 10;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
        }

        public function getUserIP() {
		    $ipaddress = '';
		    if (isset($_SERVER['HTTP_CLIENT_IP']))
		        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		    else if(isset($_SERVER['HTTP_X_FORWARDED']))
		        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		    else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
		        $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
		    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
		        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		    else if(isset($_SERVER['HTTP_FORWARDED']))
		        $ipaddress = $_SERVER['HTTP_FORWARDED'];
		    else if(isset($_SERVER['REMOTE_ADDR']))
		        $ipaddress = $_SERVER['REMOTE_ADDR'];
		    else
		        $ipaddress = 'UNKNOWN';
		    return $ipaddress;
       }
       
        public function getPermDDOId($user_id=null) {
            $sql = "SELECT d.perm_ddo_id,d.field_dept_cd,d.office_name,d.dept_code,f.field_dept_desc 
            FROM ddo_mast d LEFT JOIN
            field_dept  f ON f.field_dept_cd=d.field_dept_cd and f.adm_dept_cd=d.dept_code 
            WHERE d.trea_code || d.ddo_code = '".$this->db->escape(strip_tags($user_id))."' AND d.field_dept_cd IS NOT NULL AND d.perm_ddo_id IS NOT NULL";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return array();
            }
        }

        public function adminLogin($postData) {
            if (!isset($postData["usertype"])) { return 2; }
        	if (!isset($postData["username"])) { return 2; }
            if (!isset($postData["password"])) { return 2; }
            $loginType = $postData["usertype"];
            $username = $this->db->escape(strip_tags(strtoupper($postData["username"])));
            $password = $this->db->escape(strip_tags(md5($postData["password"])));
            if($loginType=='D' || $loginType=='T' || $loginType=='MD' || $loginType=='AG'){
            $sql = "SELECT password,pass_confirm,role,oper_flag FROM bds_users WHERE user_id = $username 
                    AND (password = $password OR pass_confirm = $password) AND oper_flag <> 'N'";
                    $table ='bds_users';
                    $user_id = 'user_id';
            } else if ($loginType=='E'){
                $sql = "SELECT eis_pass as password,role,oper_flag FROM eis_users WHERE emp_cd = $username 
                    AND eis_pass=$password";
                    $table ='eis_users';
                    $user_id = 'emp_cd';
            }
            error_log($sql);
        	$query = $this->db->query($sql);
        	if ($query->num_rows() > 0) {
                $q = $query->row();
                $passwd = $q->password;
                if ($loginType !='E'){
                    $pass_confirm = $q->pass_confirm;
                }
                $role = $q->role;
                $this->session->set_userdata("sess_lg_login",$username);
                $this->session->set_userdata("sess_loginType",$loginType);
                if($role == '3')
                {
                    $permddo = $this->getPermDDOId($username);
                    $app_type="DE";  
                    if($password == $passwd)
                    {
                        $appRole = 'A';
                        $welcome_str = 'Welcome DDO-Assistant : '.$permddo->office_name;
                    }
                    elseif($pass_confirm == $passwd)
                    {
                        $appRole = 'D';
                        $welcome_str = 'Welcome DDO : '.$permddo->office_name;
                    }
                    $perm_ddo_id = $permddo->perm_ddo_id;
                    $field_dept_cd = $permddo->field_dept_cd;
                    $field_dept_desc = $permddo->field_dept_desc;
                    $off_id = NULL;
                }   
                elseif($role == 'M')
                {
                    $app_type = 'MD';
                    $welcome_str = 'Welcome Master Data Controller :';
                    if($password == $passwd)
                    {
                        $appRole = 'A';
                    }
                    elseif($pass_confirm == $passwd)
                    {
                        $appRole = 'D';
                    }
                    $perm_ddo_id = NULL;
                    $field_dept_cd = NULL;
                    $field_dept_desc = NULL;
                    $off_id = NULL;
                    
                }               
                $this->session->set_userdata("appRole",$appRole);
                $this->session->set_userdata("app_type",$app_type);
                $this->session->set_userdata("sess_welcome_str",$welcome_str);
                $this->session->set_userdata("sess_perm_ddo_id",$perm_ddo_id);
                $this->session->set_userdata("sess_field_dept_code",$field_dept_cd);
                $this->session->set_userdata("sess_field_dept_desc",$field_dept_desc);
                $this->session->set_userdata("sess_off_id",$off_id);                             
        		$this->session->set_userdata("loggedin",1);
        		$ip = $this->getUserIP();
        		$sql2 = "UPDATE $table SET last_signin = NOW(), ip = ".$this->db->escape($ip)." WHERE $user_id = ".$username;
        		$this->db->query($sql2);
        		return TRUE;
        	} else {
        		return 2;
        	}
        }
        public function verifyUser() {
        	if ($this->session->userdata("sess_lg_login") && $this->session->userdata("sess_loginType") && $this->session->userdata("appRole") && $this->session->userdata("loggedin")) {
                if($this->session->userdata("appRole") != 'E'){
                    $sql = "SELECT * FROM bds_users WHERE user_id = ".$this->session->userdata("sess_lg_login");
                }else{
                    $sql = "SELECT * FROM eis_users WHERE emp_cd = ".$this->session->userdata("sess_lg_login"); 
                }
                error_log($sql);
        		$query = $this->db->query($sql);
        		if ($query->num_rows() > 0) {
        			return TRUE;
        		} else {
        			$this->logout();
        			redirect(base_url()."login", 'auto');
        		}
        	} else {
        		$this->logout();
        		redirect(base_url()."login", 'auto');
        	}
        }        
        public function logout() {
        	$this->session->unset_userdata("sess_lg_login");
        	$this->session->unset_userdata("sess_loginType");
            $this->session->unset_userdata("appRole");
            $this->session->unset_userdata("sess_welcome_str");
            $this->session->unset_userdata("app_type");
            $this->session->unset_userdata("sess_perm_ddo_id");
            $this->session->unset_userdata("sess_field_dept_code");
            $this->session->unset_userdata("sess_field_dept_desc");
            $this->session->unset_userdata("sess_off_id");
        	$this->session->unset_userdata("loggedin");
        	return TRUE;
        }

}