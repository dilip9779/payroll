<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{	
		$data["error"] = 0;
		if ($this->input->post()){ 
			$postData = $this->input->post();
			$auth = $this->Admin_model->adminLogin($postData); 
				if ($auth == true) {
					redirect(base_url(), "auto");
				} else {
					$data["error"] = 2;
					$this->load->view('login', $data);
				} 
		} else {
			$this->load->view('login', $data);
		}
		
	}
}
