<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fees extends CI_Controller
{

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
		//echo $this->main_model->checkoldsys("07-4-00357");
		//echo $this->main_model->updateacctno();
		$this->load->view('templates/header');
        $this->load->view('fees');
		$this->load->view('templates/footer');


	}
	public function searchs()
	{
		$searchtext = $_GET['searchtext'];
		echo $this->main_model->searchstudent($searchtext);
	}
	public function getsy()
	{
		echo $this->main_model->getsy();
	}
	public function searchinfo()
	{
		$id = $_GET['id'];
		$acctno = $_GET['acctno'];
		$sy = $_GET['sy'];
		$sem = $_GET['sem'];
		echo $this->main_model->searchinfo($id,$sem,$sy,$acctno);
	}
	public function checkoldsys()
	{
		$id = $_GET['id'];
		echo $this->main_model->checkoldsys($id);
	}
	public function assess()
	{
		$id = $_GET['id'];
		$sy = $_GET['sy'];
		$sem = $_GET['sem'];
		$stat = $_GET['stat'];
    if ($stat=="transferee") {
      $stat="new";
    } elseif ($stat=="returnee") {
      $stat="old";
    }

		$course = $_GET['course'];
		$totalunit = $_GET['totalunit'];
		$labunit = $_GET['labunit'];
		$graduating = $_GET['graduating'];
		echo $this->main_model->assess($id,$sy,$sem,$stat,$course,$totalunit,$labunit,$graduating);
	}
	public function loadassess()
	{
		$id = $_GET['id'];
		$sy = $_GET['sy'];
		$sem = $_GET['sem'];
		echo $this->main_model->loadassess($id,$sy,$sem);
	}
	public function getStudentTuition()
	{
		$id = $_GET['id'];
		$sy = $_GET['sy'];
		$sem = $_GET['sem'];
		echo $this->main_model->getStudentTuition($id,$sy,$sem);

	}
	public function addAllDiscounts()
	{
		$removeOthers = $_GET['others'];
		$id = $_GET['id'];
		$syId = $_GET['syId'];
		$semId = $_GET['semId'];
		echo json_encode($removeOthers);
		if($removeOthers=='true'){
			echo json_encode($this->main_model->removeOthers($id,$syId,$semId));
		}
		$data = $_GET['discounts'];

		$returned = $this->main_model->insertBatchDiscounts($data,$id,$syId,$semId);

		return json_encode($returned);
	}
	public function removeDiscounts()
	{
		$id = $_GET['id'];
		$syId = $_GET['syId'];
		$semId = $_GET['semId'];
		echo json_encode($this->main_model->removeDiscounts($id,$syId,$semId));
	}
	public function generate(){
		$id = " AND stud_sch_info.ssi_id = '".$_GET['id']."'";
		$sy = $_GET['sy'];
		$sem = $_GET['sem'];
		$level = $_GET['level'];
		echo $this->main_model->generate($id,$sy,$sem,$level);
	}
  public function updateflow()
	{
		$id = $_GET['id'];
		echo $this->main_model->updateflow($id);
	}
}
