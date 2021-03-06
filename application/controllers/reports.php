<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

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
		    $data['sched'] = $this->main_model->getsched();
		    $data['syId'] = $this->main_model->getsyid();
        $this->load->view('templates/header');
        $this->load->view('reports',$data);
        $this->load->view('templates/footer');
	}
	public function create(){
    $ses=$this->session->userdata('user');
    $user=$ses->userRole;
    $this->model->logs($user,"create schedule");
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
  public function transfercollection(){
		$month = $_GET['month'];
		$year = $_GET['year'];
		echo $this->main_model->transfercollection($month,$year);
	}
  public function transoldtodaily(){
		$month = $_GET['month'];
		$year = $_GET['year'];
		echo $this->main_model->transoldtodaily($month,$year);
	}
  public function generatecollection(){
		$month = $_GET['month'];
		$year = $_GET['year'];
		echo $this->main_model->generatecollection($month,$year);
	}
  public function delete($id){
    $ses=$this->session->userdata('user');
    $user=$ses->userRole;
    $this->model->logs($user,"delete schedule");
		$this->main_model->deletesched($id);
		$this->index();
	}

}
