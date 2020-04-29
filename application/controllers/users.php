<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
		$data['users'] = $this->main_model->getusers();
		//print_r($data);
        $this->load->view('templates/header');
        $this->load->view('users',$data);
        $this->load->view('templates/footer');
	}
	public function delete($id){
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
			$this->main_model->saveuser();
			redirect("users");
		}
	}
	public function update($id){
		$this->main_model->updateuser($id);
		$this->index();
	}


}

