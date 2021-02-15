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

    // echo $this->model->searchstudent("lac");
	}
	public function searchs()
	{
		$searchtext = $_GET['searchtext'];
		echo $this->model->searchstudent($searchtext);
	}
  public function searchpart()
	{
		$searchtext = $_GET['searchtext'];
    $syId = $_GET['syId'];
		$semId = $_GET['semId'];
		echo $this->model->searchpart($searchtext,$syId,$semId);
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
		echo $this->model->assess($id,$sy,$sem,$stat,$course,$totalunit,$labunit,$graduating);
	}
  public function paymentbackup()
	{
    $ses=$this->session->userdata('user');
    $user=$ses->userRole;
    $this->model->logs($user,"backup payment");
		$id = $_GET['id'];
		$sy = $_GET['sy'];
		$sem = $_GET['sem'];
		echo $this->model->paymentbackup($id,$sy,$sem);
	}
  public function redistributepayment()
  {
    $ses=$this->session->userdata('user');
    $user=$ses->userRole;
    $this->model->logs($user,"redistribute payment");
    $id = $_GET['id'];
    $sy = $_GET['sy'];
    $sem = $_GET['sem'];
    echo $this->model->redistributepayment($id,$sy,$sem,"store");
  }
  public function getStudentTuition()
	{
		$id = $_GET['id'];
		$sy = $_GET['sy'];
		$sem = $_GET['sem'];
		echo $this->model->getStudentTuition($id,$sy,$sem);

	}
	public function addAllDiscounts()
	{
    $ses=$this->session->userdata('user');
    $user=$ses->userRole;
    $this->model->logs($user,"add discount");
		$removeOthers = $_GET['others'];
		$id = $_GET['id'];
		$syId = $_GET['syId'];
		$semId = $_GET['semId'];
		echo json_encode($removeOthers);
		if($removeOthers=='true'){
			echo json_encode($this->model->removeOthers($id,$syId,$semId));
		}
		$data = $_GET['discounts'];

		$returned = $this->model->insertBatchDiscounts($data,$id,$syId,$semId);

		return json_encode($returned);
	}
	public function removeDiscounts()
	{
    $ses=$this->session->userdata('user');
    $user=$ses->userRole;
    $this->model->logs($user,"delete discount");
		$id = $_GET['id'];
		$syId = $_GET['syId'];
		$semId = $_GET['semId'];
		echo json_encode($this->model->removeDiscounts($id,$syId,$semId));
	}
	public function generate(){
		$id = " AND stud_sch_info.ssi_id = '".$_GET['id']."'";
		$sy = $_GET['sy'];
		$sem = $_GET['sem'];
		$level = $_GET['level'];
		echo $this->model->generate($id,$sy,$sem,$level);
	}
  public function saveotherpayee()
  {
    $ses=$this->session->userdata('user');
    $user=$ses->userRole;
    $this->model->logs($user,"create other payee");
		$fname = $_GET['fname'];
		$mname = $_GET['mname'];
    $lname = $_GET['lname'];
    $ext = $_GET['ext'];
    $address = $_GET['address'];
		echo $this->model->saveotherpayee($fname,$mname,$lname,$ext,$address);
  }
  public function savetobackup()
  {
		$id = $_GET['id'];
		$acctno = $_GET['acctno'];
    $payornum = $_GET['payornum'];
    $paydate = $_GET['paydate'];
    $payamt = $_GET['payamt'];
    $userrole = $_GET['userrole'];
    $sy = $_GET['sy'];
    $sem = $_GET['sem'];
    $payprinttype = $_GET['payprinttype'];
		echo $this->model->savetobackup($id,$acctno,$payornum,$paydate,$payamt,$userrole,$sy,$sem,$payprinttype);
  }
  public function paytutorialbridging()
  {
		$id = $_GET['id'];
		$acctno = $_GET['acctno'];
    $payornum = $_GET['payornum'];
    $paydate = $_GET['paydate'];
    $payamt = $_GET['payamt'];
    $userrole = $_GET['userrole'];
    $syId = $_GET['syId'];
    $semId = $_GET['semId'];
    $payprinttype = $_GET['payprinttype'];
    $paytype = $_GET['paytype'];
		echo $this->model->paytutorialbridging($id,$acctno,$payornum,$paydate,$payamt,$userrole,$syId,$semId,$payprinttype,$paytype);
  }
  public function refundsave()
  {
    $id = $_GET['id'];
    $or = $_GET['or'];
		$amt = $_GET['amt'];
    $date = $_GET['date1'];
    $syId = $_GET['syId'];
    $semId = $_GET['semId'];
    $userrole = $_GET['userrole'];
    $note = $_GET['note'];
		echo $this->model->refundsave($id,$or,$amt,$date,$syId,$semId,$userrole,$note);
  }
  public function payothers()
  {
		$id = $_GET['id'];
    $otherpayeeid=$_GET['otherpayeeid'];
		$acctno = $_GET['acctno'];
    $payornum = $_GET['payornum'];
    $paydate = $_GET['paydate'];
    $payamt = $_GET['payamt'];
    $userrole = $_GET['userrole'];
    $syId = $_GET['syId'];
    $semId = $_GET['semId'];
    $payprinttype = $_GET['payprinttype'];
    $paytype = $_GET['paytype'];
    $cart = $_GET['cart'];
		echo $this->model->payothers($id,$otherpayeeid,$acctno,$payornum,$paydate,$payamt,$userrole,$syId,$semId,$payprinttype,$paytype,$cart);
  }
  public function loadotherpayeepayment()
  {
		$id = $_GET['id'];
		echo $this->model->loadotherpayeepayment($id);
  }
  public function gettutorialbridgingamt()
  {
		$id = $_GET['id'];
    $syId = $_GET['syId'];
    $semId = $_GET['semId'];
    $type = $_GET['type'];
		echo $this->model->gettutorialbridgingamt($id,$syId,$semId,$type);
  }
  public function getpayhistory()
  {
    $id = $_GET['id'];
    $syId = $_GET['syId'];
    $semId = $_GET['semId'];
    $type = $_GET['type'];
    $accttype=$_GET['accttype'];
    echo $this->model->getpayhistory($id,$syId,$semId,$type,$accttype);
  }
  public function refundhistory()
  {
    $id = $_GET['id'];
    $syId = $_GET['syId'];
    $semId = $_GET['semId'];
    $accttype=$_GET['accttype'];
    echo $this->model->refundhistory($id,$syId,$semId,$accttype);
  }
  public function printor()
  {
    $id = $_GET['id'];
    echo $this->model->printor($id);
  }

  public function checkor()
  {
		$payornum = $_GET['payornum'];
    $payprinttype = $_GET['payprinttype'];
		echo $this->model->checkor($payornum,$payprinttype);
  }
  public function getmaxar()
  {
    $payprinttype = $_GET['payprinttype'];
		echo $this->model->getmaxar($payprinttype);
  }
  public function deleteor()
  {
    $ses=$this->session->userdata('user');
    $user=$ses->userRole;
    $this->model->logs($user,"delete or");
    $id = $_GET['id'];
		echo $this->model->deleteor($id);
  }
  public function deleterefund()
  {
    $ses=$this->session->userdata('user');
    $user=$ses->userRole;
    $this->model->logs($user,"delete refund");
    $id = $_GET['id'];
		echo $this->model->deleterefund($id);
  }
  public function cancelor()
  {
    $ses=$this->session->userdata('user');
    $user=$ses->userRole;
    $this->model->logs($user,"cancel or");
    $id = $_GET['id'];
		echo $this->model->cancelor($id);
  }
  public function chackmastercode()
  {
    $mastercode = $_GET['mastercode'];
		echo $this->model->chackmastercode($mastercode);
  }

}
