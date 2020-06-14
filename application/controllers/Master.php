<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	public function index()
	{ 
		if ($this->Admin_model->verifyUser()) {
			redirect(base_url(), 'auto');
		} 
	}
	public function district()
	{	
		if ($this->Admin_model->verifyUser()) {

				$data["district"] = $this->Master_model->getdistrict();
				$this->load->view('header');
				$this->load->view('menu');
				$this->load->view('master/district', $data);
				$this->load->view('footer');	
		}	
	}
}
