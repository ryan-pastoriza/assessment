<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('main_model');
    $this->load->model('model');
        if (!$this->session->userdata('user'))
        {
            redirect("login");
        }
	}

	public function index()
	{
        $this->load->view('templates/header');
        $this->load->view('dashboard');
        $this->load->view('templates/footer');
	}
	public function logout($id){
    $ses=$this->session->userdata('user');
    $user=$ses->userRole;
    $this->model->logs($user,"logout");
		$this->main_model->updatestatus($id,"Offline");
		$this->session->unset_userdata('user');
        redirect('login');
	}

}
