<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fees2 extends CI_Controller
{

    function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('model');
        if (!$this->session->userdata('user'))
        {
            redirect("login");
        }
	}
	public function index()
	{
		$this->load->view('templates/header');
    $this->load->view('fees2');
		$this->load->view('templates/footer');

    //echo $this->model->getStudload("23935","misc");
	}
	public function logout()
	{
		$this->session->unset_userdata('user');
        redirect('login');
	}
	public function searchs()
	{
		$searchtext = $_GET['searchtext'];
		echo $this->model->searchstudent($searchtext);
	}
	public function getsy()
	{
		echo $this->model->getsy();
	}
	public function searchinfo()
	{
		$ssi_id = $_GET['id'];
		$acctno = $_GET['acctno'];
		$sy = $_GET['sy'];
		$sem = $_GET['sem'];
		echo $this->model->searchinfo($ssi_id,$sem,$sy,$acctno);
	}

}
