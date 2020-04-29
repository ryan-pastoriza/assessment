<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Particular extends CI_Controller {

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
		$data['particulars'] = $this->main_model->getparticulars();
        $this->load->view('templates/header');
        $this->load->view('particular',$data);
        $this->load->view('templates/footer');
	}
	public function logout(){
		$this->session->unset_userdata('user');
        redirect('login');
	}
	public function getsy(){
		echo $this->main_model->getsy();
	}
  public function deleteParticular(){
    // echo json_encode($this->input->post('particularId'));
    $deleted = $this->main_model->deleteParticular($this->input->post('particularId'));
    echo json_encode($deleted);
  }
	public function create(){
		$data['users'] = $this->main_model->getusers();
		$this->form_validation->set_rules('particular', 'particular', 'required');
		$this->form_validation->set_rules('amount1', 'amount1', 'required');
		$this->form_validation->set_rules('amount2', 'amount2', 'required');
		$this->form_validation->set_rules('courseType', 'courseType', 'required');
		$this->form_validation->set_rules('feeType', 'feeType', 'required');
		$this->form_validation->set_rules('billType', 'billType', 'required');
		$this->form_validation->set_rules('studentStatus', 'studentStatus', 'required');
		$this->form_validation->set_rules('sy', 'sy', 'required');
		$this->form_validation->set_rules('sem', 'sem', 'required');
		$this->form_validation->set_rules('collection', 'collection', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			$this->index();
		}
		else
		{
			$this->main_model->saveparticular();
			redirect("particular");
		}
	}
}
