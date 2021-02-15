<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
		$data['users'] = $this->main_model->getusers();
		//print_r($data);
        $this->load->view('templates/header');
        $this->load->view('users',$data);
        $this->load->view('templates/footer');
	}
	public function delete($id){
    $ses=$this->session->userdata('user');
    $user=$ses->userRole;
    $this->model->logs($user,"delete user");
		$this->main_model->deleteuser($id);
		redirect("users");
	}
	public function create(){
		$data['users'] = $this->main_model->getusers();
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('userrole', 'Userrole', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->index();
		}
		else
		{
      $ses=$this->session->userdata('user');
      $user=$ses->userRole;
      $this->model->logs($user,"create user");
			$this->main_model->saveuser();
			redirect("users");
		}
	}
	public function update($id){
    $ses=$this->session->userdata('user');
    $user=$ses->userRole;
    $this->model->logs($user,"update user");
		$this->main_model->updateuser($id);
		$this->index();
	}
  public function savemastercode(){
    $mastercode = $_GET['mastercode'];
		echo $this->model->savemastercode($mastercode);
	}


}
