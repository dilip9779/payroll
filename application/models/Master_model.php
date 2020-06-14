<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }
        public function getdistrict() {
            $sql = "SELECT	s.state_name_eng,d.district_code_census,d.district_name_english, d.state_code_census FROM district_mast d,state_mast s
            WHERE d.state_code_census = 24 AND d.state_code_census = s.state_code_census  AND district_code_census<>'0' ORDER BY district_code_census FOR READ ONLY";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return array();
            }
        }
}