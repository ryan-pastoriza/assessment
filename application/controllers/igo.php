<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Igo extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('main_model');
        if (!$this->session->userdata('user'))
        {
            redirect("login");
        }
	}

	public function index()
	{
        $this->load->view('templates/header');
        $this->load->view('admin/igo');
        $this->load->view('templates/footer');
	}
	public function logout(){
		$this->session->unset_userdata('user');
        redirect('login');
	}

}

