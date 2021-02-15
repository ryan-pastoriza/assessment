<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('main_model');
    $this->load->model('model');
    $this->load->model('chatbot');
        if ($this->session->userdata('user'))
        {

          redirect("fees");
        }
	}

	public function index()
	{
    $this->load->view('templates/header');
    $this->load->view('login');
    $this->load->view('templates/footer');
	}
	public function verify()
	{

		$this->form_validation->set_rules('username','username','required|trim');
		$this->form_validation->set_rules('password','password','required');
		if($this->form_validation->run())
		{
      $check = $this->main_model->validate();
			if ($check)
			{
				$this->session->set_userdata('user', $check);
        $this->model->logs($check->userRole,"login");
				$this->main_model->updatestatus($check->userId,"Online");
				redirect('fees2');
			}
			else
			{
				$this->session->set_flashdata('error','Invalid Username or Password');
				redirect('login');
			}
		}
		else
		{
			redirect('login');
		}

	}
	public function updatesy(){
		$sy = $_GET['sy'];
		echo $this->main_model->updatesy($sy);
	}

  public function getinfo()
  {
    $usn = $_GET['usn'];
    echo $this->chatbot->getinfo($usn);
  }

}
