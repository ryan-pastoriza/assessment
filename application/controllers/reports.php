<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

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
		$data['sched'] = $this->main_model->getsched();
		$data['syId'] = $this->main_model->getsyid();
        $this->load->view('templates/header');
        $this->load->view('reports',$data);
        $this->load->view('templates/footer');
	}
	public function logout(){
		$this->session->unset_userdata('user');
        redirect('login');
	}
	public function create(){
		$data['sched'] = $this->main_model->getsched();
		$data['syId'] = $this->main_model->getsyid();
		$this->form_validation->set_rules('month', 'Month', 'required');
		$this->form_validation->set_rules('year', 'Year', 'required');
		$this->form_validation->set_rules('percent', 'Percent', 'required');
		$this->form_validation->set_rules('term', 'Term', 'required');
		$this->form_validation->set_rules('sy', 'SY', 'required');
		$this->form_validation->set_rules('sem', 'Sem', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			$this->index();
		}
		else
		{
			$this->main_model->savesched();
			redirect("reports");
		}
	}
	public function generate(){
		$id = "";
		$sy = $_GET['sy'];
		$sem = $_GET['sem'];
		$level = $_GET['level'];
		echo $this->main_model->generate($id,$sy,$sem,$level);
	}
	public function delete($id){
		$this->main_model->deletesched($id);
		$this->index();
	}

}

