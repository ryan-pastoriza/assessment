
<div class="wrapper">
  <header class="main-header">
    <a href="#" class="logo">
      <span class="logo-mini"><b>AC</b>S</span>
      <span class="logo-lg"><b>ACS</span>
    </a>
    <nav class="navbar navbar-static-top">

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="" style="pointer-events: none;cursor: default;">
              <i class=" fa fa-calendar">
                <span id="date_time" form-control></span>
                <script type="text/javascript">window.onload = date_time('date_time');</script>
              </i>
            </a>
          </li>
          <li>
            <a href="<?php echo site_url('dashboard/logout/').$_SESSION['user']->userId; ?>" style="cursor: default;">
              <i class="fa fa-power-off">

              </i>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <?php
  function numberTowords($num)
  {
  $ones = array(
  0 =>"",
  1 => "One",
  2 => "Two",
  3 => "Three",
  4 => "Four",
  5 => "Five",
  6 => "Six",
  7 => "Seven",
  8 => "Eight",
  9 => "Nine",
  10 => "Ten",
  11 => "Eleven",
  12 => "Twelve",
  13 => "Thirteen",
  14 => "Fourteen",
  15 => "Fifteen",
  16 => "Sixteen",
  17 => "Seventeen",
  18 => "Eightteen",
  19 => "Nineteen",
  "014" => "Fourteen"
  );
  $tens = array(
  0 => "Zero",
  1 => "Ten",
  2 => "Twenty",
  3 => "Thirty",
  4 => "Forty",
  5 => "Fifty",
  6 => "Sixty",
  7 => "Seventy",
  8 => "Eighty",
  9 => "Ninety"
  );
  $hundreds = array(
  "Hundred",
  "Thousand",
  "Million",
  "Billion",
  "Trillion",
  "Quadrillion"
  ); /*limit t quadrillion */
  $num = number_format($num,2,".",",");
  $num_arr = explode(".",$num);
  $wholenum = $num_arr[0];
  $decnum = $num_arr[1];
  $whole_arr = array_reverse(explode(",",$wholenum));
  krsort($whole_arr,1);
  $rettxt = "";
  foreach($whole_arr as $key => $i){

  while(substr($i,0,1)=="0")
    $i=substr($i,1,5);
  if($i < 20){
  /* echo "getting:".$i; */
  $rettxt .= $ones[$i];
  }elseif($i < 100){
  if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)];
  if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)];
  }else{
  if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0];
  if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)];
  if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)];
  }
  if($key > 0){
  $rettxt .= " ".$hundreds[$key]." ";
  }
  }
  if($decnum > 0){
  $rettxt .= " and ";
  if($decnum < 20){
  $rettxt .= $ones[$decnum];
  }elseif($decnum < 100){
  $rettxt .= $tens[substr($decnum,0,1)];
  $rettxt .= " ".$ones[substr($decnum,1,1)];
  }
  }
  return $rettxt." only";
  }
  ?>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $this->config->base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ucfirst($_SESSION['user']->username); ?></p>
          <small><i class="fa fa-circle text-success"></i> Online</small>
        </div>
      </div>
      <ul class="sidebar-menu">
        <li class="header"><b>MAIN NAVIGATION</b></li>
        <li class="active" id="access_tab">
          <a href="<?php echo site_url('fees2') ?>"><i class="glyphicon glyphicon-barcode">
            </i> <span>Fees</span></a>
        </li>
        <li id="access_tab">
          <a href="<?php echo site_url('particular') ?>"><i class="fa fa-dropbox">
            </i> <span>Particulars</span></a>
        </li>
        <?php if ($_SESSION['user']->userRole=="Accounting" OR  $_SESSION['user']->userRole=="Admin"): ?>
          <li id="access_tab">
            <a href="<?php echo site_url('reports') ?>"><i class="fa fa-calendar">
              </i> <span>Schedule</span></a>
          </li>
        <?php endif; ?>
        <?php if ($_SESSION['user']->userRole=="Admin"): ?>
          <li id="access_tab">
            <a href="<?php echo site_url('users') ?>"><i class="fa fa-users">
              </i> <span>Users</span></a>
          </li>
        <?php endif; ?>


      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Student
        <small>Assessment</small>
      </h1>
    </section>

    <section class="content">
      <div class="form-group">
        <form autocomplete="off">
        <div class="col-md-8">
          <div class="input-group">
            <span class="input-group-addon">STUDENT</span>
            <input type="hidden" class="form-control" id="accttype">
            <input type="hidden" class="form-control" id="otherpayeeaddress">
            <input type="hidden" class="form-control" id="studentid" value="null">
            <input type="hidden" class="form-control" id="oldacctno">
            <input type="text" class="form-control" placeholder="Search" id="search" >
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit" id="searchstudent">
                <i class="glyphicon glyphicon-search"></i>
              </button>
            </div>
          </div>
          <div>
            <div class="list-group" id="show-list">
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="input-group">
            <span class="input-group-addon">SY</span>
            <select class="form-control select2" id="sy" style="width: 100%;" placeholder="Select School Year">
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="input-group">
            <span class="input-group-addon">SEM</span>
            <select class="form-control select2" id="sem" style="width: 100%;" placeholder="Select Semester">
              <option data="1" value="1st">1st</option>
              <option data="2" value="2nd">2nd</option>
              <option data="3" value="Summer">Summer</option>
            </select>
          </div>
        </div>
        </form>
      </div>
      <br/>
      <br/>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary" >
            <div class="box-header with-border">
              <i class="fa fa-graduation-cap"></i>
              <h3 class="box-title">Student Information</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-3">
                  <img src="<?php echo $this->config->base_url(); ?>assets/dist/img/user.png" alt="" class="studimg">
                </div>
                <div class="col-md-7">
                  <p class="studentinfo">
                    <h3><b class="fullname"></b></h3>
                    <input type="hidden" class="form-control" id="assess_status">
                    <input type="hidden" class="form-control" id="assess_course">
                    <input type="hidden" class="form-control" id="assess_isgraduating">
                    <input type="hidden" class="form-control" id="assess_level">
                    <input type="hidden" class="form-control" id="assess_totalunit">
                    <input type="hidden" class="form-control" id="assess_labunit">
                    <input type="hidden" class="form-control" id="courseinput">
                    <p class="text-danger" id="enrollmentstatus"></p>
                    <p class="" id="acct_no"></p>
                    <p class="" id="usn_no"></p>
                    <p class="" id="course"></p>
                    <p class="" id="sysem"></p>
                    <p class="" id="stat"></p>
                  </p>
                  <div class="row" id="toprintas2">
                    <table class="table table-sm" id="tbmainas2">
                      <tbody id="as2">
                      </tbody>
                    </table>
                  </div>
                  <div class="row" id="toprintsi">
                    <div class="row" style="height:533px;">
                      <table  id="tbmain2">
                        <tbody id="rf1">

                        </tbody>
                      </table>
                    </div>
                    <div class="row"style="height:463px;">
                      <table  id="tbmain3">

                      </table>
                    </div>


                  </div>
                  <div class="row" id="toprintsb">
                    <div class="row" style="height:533px;">
                    </div>
                    <div class="row"style="height:463px;">
                      <table id="tbmain4">
                        <tbody id="rf2">
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                    <button type="button" id="reassess" class="btn btn-block btn-primary">Re-Assess</button>
                  <?php if ($_SESSION['user']->userRole=="Accounting" OR  $_SESSION['user']->userRole=="Admin"): ?>
                    <button type="button" id="discount" class="btn btn-block btn-primary" data-toggle="modal" data-target="#discountModal">Discount</button>
                    <button type="button" id="print2" class="btn btn-block btn-primary" onclick="printContent('toprintsi');">Registration Form 1</button>
                    <button type="button" id="print3" class="btn btn-block btn-primary" onclick="printContent('toprintsb');">Registration Form 2</button>
                    <!-- <button type="button" id="" class="btn btn-block btn-primary">Payment OR</button>
                    <button type="button" id="" class="btn btn-block btn-primary">Payment AR</button>
                    <button type="button" id="" class="btn btn-block btn-primary">Refund</button> -->
                  <?php endif; ?>
                  <?php if ($_SESSION['user']->userRole=="Cashier" OR  $_SESSION['user']->userRole=="Admin"): ?>
                    <button type="button" id="otherpayee" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modalotherpayee">Create  Other Payee</button>
                    <button type="button" id="addrefund" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modaladdrefund">Refund</button>
                  <?php endif; ?>
                    <button type="button" id="redistribute" class="btn btn-block btn-primary">Redistribute</button>
                    <button type="button" id="print" class="btn btn-block btn-primary" onclick="printContentslip('toprintas2');">Account Slip</button>
                </div>
                <div class="modal fade " id="modalotherpayee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Payee</h5>
                        <p id="payeelabel" class="text-success"></p>
                        <p id="payeelabel2" class="text-danger"></p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="input-group">
                              <span class="input-group-addon">Firstname</span>
                              <input class="form-control" id="payeefname">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="input-group">
                              <span class="input-group-addon">Ext</span>
                              <input class="form-control" id="payeeext">
                            </div>
                          </div>
                        </div>
                        <br/>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="input-group">
                              <span class="input-group-addon">Middlename</span>
                              <input class="form-control" id="payeemname">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="input-group">
                              <span class="input-group-addon">Lastname</span>
                              <input class="form-control" id="payeelname">
                            </div>
                          </div>
                        </div>
                        <br/>
                        <div class="row">
                          <div class="col-md-9">
                            <div class="input-group">
                              <span class="input-group-addon">Address</span>
                              <input class="form-control" id="payeeaddress">
                            </div>
                          </div>
                          <div class="col-md-3">
                              <button type="button" id="saveotherpayee" class="btn btn-block btn-primary">Save</button>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade " id="modaladdrefund" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        Add Refund
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="input-group">
                              <span class="input-group-addon">OR</span>
                              <input class="form-control" id="refundor">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="input-group">
                              <span class="input-group-addon">Amount</span>
                              <input class="form-control" id="refundamt">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="input-group">
                              <span class="input-group-addon">Date</span>
                              <input class="form-control datepicker" id="refunddate" data-date-format="mm/dd/yyyy">
                            </div>
                          </div>
                        </div>
                        <br/>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="input-group">
                              <span class="input-group-addon">Note</span>
                              <input class="form-control" id="refundnote">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <div class="col-md-9">
                        </div>
                        <div class="col-md-3">
                            <button type="button" id="refundsave" onclick="refundsave()" data-dismiss="modal" class="btn btn-block btn-primary">Save</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row" id="lcbox">
                    <div class="col-md-3">
                      <div class="small-box bg-blue">
                        <div class="inner">
                          <h3 id="assessmentdispl">0.00</h3>
                          <div class="icon">
                            <i class="fa fa-graduation-cap"></i>
                          </div>
                          <p>Assessment</p>
                        </div>
                      </div>
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3 id="oldaccdispl">0.00</h3>
                          <div class="icon">
                            <i class="ion ion-ios-list"></i>
                          </div>
                          <p>Old Account</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="small-box bg-teal">
                        <div class="inner">
                          <h3 id="bridgingdispl">0.00</h3>
                          <div class="icon">
                            <i class="fa fa-book"></i>
                          </div>
                          <p>Bridging</p>
                        </div>
                      </div>
                      <div class="small-box bg-navy">
                        <div class="inner">
                          <h3 id="tutorialdispl">0.00</h3>
                          <div class="icon">
                            <i class="fa fa-book"></i>
                          </div>
                          <p>Tutorial</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="small-box bg-green">
                        <div class="inner">
                          <h3 id="paymentsdispl">0.00</h3>
                          <div class="icon">
                            <i class="fa fa-money"></i>
                          </div>
                          <p>Payments</p>
                        </div>
                      </div>
                      <div class="small-box bg-orange">
                        <div class="inner">
                          <h3 id="cbalancedispl">0.00</h3>
                          <div class="icon">
                            <i class="fa fa-bar-chart"></i>
                          </div>
                          <p>Current Balance</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="small-box bg-purple">
                        <div class="inner">
                          <h3 id="discountdispl">0.00</h3>
                          <div class="icon">
                            <i class="fa fa-minus-circle"></i>
                          </div>
                          <p>Discount</p>
                        </div>
                      </div>
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3 id="tbalancedispl">0.00</h3>
                          <div class="icon">
                            <i class="fa fa-area-chart"></i>
                          </div>
                          <p>Total Balance</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row" id="ocbox">
                    <div class="col-md-3">
                      <div class="small-box bg-blue">
                        <div class="inner">
                          <h3 id="assessmentdispo">0.00</h3>
                          <div class="icon">
                            <i class="fa fa-graduation-cap"></i>
                          </div>
                          <p>Assessment</p>
                        </div>
                      </div>
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3 id="oldaccdispo">0.00</h3>
                          <div class="icon">
                            <i class="ion ion-ios-list"></i>
                          </div>
                          <p>Old Account</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="small-box bg-teal">
                        <div class="inner">
                          <h3 id="bridgingdispo">0.00</h3>
                          <div class="icon">
                            <i class="fa fa-book"></i>
                          </div>
                          <p>Bridging</p>
                        </div>
                      </div>
                      <div class="small-box bg-navy">
                        <div class="inner">
                          <h3 id="tutorialdispo">0.00</h3>
                          <div class="icon">
                            <i class="fa fa-book"></i>
                          </div>
                          <p>Tutorial</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="small-box bg-green">
                        <div class="inner">
                          <h3 id="paymentsdispo">0.00</h3>
                          <div class="icon">
                            <i class="fa fa-money"></i>
                          </div>
                          <p>Payments</p>
                        </div>
                      </div>
                      <div class="small-box bg-orange">
                        <div class="inner">
                          <h3 id="cbalancedispo">0.00</h3>
                          <div class="icon">
                            <i class="fa fa-bar-chart"></i>
                          </div>
                          <p>Current Balance</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="small-box bg-purple">
                        <div class="inner">
                          <h3 id="discountdispo">0.00</h3>
                          <div class="icon">
                            <i class="fa fa-minus-circle"></i>
                          </div>
                          <p>Discount</p>
                        </div>
                      </div>
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3 id="tbalancedispo">0.00</h3>
                          <div class="icon">
                            <i class="fa fa-area-chart"></i>
                          </div>
                          <p>Total Balance</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" id="toprintor">
                  <table class="table table-sm">
                    <tbody id="printor">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php if ($_SESSION['user']->userRole=="Cashier" OR  $_SESSION['user']->userRole=="Admin"): ?>
      <div class="row paydiv">
        <div class="containeralert">
          <div class="row" id="error-container">
            <div class="span12">

            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Payment</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="input-group">
                    <span class="input-group-addon">Fee Type</span>
                    <select class="form-control" id="paytype">
                      <option data="1" value="assessment">Assessment</option>
                      <option data="2" value="tutorial">Tutorial</option>
                      <option data="3" value="bridging">Bridging</option>
                      <option data="4" value="others">Others</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                    <span class="input-group-addon">Printing Type</span>
                    <select class="form-control" id="payprinttype">
                      <option data="1" value="OR">OR</option>
                      <option data="2" value="AR">AR</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                    <span class="input-group-addon">Date</span>
                    <input class="form-control datepicker" id="paydate" data-date-format="mm/dd/yyyy">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                    <span class="input-group-addon">Receipt no.</span>
                    <input class="form-control" id="payornum">
                  </div>
                </div>
              </div>
              <br/>
              <div class="row">
                <div class="col-md-3">
                  <div class="input-group">
                    <span class="input-group-addon">Amount</span>
                    <input class="form-control" id="payamt">
                    <input type="hidden" class="form-control" id="assessmenttotal">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                    <span class="input-group-addon">Cash</span>
                    <input class="form-control" id="paycash">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                    <span class="input-group-addon">Change</span>
                    <input class="form-control" id="paychange" disabled >
                  </div>
                </div>
                <div class="col-md-3">
                    <button type="button" id="paymentbutton" class="btn btn-block btn-primary">Pay</button>
                </div>
              </div>
              <br/>
              <div class="row">
                <div class="col-md-4">
                  <div class="input-group particulardiv">
                    <span class="input-group-addon">Particular</span>
                    <input type="text" class="form-control" placeholder="Search particular" id="searchpart">
                    <input type="hidden" class="form-control" id="arr1">
                    <input type="hidden" class="form-control" id="arr2">
                    <input type="hidden" class="form-control" id="arr3">
                    <input type="hidden" class="form-control" id="arr4">
                    <div class="input-group-btn">
                      <button class="btn btn-default" type="submit" id="addparticular">
                        <i class="glyphicon glyphicon-plus"></i>
                      </button>
                    </div>
                  </div>
                  <div>
                    <div class="list-group" id="show-list-part">
                    </div>
                  </div>
                  <div class="row particulardiv">
                    <div class="col-md-6">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <td>Particulars</td>
                          </tr>
                        </thead>
                        <tbody id="particularlist">

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group orar">
                    Payment History
                    <table class="table table-md">
                      <thead>
                        <tr>
                          <th>OR</th>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>Details</th>
                          <th>Print</th>
                          <th>Cancel</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody id="payhistory">

                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group refunddiv">
                    Refund
                    <table class="table table-md">
                      <thead>
                        <tr>
                          <th>OR</th>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>Note</th>
                          <th>Cashier</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody id="refundhistory">

                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="modal fade " id="deletepaymentmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p id="deletenotif1" class="text-success"></p>
                        <p id="deletenotif2" class="text-danger"></p>
                        <input type="hidden" class="form-control" id="deleteid">
                        <input type="hidden" class="form-control" id="statusdeletecancel">
                        <input type="hidden" class="form-control" id="typedeletecancel">
                        <h4 id="msghere"></h4>
                        <input type="password" class="form-control" id="mastercode">
                      </div>
                      <div class="modal-footer">
                        <div class="col-md-6">
                            <button type="button" id="deleteyes" onclick="deleteor()" class="btn btn-block btn-success">Yes</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" data-dismiss="modal" class="btn btn-block btn-danger">No</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <br/>
            </div>
          </div>
        </div>
      </div>
    <?php endif ?>
      <br/>
      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#assessmenttab" data-toggle="tab">Assessment</a></li>
              <li><a href="#bridgingtab" data-toggle="tab">Bridging</a></li>
              <li><a href="#tutorialtab" data-toggle="tab">Tutorial</a></li>
              <li><a href="#subjectstab" data-toggle="tab">Subjects</a></li>
              <li><a href="#otherptab" data-toggle="tab">Other Payments</a></li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="assessmenttab">
                <div class="box">
                  <!-- <div class="box-header">
                    <h3 class="box-title">Assessment</h3>
                  </div> -->
                  <div class="box-body no-padding" id="assessmentdiv">

                  </div>
                </div>
              </div>

              <div class="tab-pane" id="bridgingtab">
                <div class="box">
                  <!-- <div class="box-header">
                    <h3 class="box-title">Bridging</h3>
                  </div> -->
                  <div class="box-body no-padding" id="bridgingdiv">

                  </div>
                </div>
              </div>

              <div class="tab-pane" id="tutorialtab">
                <div class="box">
                  <!-- <div class="box-header">
                    <h3 class="box-title">Tutorial</h3>
                  </div> -->
                  <div class="box-body no-padding" id="tutorialdiv">

                  </div>
                </div>
              </div>

              <div class="tab-pane" id="subjectstab">
                <div class="box">
                  <!-- <div class="box-header">
                    <h3 class="box-title">Subjects</h3>
                  </div> -->
                  <div class="box-body no-padding" id="studloaddiv">

                  </div>
                </div>
              </div>

              <div class="tab-pane" id="otherptab">
                <div class="box">
                  <!-- <div class="box-header">
                    <h3 class="box-title">Other Payments</h3>
                  </div> -->
                  <div class="box-body no-padding" id="otherpaymentsdiv">

                  </div>
                </div>
              </div>


            </div>

          </div>
        </div>
      </div>
    </section>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2018-2019 <a href="http://engtechglobalsolutions.com/">EngTech Global Solution Inc</a>.</strong> All rights
    reserved.
  </footer>
  <div class="control-sidebar-bg"></div>
  </div>

<div id="discountModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <!-- <div class="checkbox">
          <label><input type="checkbox" class="discountCheckBoxes" value="1st Year" less="0.30" removeOthers="false">1st Year 30%</label>
        </div> -->
        <div class="checkbox" id="FullPayment">
          <label><input type="checkbox" class="discountCheckBoxes" value="Full Payment w/o Handling Fee" less="0.05" removeOthers="true">Full Payment 5%  w/o Handling Fee</label>
        </div>
        <div class="checkbox" id="FullPayment1">
          <label><input type="checkbox" class="discountCheckBoxes" value="Full Payment with Handling Fee 1.5%" less="0" removeOthers="true">Full Paymen with Handling Fee 1.5%</label>
        </div>
        <div class="checkbox" id="FullPayment1">
          <label><input type="checkbox" class="discountCheckBoxes" value="Full Payment with Handling Fee 3%" less="0" removeOthers="true">Full Paymen with Handling Fee 3%</label>
        </div>
        <div class="checkbox" id="FullPayment1">
          <label><input type="checkbox" class="discountCheckBoxes" value="Full Payment with Handling Fee 4.5%" less="0" removeOthers="true">Full Paymen with Handling Fee 4.5%</label>
        </div>
        <div class="checkbox" id="FullPayment1">
          <label><input type="checkbox" class="discountCheckBoxes" value="Full Payment with Handling Fee 4%" less="0" removeOthers="true">Full Paymen with Handling Fee 4%</label>
        </div>
        <div class="checkbox" id="FullPayment1">
          <label><input type="checkbox" class="discountCheckBoxes" value="Full Payment with Handling Fee 6%" less="0" removeOthers="true">Full Paymen with Handling Fee 6%</label>
        </div>
        <div class="checkbox" id="Sibling">
          <label><input type="checkbox" class="discountCheckBoxes" value="Sibling" less="0.05" removeOthers="false">Sibling 5%</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" class="discountCheckBoxes" custom="true">Custom</label>
        </div>
        <div class="row">
          <div class="col-lg-5" style="font-weight: normal;">
            Description:<input type="text" id="customDiscountDesc" name="discountDesc">
          </div>
          <div class="col-lg-4" style="font-weight: normal;">
            Percentage:<input type="number" id="customDiscountPercentage" name="quantity" min="1" max="100">
          </div>
          <div class="col-lg-3" style="font-weight: normal;">
            <input type="checkbox" id="customDiscountOthers" name="quantity" min="1" max="5">No Other Fees
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="deleteDiscounts" class="btn btn-danger" data-dismiss="modal">Remove All Discounts</button>
        <button type="button" id="setDiscount" class="btn btn-success" data-dismiss="modal">Submit</button>
      </div>
    </div>
  </div>
</div>
<?php
$ses=$this->session->userdata('user');
$user=$ses->userRole;
?>
<script src="<?php echo $this->config->base_url(); ?>/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>


$('#paytype option[value="tutorial"]').attr("disabled", true);
$('#paytype option[value="bridging"]').attr("disabled", true);
$('.datepicker').datepicker({
  format: 'yyyy-mm-dd',
  autoclose: true
})
$('.datepicker').datepicker('update', new Date());
$('.paydiv').hide();
$('#addrefund').attr("disabled", true);
var inWords = function(totalRent){
//console.log(totalRent);
var a = ['','One ','Two ','Three ','Four ', 'Five ','Six ','Seven ','Eight ','Nine ','Ten ','Eleven ','Twelve ','Thirteen ','Fourteen ','Fifteen ','Sixteen ','Seventeen ','Eighteen ','Nineteen '];
var b = ['', '', 'Twenty','Thirty','Forty','Fifty', 'Sixty','Seventy','Eighty','Ninety'];
var number = parseFloat(totalRent).toFixed(2).split(".");
var num = parseInt(number[0]);
var digit = parseInt(number[1]);
//console.log(num);
if ((num.toString()).length > 9)  return 'overflow';
var n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
var d = ('00' + digit).substr(-2).match(/^(\d{2})$/);;
if (!n) return; var str = '';
str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'Trillion ' : '';
str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'Million ' : '';
str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'Thousand ' : '';
str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'Hundred ' : '';
str += (n[5] != 0) ? (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'pesos ' : '';
str += (d[1] != 0) ? ((str != '' ) ? "and " : '') + (a[Number(d[1])] || b[d[1][0]] + ' ' + a[d[1][1]]) + 'cent ' : 'Only';
return str;
}
// console.log(inWords(12354.5))
var userrole="<?php echo $user; ?>";

$('#ocbox').hide();
$('#oibox').hide();
$('#toprint').hide();
$('#toprintsi').hide();
$('#toprintsb').hide();
$('#toprintas2').hide();
$('#toprintor').hide();
$('#assess_totalunit').val(0);
$('.particulardiv').hide();
//$('#reassess').hide();
//$('#discount').hide();
// $('#print').hide();
// $('#print2').hide();
// $('#print3').hide();

function tonum(num1)
{
  var n=num1
  var parts = n.toFixed(2).split(".");
  var num = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + (parts[1] ? "." + parts[1] : "");
  return num;
}
$(function () {
  $.ajax({
    url: "<?php echo base_url('fees/getsy') ?>",
    type: 'GET',
    dataType: 'JSON',
  })
  .done(function(data) {
      $.each(data, function(index, val) {
        $('#sy').append('<option value="'+val.sy+'" data="'+val.syId+'">'+val.sy+'</option>');
      });
  })
  .fail(function() {
    console.log("error getsy");
  })
})
$('#search').keyup(function(){
  var tbody = "";
  var searchtext = $(this).val();
  $( "#searchres" ).remove();
  if (searchtext!='') {
    $.ajax({
      url: "<?php echo base_url('fees2/searchs') ?>",
      type: 'GET',
      dataType: 'JSON',
      data: {searchtext: searchtext},
    })
    .done(function(data) {
        $.each(data, function(index, val) {
          tbody += '<a href="#" id="searchres" data-accttype="'+val.accttype+'" data-payeeadd="'+val.payeeAddress+'" data-id="'+val.ssi_id+'" data-acct="'+val.acct_no+'" class="list-group-item list-group-item-action border-1">'+val.lname+', '+val.fname+' '+val.mname+' '+val.suffix+'</a>';
        });
      $("#show-list").html(tbody);
    })
    .fail(function() {
      console.log("error ");
    })
  }else{
    $("#show-list").html('');
  }
});
$('#searchpart').keyup(function(){
  var tbody = "";
  var searchtext = $(this).val();
  var syId = $('#sy option:selected').attr('data');
  var semId = $('#sem option:selected').attr('data');
  $( "#searchrespart" ).remove();
  if (searchtext!='') {
    $.ajax({
      url: "<?php echo base_url('fees2/searchpart') ?>",
      type: 'GET',
      dataType: 'JSON',
      data: {searchtext: searchtext,syId: syId,semId: semId},
    })
    .done(function(data) {
        $.each(data, function(index, val) {
          tbody += '<a id="searchrespart" data-particularId="'+val.particularId+'" data-particularName="'+val.particularName+'" data-amt1="'+val.amt1+'" data-amt2="'+val.amt2+'" class="list-group-item list-group-item-action border-1">'+val.particularName+' '+val.amt2+'</a>';
        });
      $("#show-list-part").html(tbody);
    })
    .fail(function() {
      console.log("error ");
    })
  }else{
    $("#show-list-part").html('');
  }
});
$('#paytype').on('change', function() {
  $('#paychange').val("")
  paytype()
  getpaymenthistory()
});
function getpaymenthistory(){
  $("#payhistory").html("")
  var accttype=$("#accttype").val()
  var type=$('#paytype').val()
  var id = $('#studentid').val();
  var syId = $('#sy option:selected').attr('data');
  var semId = $('#sem option:selected').attr('data');
  $.ajax({
    url: "<?php echo base_url('fees2/getpayhistory') ?>",
    type: 'GET',
    dataType: 'JSON',
    data: {id: id, syId: syId, semId: semId, type: type, accttype: accttype},
  })
  .done(function(data) {
    $.each(data, function(index, val) {
      if (val.paymentStatus=="canceled") {
        $('#payhistory').append("<tr><td>"+val.orNo+"</td><td>"+toDate(val.paymentDate)+"</td><td>"+val.amt2+"</td><td></td><td></td><td></td><td></td></tr>");
      }else {
        $('#payhistory').append("<tr><td>"+val.orNo+"</td><td>"+toDate(val.paymentDate)+"</td><td>"+val.amt2+"</td><td>"+val.dtails+"</td><td><a onclick='printor("+val.paymentId+")'><span style='color:#5483c3' class='glyphicon glyphicon-print'></span></a></td><td><a onclick='opendeletemodal("+val.paymentId+","+val.orNo+",`cancel`,`or`)'><span style='color:#ffaa00' class='glyphicon glyphicon-remove-sign'></span></a></td><td><a onclick='opendeletemodal("+val.paymentId+","+val.orNo+",`delete`,`or`)'><span style='color:#e00000' class='glyphicon glyphicon-trash'></span></a></td></tr>");
      }

    });
  })
  .fail(function() {
    console.log("error ");
  })
}
function refundhistory(){
  $("#refundhistory").html("")
  var accttype=$("#accttype").val()
  var id = $('#studentid').val();
  var syId = $('#sy option:selected').attr('data');
  var semId = $('#sem option:selected').attr('data');
  $.ajax({
    url: "<?php echo base_url('fees2/refundhistory') ?>",
    type: 'GET',
    dataType: 'JSON',
    data: {id: id, syId: syId, semId: semId, accttype: accttype},
  })
  .done(function(data) {
    $.each(data, function(index, val) {
      $('#refundhistory').append("<tr><td>"+val.or+"</td><td>"+toDate(val.date)+"</td><td>"+val.amt+"</td><td>"+val.note+"</td><td>"+val.cashier+"</td><td></td><td><a onclick='opendeletemodal("+val.refundId+","+val.or+",`delete`,`refund`)'><span style='color:#e00000' class='glyphicon glyphicon-trash'></span></a></td></tr>");
    });
  })
  .fail(function() {
    console.log("error ");
  })
}
function opendeletemodal(id,or,status,type){
  if (!or) {
    or=""
  }
  $('#deletenotif1').text("");
  $('#deletenotif2').text("");
  $('#deletepaymentmodal').modal('show');
  $("#msghere").html("(OR: "+or+")<br>To "+status+" this payment/refund please enter mastercode")
  $("#deleteid").val(id)
  $("#statusdeletecancel").val(status)
  $("#typedeletecancel").val(type)
}
function refundsave(){
  var id = $('#studentid').val();
  var syId = $('#sy option:selected').attr('data');
  var semId = $('#sem option:selected').attr('data');
  var or = $('#refundor').val();
  var amt = $('#refundamt').val();
  var date1 = $('#refunddate').val();
  var note = $('#refundnote').val();
  if (or!="" && amt!="" && $.isNumeric(amt)==true) {
    $.ajax({
      url: "<?php echo base_url('fees2/refundsave') ?>",
      type: 'GET',
      dataType: 'JSON',
      data: {id: id,or: or,amt: amt,date1: date1,syId: syId,semId: semId,userrole: userrole,note: note},
    })
    .done(function(data) {
      $.each(data, function(index, val) {

      });
      refundhistory()
    })
    .fail(function() {
      console.log("error ");
    })
  }

}
function deleteor(){
  var mastercode=$("#mastercode").val()
  var val1
  $.ajax({
    url: "<?php echo base_url('fees2/chackmastercode') ?>",
    type: 'GET',
    dataType: 'JSON',
    data: {mastercode: mastercode},
  })
  .done(function(data) {
    $.each(data, function(index, val) {
      val1=val
    });
  })
  .fail(function() {
    console.log("error ");
  })
  setTimeout(function () {
    if (val1=="yes") {
      $('#mastercode').val("");
      deleteor2()
    }else{
      $('#deletenotif2').text("Mastercode Error!");
      $('#deletenotif1').text("");
    }
  }, 1000);
}
function deleteor2(){
  var id=$("#deleteid").val()
  var status=$("#statusdeletecancel").val()
  var dtype=$("#typedeletecancel").val()
  if (dtype=="or") {
    if (status=="delete") {
      $.ajax({
        url: "<?php echo base_url('fees2/deleteor') ?>",
        type: 'GET',
        dataType: 'JSON',
        data: {id: id},
      })
      .done(function(data) {
        $.each(data, function(index, val) {
          if (val.result=='Success') {
            $('#deletenotif1').text("Deleted!");
            $('#deletenotif2').text("");
          }else {
            $('#deletenotif1').text("");
            $('#deletenotif2').text(val.result);
          }
        });
        searchstudent()
      })
      .fail(function() {
        console.log("error ");
      })
    }else if(status=="cancel") {
      $.ajax({
        url: "<?php echo base_url('fees2/cancelor') ?>",
        type: 'GET',
        dataType: 'JSON',
        data: {id: id},
      })
      .done(function(data) {
        $.each(data, function(index, val) {
          if (val.result=='Success') {
            $('#deletenotif1').text("Canceled!");
            $('#deletenotif2').text("");
          }else {
            $('#deletenotif1').text("");
            $('#deletenotif2').text(val.result);
          }
        });
        searchstudent()
      })
      .fail(function() {
        console.log("error ");
      })
    }
  }else
  {
    $.ajax({
      url: "<?php echo base_url('fees2/deleterefund') ?>",
      type: 'GET',
      dataType: 'JSON',
      data: {id: id},
    })
    .done(function(data) {
      $.each(data, function(index, val) {
        if (val.result=='Success') {
          $('#deletenotif1').text("Deleted!");
          $('#deletenotif2').text("");
        }else {
          $('#deletenotif1').text("");
          $('#deletenotif2').text(val.result);
        }
      });
      refundhistory()
    })
    .fail(function() {
      console.log("error ");
    })
  }

}
function paytype(){
  var type=$('#paytype').val()
  var id = $('#studentid').val();
  var syId = $('#sy option:selected').attr('data');
  var semId = $('#sem option:selected').attr('data');
  if($('#paytype').val()=="others")
  {
    $('.particulardiv').show();
    var t=0
    $.each(cart, function(index, val) {
      t=t+parseFloat(val.amt2)
    });
    $("#payamt").val(t.toFixed(2));
  }
  else
  {
    $('.particulardiv').hide();
  }
  if ($('#paytype').val()=="bridging" || $('#paytype').val()=="tutorial" || $('#paytype').val()=="others") {
    $("#payprinttype").val("AR").change();
    if ($('#paytype').val()=="tutorial")
    {
      $.ajax({
        url: "<?php echo base_url('fees2/gettutorialbridgingamt') ?>",
        type: 'GET',
        dataType: 'JSON',
        data: {id: id, syId: syId, semId: semId, type: type},
      })
      .done(function(data) {
          $.each(data, function(index, val) {
            $("#payamt").val(val.amt2.toFixed(2));
          });
      })
      .fail(function() {
        console.log("error ");
      })
    }
    else if ($('#paytype').val()=="bridging")
    {
      $.ajax({
        url: "<?php echo base_url('fees2/gettutorialbridgingamt') ?>",
        type: 'GET',
        dataType: 'JSON',
        data: {id: id, syId: syId, semId: semId, type: type},
      })
      .done(function(data) {
          $.each(data, function(index, val) {
            $("#payamt").val(val.amt2.toFixed(2));
          });
      })
      .fail(function() {
        console.log("error ");
      })
    }
  }
  else if ($('#paytype').val()=="assessment")
  {
    var n=parseFloat($("#assessmenttotal").val())
    $("#payamt").val(n.toFixed(2));
    $("#payprinttype").val("OR").change();
  }

  setTimeout(function() {
    payamtkup()
  }, 1000);
}
var oryes="yes"
$('#payornum').keyup(function(){
  checkor()
});

$('#payprinttype').on('change', function() {
  getor()
});
function getor(){
  var payprinttype=$('#payprinttype').val();
  $.ajax({
    url: "<?php echo base_url('fees2/getmaxar') ?>",
    type: 'GET',
    dataType: 'JSON',
    data: {payprinttype: payprinttype},
  })
  .done(function(data) {
      $.each(data, function(index, val) {
        $('#payornum').val(val.or);
      });
  })
  .fail(function() {
    console.log("error ");
  })
  setTimeout(function() {
    checkor()
  }, 1000);
}
function popupnotif(val){
  if (val!="") {
    $('.span12').append('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><p id="notifmsg"><ul>'+val+'</ul></p></div>')
    $('#containeralert').alert()
    setTimeout(function() {
      $('.alert').alert('close')
    }, 10000);
  }

}
function checkor(){
  if ($('#payornum').val() != "") {
    var payornum=$('#payornum').val();
    var payprinttype=$('#payprinttype').val();
    $.ajax({
      url: "<?php echo base_url('fees2/checkor') ?>",
      type: 'GET',
      dataType: 'JSON',
      data: {payornum: payornum, payprinttype: payprinttype},
    })
    .done(function(data) {
        $.each(data, function(index, val) {
          if (val.status=="yes") {
            $('#payornum').each(function() {
              $.data(this, 'default', this.value);
            }).css("color","red")
            $('#paymentbutton').attr("disabled", true);
            // console.log("OR "+val.or+" owned by: "+val.name)
            popupnotif(val.name)
            oryes="yes"
          }
          else
          {
            $('#payornum').each(function() {
              $.data(this, 'default', this.value);
            }).css("color","green")
            oryes="no"
          }
        });
        payamtkup()
    })
    .fail(function() {
      console.log("error ");
    })
  }

  if ($.isNumeric($("#paychange").val())==true && $.isNumeric($("#paycash").val())==true && $("#paychange").val()>=0 && $("#paycash").val()>0) {
    if ($('#feeType').val()=="assessment") {
      if ($("#assessmentdispl").text()!="0.00") {
        $('#paymentbutton').attr("disabled", false);
      }else {
        $('#paymentbutton').attr("disabled", true);
      }
    }else {
      $('#paymentbutton').attr("disabled", false);
    }
  }else{
    $('#paymentbutton').attr("disabled", true);
  }
}
var cart = [];
var cartcount=0
$(document).on('click','#addparticular',function(){
  var id=$('#arr1').val();
  var particular=$('#arr2').val();
  var amt1=$('#arr3').val();
  var amt2=$('#arr4').val();
  if (id!="") {
    cart[cartcount]={
      'particulatId':id,
      'particularName':particular,
      'amt1':amt1,
      'amt2':amt2
    }
    cartcount=cartcount+1
  }
  $('#searchpart').val("");
  $('#arr1').val("");
  $('#arr2').val("");
  $('#arr3').val("");
  $('#arr4').val("");
  particulartable()
});
function particulartable()
{
  $('#particularlist').html("");
  var count=0
  var payamt=0
  $.each(cart, function(index, val) {
    $('#particularlist').append("<tr><td>"+val.particulatId+"</td><td>"+val.particularName+"</td><td>"+val.amt2+"</td><td><a onclick='deleteparticular("+count+")'><span style='color:#CC0000' class='glyphicon glyphicon-trash'></span></a></td></tr>");
    payamt=payamt+parseFloat(val.amt2);
    count=count+1
  });
  $("#payamt").val(payamt.toFixed(2));
}
function deleteparticular(index)
{
  cart.splice(index,1);
  cartcount=cartcount-1
  particulartable()
}
function disableScreen() {
    // creates <div class="overlay"></div> and
    // adds it to the DOM
    var div= document.createElement("div");
    div.className += "overlay";
    document.body.appendChild(div);
    var elem = document.createElement("img");
    elem.className += "loadingimg";
    elem.setAttribute("src", "assets/dist/img/loading.gif");
    $('.overlay').append(elem);
}
$(document).on('click','#paymentbutton',function(){
  disableScreen()
  // printContentslip("toprintsi")
  var accttype = $('#accttype').val();
  var otherpayeeid =""
  var id = $('#studentid').val();
  var acctno = $('#oldacctno').val();
  var payornum=$('#payornum').val();
  var paydate=$('#paydate').val();
  var payamt=$('#payamt').val();
  var sy = $('#sy').val();
  var sem = $('#sem').val();
  var payprinttype=$('#payprinttype').val();
  var syId = $('#sy option:selected').attr('data');
  var semId = $('#sem option:selected').attr('data');
  var paytype = $("#paytype").val();
  var printorid
  if ($("#paytype").val()=="assessment" && payornum!="") {
    $.ajax({
      url: "<?php echo base_url('fees2/savetobackup') ?>",
      type: 'GET',
      dataType: 'JSON',
      data: {id: id,acctno: acctno,payornum: payornum,paydate: paydate,payamt: payamt,userrole: userrole,sy: sy,sem: sem,payprinttype: payprinttype},
    })
    .done(function(data) {
      $.each(data, function(index, val) {
        printorid=val.id
      });
      printor(printorid)
      $('#payornum').val("");
      $('#payamt').val("");
      $('#paycash').val("");
    })
    .fail(function() {
      console.log("error ");
    })
  }
  else if ($("#paytype").val()=="tutorial" || $("#paytype").val()=="bridging")
  {
    $.ajax({
      url: "<?php echo base_url('fees2/paytutorialbridging') ?>",
      type: 'GET',
      dataType: 'JSON',
      data: {id: id,acctno: acctno,payornum: payornum,paydate: paydate,payamt: payamt,userrole: userrole,syId: syId,semId: semId,payprinttype: payprinttype,paytype: paytype},
    })
    .done(function(data) {
      $.each(data, function(index, val) {
        printorid=val.id
      });
      printor(printorid)
      $('#payornum').val("");
      $('#payamt').val("");
      $('#paycash').val("");
    })
    .fail(function() {
      console.log("error ");
    })
  }
  else if ($("#paytype").val()=="others")
  {
    if (accttype=="student") {
      id = $('#studentid').val();
      otherpayeeid =""
    }else {
      id = ""
      otherpayeeid =$('#studentid').val();
    }
    $.ajax({
      url: "<?php echo base_url('fees2/payothers') ?>",
      type: 'GET',
      dataType: 'JSON',
      data: {id: id,otherpayeeid: otherpayeeid,acctno: acctno,payornum: payornum,paydate: paydate,payamt: payamt,userrole: userrole,syId: syId,semId: semId,payprinttype: payprinttype,paytype: paytype,cart: cart},
    })
    .done(function(data) {
      $.each(data, function(index, val) {
        printorid=val.id
      });
      printor(printorid)
      $('#payornum').val("");
      $('#payamt').val("");
      $('#paycash').val("");
    })
    .fail(function() {
      console.log("error ");
    })
    cart = [];
    cartcount=0
  }
  setTimeout(function() {
    searchstudent()
  }, 3000);
  setTimeout(function() {
      getor()
  }, 3000);
});
$('#payamt').keyup(function(){
  checkor()
});
function getdatetimenow(){
var d = new Date();
var strDate = (d.getMonth()+1) + "/" + d.getDate() + "/" + d.getFullYear() +" "+ d.getHours() +":"+ d.getMinutes() +":"+ d.getSeconds();
return strDate;
}
function printor(id){
  $('#printor').html("");
  $.ajax({
    url: "<?php echo base_url('fees2/printor') ?>",
    type: 'GET',
    dataType: 'JSON',
    data: {id: id},
  })
  .done(function(data) {
    $.each(data, function(index, val) {
      if (val.printingType=="OR") {
        $("#printor").append('<tr><td height="90px"></td><td></td><td></td><td></td></tr><tr><td width="90px"></td><td width="400px">'+$(".fullname").text()+'</td><td width="90px"></td><td width="90px">'+toDate(val.date)+'</td></tr><tr><td width="90px" height="30px"></td><td></td><td></td><td></td></tr><tr><td width="90px" height="45px"></td><td>'+inWords(val.amt)+'</td><td></td><td></td></tr><tr><td width="90px" height="15px"></td><td></td><td></td><td style="text-align:right;">'+tonum(parseFloat(val.amt))+'</td></tr><tr><td height="5px"></td><td></td><td></td><td></td></tr><tr><td height="100px"></td><td id="particularhere"></td><td style="text-align:right;" id="particularamthere"></td><td></td></tr><tr><td height="100px"></td><td style="text-align:center;">'+tonum(parseFloat(val.amt))+'</td><td></td><td></td></tr>');

        $.each(val.misc, function(index1, val1) {
          $("#particularhere").append(val1.particular+"<br>");
          $("#particularamthere").append(tonum(parseFloat(val1.amt))+"<br>");
        });

      }else if(val.printingType=="AR"){
        $("#printor").append('<tr><td colspan="4" style="font-size: 20px;padding:1px;"><b>BUTUAN INFORMATION TECHNOLOGY SERVICES INC.</b></td></tr><td colspan="3" style="text-align:left;padding:1px;">Franchisee of ACLC College, 999 HDS Bldg. J.C. Aquino Ave., Butuan City</td><td width="200px" style="text-align:center;font-size: 20px;"><b>'+val.orNo+'</b></td></tr><tr><td width="150px"></td><td colspan="2" style="text-align:center;"><h4><b>ACKNOWLEDGEMENT RECEIPT</b></h4></td><td>'+toDate(val.date)+'</td></tr><tr><td width="150px"><b>Distribution:</b></td><td width="100px"></td><td width="400px"><b>Received from:</b></td><td></td></tr><tr><td rowspan="3" id="particularhere"></td><td rowspan="3" id="particularamthere" style="text-align:right;"></td><td>'+$(".fullname").text()+'</td><td>'+$("#courseinput").val()+'</td></tr><tr><td><b>Amount:</b></td><td></td></tr><tr><td colspan="2">'+inWords(val.amt)+' ('+tonum(parseFloat(val.amt))+')</td></tr><tr><td><b>Total:</b></td><td style="text-align:right;">'+tonum(parseFloat(val.amt))+'</td><td></td><td style="text-align:center;">______________________</td></tr><tr><td></td><td></td><td style="text-align:center;">'+getdatetimenow()+'</td><td style="text-align:center;">Cashier</td></tr>');

        $.each(val.misc, function(index1, val1) {
          $("#particularhere").append(val1.particular+"<br>");
          $("#particularamthere").append(tonum(parseFloat(val1.amt))+"<br>");
        });
      }
    });
    printContentor('toprintor')
  })
  .fail(function() {
    console.log("error ");
  })
}
function payamtkup(){
  var amt=0
  var cash=0
  if ($.isNumeric($("#payamt").val())==true) {
    amt=$("#payamt").val();
  }
  if ($.isNumeric($("#paycash").val())==true) {
    cash=$("#paycash").val();
  }
  if (cash!=0) {
    $("#paychange").val(cash-amt);
  }
  if ($.isNumeric($("#paychange").val())==true && $.isNumeric($("#paycash").val())==true && $("#paychange").val()>=0 && $("#paycash").val()>0) {
    if ($('#feeType').val()=="assessment") {
      if ($("#assessmentdispl").text()!="0.00") {
        $('#paymentbutton').attr("disabled", false);
      }else {
        $('#paymentbutton').attr("disabled", true);
      }
    }else {
      $('#paymentbutton').attr("disabled", false);
    }
  }else{
    $('#paymentbutton').attr("disabled", true);
  }
}
$('#paycash').keyup(function(){
  checkor()
});
$(document).on('click','#saveotherpayee',function(){
  var fname=$('#payeefname').val();
  var mname=$('#payeemname').val();
  var lname=$('#payeelname').val();
  var ext=$('#payeeext').val();
  var address=$('#payeeaddress').val();
  if (fname!="" || lname!="") {
    $.ajax({
      url: "<?php echo base_url('fees2/saveotherpayee') ?>",
      type: 'GET',
      dataType: 'JSON',
      data: {fname: fname,mname: mname,lname: lname,ext: ext,address: address},
    })
    .done(function(data) {
      $('#payeelabel2').text("");
      $('#payeelabel').text("Saved!");
      $('#payeefname').val("");
      $('#payeemname').val("");
      $('#payeelname').val("");
      $('#payeeext').val("");
      $('#payeeaddress').val("");
      setTimeout(function() {
        $('#modalotherpayee').modal('hide');
      }, 1000);
    })
    .fail(function() {
      console.log("error ");
    })
  }
  else
  {
    $('#payeelabel').text("");
    $('#payeelabel2').text("Firstname or Lastname must not be empty!");
  }


});
$(document).on('click','#searchres',function(){
  $('#search').val($(this).text());
  $('#accttype').val($(this).attr('data-accttype'));
  $('#otherpayeeaddress').val($(this).attr('data-payeeadd'));
  $('#studentid').val($(this).attr('data-id'));
  $('#oldacctno').val($(this).attr('data-acct'));
  $("#show-list").html('');
});

$(document).on('click','#searchrespart',function(){
  $('#searchpart').val($(this).text());
  $('#arr1').val($(this).attr('data-particularId'));
  $('#arr2').val($(this).attr('data-particularName'));
  $('#arr3').val($(this).attr('data-amt1'));
  $('#arr4').val($(this).attr('data-amt2'));

  $("#show-list-part").html('');
});

$(document).on('click','#searchstudent',function(){
  disableScreen()
  $('#searchstudent').attr("disabled", true);
  searchstudent()
});
function toTitleCase(str) {
  var lcStr = str.toLowerCase();
  return lcStr.replace(/(?:^|\s)\w/g, function(match) {
      return match.toUpperCase();
  });
}
function searchstudent()
{
  $('#paymentbutton').attr("disabled", true);
  $('#assessmentdiv').html("");
  $('#bridgingdiv').html("");
  $('#tutorialdiv').html("");
  $('#studloaddiv').html("");
  $('#otherpaymentsdiv').html("");
  $('#oldsystemdiv').html("");
  $('#rf1').html("");
  $('#rf2').html("");
  $('#as2').html("");
  $('#tbmain3').html("");
  $('#acct_no').html("");
  $('#usn_no').html("");
  $('#course').html("");
  $('#sysem').html("");
  $('#stat').html("");
  $('#assess_isgraduating').val("");
  $('#assess_status').val("");
  $('#assess_course').val("");
  $('#assess_isgraduating').val("");
  $('#assess_level').val("");
  $("#assessmentdispl").text("0.00")
  $("#oldaccdispl").text("0.00")
  $("#discountdispl").text("0.00")
  $("#rgdis").text("0.00")
  $("#paymentsdispl").text("0.00")
  $("#cbalancedispl").text("0.00")
  $("#tbalancedispl").text("0.00")
  if ($('#accttype').val()=="student") {
    $('#paytype option[value="assessment"]').attr("disabled", false);
    var fullDate = new Date()
    var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
    var currentDate =  twoDigitMonth + "/" + fullDate.getDate()+ "/" + fullDate.getFullYear();
    $('#Sibling').show();
    $('#FullPayment').show();
    var id = $('#studentid').val();
    var acctno = $('#oldacctno').val();
    var sy = $('#sy').val();
    var sem = $('#sem').val();
    var sem2 ="";
    var stud = false;
    var age =0
    if (sem=="1st") {
      sem2 = "First Semester"
    }else if (sem=="2nd") {
      sem2 = "Second Semester"
    }
    $.ajax({
      url: "<?php echo base_url('fees2/searchinfo') ?>",
      type: 'GET',
      dataType: 'JSON',
      data: {id: id,sem: sem,sy: sy,acctno: acctno},
    })
    .done(function(data) {
      console.log(data);
      $.each(data, function(index, val) {
        if(val.status!="No Data"){
          $(".paydiv").show()
          $('#addrefund').attr("disabled", false);
          var contact
          if (val.telephone_number == null || val.telephone_number == "")
          {
            contact=val.phone_number
          }
          else
          {
            contact=val.telephone_number
          }
          $('#as2').append('<tr><td style="text-align:center;" colspan="5">ACLC College of Butan City, Inc.</td></tr>');
          $('#as2').append('<tr><td style="text-align:center;" colspan="5">HDS Building JC Aquino Ave.</td></tr>');
          $('#as2').append('<tr><td align="left" colspan="3">Account Slip</td><td align="right" colspan="2">'+currentDate+'</td></tr>')
          $('#as2').append('<tr style="height:20px;"><td colspan="5"></td></tr>');
          $('#as2').append('<tr><td align="left" style="width:70%;" colspan="3">Name: '+val.fullname+'.</td><td colspan="2"> Student Class: '+val.studentStatus+'</td></tr>');
          $('#as2').append('<tr><td align="left" colspan="3">ID: '+val.usn_no+'</td><td colspan="2">  SY: '+sy+' Sem: '+sem+'</td></tr>');
          $('#as2').append('<tr><td align="left" colspan="3">Course: '+val.course+'</td><td colspan="2">   Year Level: '+val.year_level+'</td></tr>')
          $('#as2').append('<tr style="height:20px;" colspan="5"></tr>');
          age=getAge(val.birthdate)
          $('#rf2').append('<tr><td width="35px" height="50px"></td><td width="40px"></td><td width="50px"></td><td width="50px"></td><td width="50px"></td><td width="50px"></td><td width="35px"></td><td width="35px"></td><td width="120px"></td><td width="80px"></td><td width="100px"></td></tr>');
          $('#rf2').append('<tr><td></td><td></td><td></td><td colspan="7">'+val.fullname+'</td><td>'+changenull(val.phone_number)+'</td></tr>');
          $('#rf2').append('<tr><td></td><td></td><td colspan="5">'+age+'</td><td colspan="2">'+val.gender+'</td><td></td><td>'+val.civ_status+'</td></tr>');
          $('#rf2').append('<tr><td></td><td></td><td colspan="5">'+val.height+'</td><td colspan="2">'+val.weight+'</td><td></td><td>'+val.nationality+'</td></tr>');
          $('#rf2').append('<tr><td></td><td></td><td colspan="7">'+val.birthdate+'</td><td colspan="2">'+val.birthplace+'</td></tr>');
          $('#rf2').append('<tr><td height="25px"></td><td></td><td></td><td colspan="6">'+val.ffname+'</td><td colspan="2">'+val.fbirthdate+'</td></tr>');
          $('#rf2').append('<tr><td height="25px"></td><td></td><td></td><td></td><td colspan="7">'+val.foccupation+'</td></tr>');
          $('#rf2').append('<tr><td height="25px"></td><td></td><td></td><td colspan="6">'+val.mfname+'</td><td colspan="2">'+val.mbirthdate+'</td></tr>');
          $('#rf2').append('<tr><td height="25px"></td><td></td><td></td><td></td><td colspan="7">'+val.moccupation+'</td></tr>');
          $('#rf2').append('<tr><td height="25px"></td><td></td><td></td><td></td><td colspan="7">'+val.province_name+'</td></tr>');
          $('#rf2').append('<tr><td height="25px"></td><td></td><td></td><td></td><td colspan="7">'+val.city_name+'</td></tr>');
          $('#rf2').append('<tr><td height="25px"></td><td></td><td></td><td></td><td colspan="7">'+changenull(val.ftelephone_number)+'  '+changenull(val.mtelephone_number)+'</td></tr>');
          $('#rf2').append('<tr><td height="25px"></td><td></td><td></td><td></td><td colspan="7">'+val.gfname+'</td></tr>');
          $('#rf2').append('<tr><td height="25px"></td><td></td><td></td><td colspan="6">'+val.caddress+'</td><td colspan="2">'+changenull(val.gphone_number)+'</td></tr>');
          $('#rf2').append('<tr><td height="25px" colspan="8"></td><td colspan="3">'+val.cname+'</td</tr>');
          $('#rf2').append('<tr><td height="25px"></td><td></td><td></td><td colspan="6">'+val.caddress+'</td><td colspan="2">'+changenull(val.cnumber)+'</td></tr>');
          $('#rf1').append('<tr><td width="70px" height="80px"></td><td width="92px"></td><td width="90px"></td><td width="35px"></td><td width="48px"></td><td width="50px"></td><td width="60px"></td><td width="48px"></td><td width="60px"></td><td width="78px"></td><td width="62px"></td><td width="86px"></td></tr>');
          $('#rf1').append("<tr><td></td><td colspan='5'>"+val.usn_no+"</td><td></td><td></td><td></td><td id='studclass'>"+val.studentStatus+"</td><td></td><td></td></tr>");
          $('#rf1').append("<tr><td height='24px'></td><td colspan='5'>"+val.lname+", "+val.fname+" "+val.mname+"  "+val.suffix+"</td><td id='rgsem'>"+sem2+"</td><td></td><td></td><td align='right'>A.Y. "+sy+"</td><td></td><td></td></tr>");
          $('#rf1').append("<tr><td height='24px'></td><td colspan='5'>"+val.street+"</td><td colspan='2' align='center'>"+val.gfname+"</td><td></td><td>"+contact+"</td><td></td><td></td></tr>");
          $('#otherpayeeaddress').val(val.street);
          $('#rf1').append("<tr><td></td><td>"+toDate(val.birthdate)+"</td><td colspan='3' align='right'>"+val.birthplace+"</td><td align='right'>"+val.gender+"</td><td id='rgcourse' colspan='2' align='right'>"+val.course+"</td><td></td><td align='right'>"+val.year_level+"</td><td></td><td></td></tr>");
          $('#rf1').append('<tr><td height="20px"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>');
          var codename=""
          var td=""
          var row=0
          var unitleclab=0
          var sysemtu=0
          $.each(val.sched, function(index1, val1) {
            if (row==0)
            {
              td="<td>Tuition</td><td id='rgtuition' align='right'></td>"
            }
            else if(row==1)
            {
              td="<td>Lab.</td><td id='rglab' align='right'></td>"
            }
            else if(row==2)
            {
              td="<td>Misc.</td><td id='rgmisc' align='right'></td>"
            }
            else if(row==3)
            {
              td="<td>Other Fee</td><td id='rgother' align='right'></td>"
            }
            else if(row==4)
            {
              td="<td>Registration</td><td id='rgreg' align='right'></td>"
            }
            else if(row==5)
            {
              td="<td>Handling</td><td id='rghand' align='right'></td>"
            }
            else
            {
              td="<td></td><td></td>";
            }
            if (codename!=val1.subj_code+val1.subj_name) {
              unitleclab=parseFloat(val1.lec_unit)+parseFloat(val1.lab_unit)
              sysemtu=sysemtu+unitleclab
              $('#rf1').append('<tr><td>'+val1.subj_code+'</td><td colspan="2">'+val1.subj_name+'</td><td></td><td align="center">'+unitleclab+'</td><td align="center">'+val1.abbreviation+'</td><td align="center">'+val1.time_start+val1.time_end+'</td><td align="center">'+val1.room_code+'</td>'+td+'<td></td><td></td></tr>');
              row=row+1
              codename=val1.subj_code+val1.subj_name
            }
            else
            {
              $('#rf1').append('<tr><td></td><td colspan="2"></td><td></td><td align="center"></td><td align="center">'+val1.abbreviation+'</td><td align="center">'+val1.time_start+val1.time_end+'</td><td align="center">'+val1.room_code+'</td>'+td+'<td></td><td></td></tr>');
              row=row+1
            }
          });
          if (val.sched.length<6) {
            for (var i = row; i < 6; i++) {
              if (row==0)
              {
                td="<td>Tuition</td><td id='rgtuition' align='right'></td>"
              }
              else if(row==1)
              {
                td="<td>Lab.</td><td id='rglab' align='right'></td>"
              }
              else if(row==2)
              {
                td="<td>Misc.</td><td id='rgmisc' align='right'></td>"
              }
              else if(row==3)
              {
                td="<td>Other Fee</td><td id='rgother' align='right'></td>"
              }
              else if(row==4)
              {
                td="<td>Registration</td><td id='rgreg' align='right'></td>"
              }
              else if(row==5)
              {
                td="<td>Handling</td><td id='rghand' align='right'></td>"
              }
              else
              {
                td="<td></td><td></td>";
              }
              $('#rf1').append('<tr><td></td><td colspan="2"></td><td></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td>'+td+'<td></td><td></td></tr>');
                row=row+1
            }
          }
          $('#rf1').append('<tr><td></td><td colspan="2"></td><td></td><td align="center">'+sysemtu+'</td><td colspan="2"></td><td></td><td>Discount</td><td id="rgdis" align="right"></td><td></td><td></td></tr>');
          $('#rf1').append('<tr><td height="40px"></td><td colspan="2"></td><td></td><td></td><td colspan="2"></td><td></td><td>Total</td><td align="right"><b><h4 id="rgtass"></h4></b></td><td></td><td></td></tr>');
          $('#rf1').append('<tr><td></td><td></td><td colspan="2">ALAN L. ATEGA</td><td></td><td></td><td id="rgamt"><td></td></td><td id="rgor"></td><td align="right" id="rgdate"></td><td></td><td></td></tr>');

          var assesssysem=""
          var box=""
          var ft=''
          var amt2=0
          var asscount=0
          var totalass2=0
          $('.fullname').text($('#search').val());
          $('#enrollmentstatus').attr('class','text-success');
          $('#enrollmentstatus').html("<i class='glyphicon glyphicon-ok alert-primary'></i> Enrolled");
          $('#acct_no').html("<i class='glyphicon glyphicon-user'></i> "+acctno);
          $('#usn_no').html("<i class='glyphicon glyphicon-credit-card'></i> "+ val.usn_no);
          $('#course').html('<i class="glyphicon glyphicon-education"></i> '+val.course);
          $("#courseinput").val(val.course)
          $('#sysem').html('<i class="glyphicon glyphicon-calendar"></i> '+sy+' '+sem);
          $('#stat').html("<i class='glyphicon glyphicon-education'></i> "+val.studentStatus);
          $('#assess_isgraduating').val(val.is_graduating);
          $('#assess_status').val(val.studentStatus);
          $('#assess_course').val(val.course);
          $('#assess_isgraduating').val(val.is_graduating);
          $('#assess_level').val(val.level);
          // if (val.status=="enrolled") {
          //   $('.fullname').text($('#search').val());
          //   $('#enrollmentstatus').attr('class','text-success');
          //   $('#enrollmentstatus').html("<i class='glyphicon glyphicon-ok alert-primary'></i> Enrolled");
          //   $('#acct_no').html("<i class='glyphicon glyphicon-user'></i> "+acctno);
          //   $('#usn_no').html("<i class='glyphicon glyphicon-credit-card'></i> "+ val.usn_no);
          //   $('#course').html('<i class="glyphicon glyphicon-education"></i> '+val.course);
          //   $('#sysem').html('<i class="glyphicon glyphicon-calendar"></i> '+sy+' '+sem);
          //   $('#stat').html("<i class='glyphicon glyphicon-education'></i> "+val.studentStatus);
          //   $('#assess_isgraduating').val(val.is_graduating);
          //   $('#assess_status').val(val.studentStatus);
          //   $('#assess_course').val(val.course);
          //   $('#assess_isgraduating').val(val.is_graduating);
          //   $('#assess_level').val(val.level);
          // }
          // else
          // {
          //   $('.fullname').text($('#search').val());
          //   $('#enrollmentstatus').attr('class','text-danger');
          //   $('#enrollmentstatus').html("<i class='glyphicon glyphicon-remove alert-primary'></i> Not Enrolled");
          //   $('#acct_no').html("<i class='glyphicon glyphicon-user'></i> No Data");
          //   $('#usn_no').html("<i class='glyphicon glyphicon-credit-card'></i> No Data");
          //   $('#course').html('<i class="glyphicon glyphicon-education"></i> No Course');
          //   $('#sysem').html('<i class="glyphicon glyphicon-calendar"></i> '+sem+' '+sy+'');
          //   $('#stat').html("<i class='glyphicon glyphicon-education'></i> No Data");
          // }
          var rgtuition=0
          var rglab=0
          var rgmisc=0
          var rgother=0
          var rgreg=0
          var rghand=0
          var rgtotal=0
          $.each(val.assessment, function(index1, val1) {
            if ((sy+sem)==val1.sy+val1.sem) {
              if (val1.feeType=="Tuition") {
                rgtuition+=parseFloat(val1.amt2)
              }
              else if (val1.feeType=="Handling Fee")
              {
                rghand+=parseFloat(val1.amt2)
              }
              else if (val1.feeType=="Laboratory")
              {
                rglab+=parseFloat(val1.amt2)
              }
              else if (val1.feeType=="Miscellaneous")
              {
                rgmisc+=parseFloat(val1.amt2)
              }
              else if (val1.feeType=="Other Fee")
              {
                rgother+=parseFloat(val1.amt2)
              }
              else if (val1.feeType=="Registration Fee")
              {
                rgreg+=parseFloat(val1.amt2)
              }
            }
            asscount+=1
            if (assesssysem!=val1.sy+val1.sem) {
              $('#assessmentdiv').append('<div class="box"><div class="box-header with-border"><h3 class="box-title">'+val1.sy+' '+val1.sem+'</h3><div class="box-tools pull-right"></div></div><div class="box-body"><div class="row"><div class="col-md-6"><table id="asstb"><tbody id="'+val1.sy+val1.sem+'"><tr><td></td></tr></tbody></table></div><div class="row"><div class="col-md-6"><table id="assptb" class="table table-sm"><tbody id="pay'+val1.sy+val1.sem+'"><tr><td></td></tr></tbody></table></div></div></div><div class="box-footer"></div></div>')
              $('#pay'+val1.sy+val1.sem).append('<tr><td><h3><b>Asessment:</b></h3></td><td></td><td></td><td></td><td></td></tr>')
              if (amt2>0) {
                //$('#'+assesssysem).append('<tr><td>'+ft+' Total:</td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(amt2))+'</td></tr>')
                $('#pay'+assesssysem).append('<tr><td>'+ft+'</td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(amt2))+'</td></tr>')
                amt2=0
                $('#'+assesssysem).append('<tr><td></td><td></td><td id="hideamt2">______________</td><td></td></tr>')
                $('#'+assesssysem).append('<tr><td><b>TOTAL:</b></td><td></td><td id="hideamt2">'+tonum(parseFloat(totalass2))+'</td><td></td></tr>')
                $('#pay'+assesssysem).append('<tr><td></td><td></td><td></td><td></td><td id="hideamt2">______________</td></tr>')
                $('#pay'+assesssysem).append('<tr><td><b>TOTAL:</b></td><td></td><td></td><td></td><td id="hideamt2" class="asst'+assesssysem+'" data-id="'+totalass2+'">'+tonum(parseFloat(totalass2))+'</td></tr>')
                totalass2=0
              }
              assesssysem=val1.sy+val1.sem
              amt2=0
            }
            if (ft==val1.feeType) {
              $('#'+val1.sy+val1.sem).append('<tr><td></td><td>'+val1.particular+'</td><td id="hideamt2">'+tonum(parseFloat(val1.amt2))+'</td><td></td></tr>')
              amt2=(amt2+parseFloat(val1.amt2))
              totalass2=(totalass2+parseFloat(val1.amt2))
            }
            else
            {
              if (amt2>0) {
                //$('#'+val1.sy+val1.sem).append('<tr><td>'+ft+' Total:</td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(amt2))+'</td></tr>')
                $('#pay'+val1.sy+val1.sem).append('<tr><td>'+ft+'</td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(amt2))+'</td></tr>')
                amt2=0
              }
              ft=val1.feeType
              $('#'+val1.sy+val1.sem).append('<tr><td>'+val1.feeType+'</td><td></td><td></td><td></td></tr>')
              $('#'+val1.sy+val1.sem).append('<tr><td></td><td>'+val1.particular+'</td><td id="hideamt2">'+tonum(parseFloat(val1.amt2))+'</td><td></td></tr>')
              amt2=(amt2+parseFloat(val1.amt2))
              totalass2=(totalass2+parseFloat(val1.amt2))
            }

            if (asscount==val.assessment.length) {
              asscount=0
              //$('#'+assesssysem).append('<tr><td>'+ft+' Total:</td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(amt2))+'</td></tr>')
              $('#pay'+val1.sy+val1.sem).append('<tr><td>'+ft+'</td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(amt2))+'</td></tr>')
              amt2=0
              $('#'+assesssysem).append('<tr><td></td><td></td><td id="hideamt2">______________</td><td></td></tr>')
              $('#'+assesssysem).append('<tr><td><b>TOTAL:</b></td><td></td><td id="hideamt2">'+tonum(parseFloat(totalass2))+'</td><td></td></tr>')
              $('#pay'+assesssysem).append('<tr><td></td><td></td><td></td><td></td><td id="hideamt2">______________</td></tr>')
              $('#pay'+assesssysem).append('<tr><td><b>TOTAL:</b></td><td></td><td></td><td></td><td id="hideamt2"  class="asst'+assesssysem+'" data-id="'+totalass2+'">'+tonum(parseFloat(totalass2))+'</td></tr>')
              totalass2=0
            }
          });
          rgtotal=rgtuition+rglab+rgmisc+rgother+rgreg+rghand
          $("#rgtuition").text(tonum(parseFloat(rgtuition)))
          $("#rglab").text(tonum(parseFloat(rglab)))
          $("#rgmisc").text(tonum(parseFloat(rgmisc)))
          $("#rgother").text(tonum(parseFloat(rgother)))
          $("#rgreg").text(tonum(parseFloat(rgreg)))
          $("#rghand").text(tonum(parseFloat(rghand)))
          $("#rgtass").text(tonum(parseFloat(rgtotal)))
          var dissysem=""
          var distotal=0
          var discounter=0
          $.each(val.discount, function(index1, val1) {
          discounter+=1
            if (sy+sem==val1.sy+val1.sem) {
              if (val1.discountDesc=="Full Payment") {
                $('#FullPayment').hide();
              }
              if (val1.discountDesc=="Sibling") {
                $('#Sibling').hide();
              }
            }
            if (dissysem==val1.sy+val1.sem) {
              distotal=(distotal+parseFloat(val1.amt2))
              $('#pay'+dissysem).append('<tr><td>'+val1.discountDesc+'</td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(val1.amt2))+'</td><td></td></tr>')

            }
            else
            {
              if (distotal>0) {
                $('#pay'+dissysem).append('<tr><td></td><td></td><td></td><td></td><td id="hideamt2">______________</td></tr>')
                $('#pay'+dissysem).append('<tr><td>TOTAL:</td><td></td><td></td><td></td><td id="hideamt2" class="dist'+dissysem+'" data-id="'+distotal+'">'+tonum(parseFloat(distotal))+'</td></tr>')
                distotal=0
              }
              distotal=(distotal+parseFloat(val1.amt2))
              $('#pay'+val1.sy+val1.sem).append('<tr><td><h3><b>Discounts:</b></h3></td><td></td><td></td><td></td><td></td></tr>')
              $('#pay'+val1.sy+val1.sem).append('<tr><td>'+val1.discountDesc+'</td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(val1.amt2))+'</td><td></td></tr>')
            }
            if (discounter==val.discount.length) {
              $('#pay'+val1.sy+val1.sem).append('<tr><td></td><td></td><td></td><td></td><td id="hideamt2">______________</td></tr>')
              $('#pay'+val1.sy+val1.sem).append('<tr><td>TOTAL:</td><td></td><td></td><td></td><td id="hideamt2" class="dist'+val1.sy+val1.sem+'" data-id="'+distotal+'">'+tonum(parseFloat(distotal))+'</td></tr>')
            }
            dissysem=val1.sy+val1.sem
          });
          var or=""
          var paysysem=""
          var ortotal=0
          var totalpay=0
          $.each(val.assessmentPayments, function(index1, val1) {
            asscount+=1
            if (paysysem==val1.sy+val1.sem) {
              if (or==val1.orNo) {
                ortotal=(ortotal+parseFloat(val1.amt2))
                $('#pay'+paysysem).append('<tr><td></td><td></td><td>'+val1.feeType+'</td><td id="hideamt2">'+tonum(parseFloat(val1.amt2))+'</td><td></td></tr>')
              }
              else
              {
                //$('#pay'+paysysem).append('<tr><td></td><td></td><td></td><td id="hideamt2">______________</td><td></td></tr>')
                $('#pay'+paysysem).append('<tr><td>OR Total:</td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(ortotal))+'</td></tr>')
                totalpay=(totalpay+parseFloat(ortotal))
                $('#pay'+paysysem).append('<tr><td>'+toDate(val1.paymentDate)+'</td><td>'+val1.orNo+'</td><td>'+val1.feeType+'</td><td id="hideamt2">'+tonum(parseFloat(val1.amt2))+'</td><td></td></tr>')
                ortotal=0
                ortotal=(ortotal+parseFloat(val1.amt2))
              }
            }
            else
            {
              $('#pay'+val1.sy+val1.sem).append('<tr><td><h3><b>Payments:</b></h3></td><td></td><td></td><td></td><td></td></tr>')
              if (or==val1.orNo) {
                ortotal=(ortotal+parseFloat(val1.amt2))
                $('#pay'+val1.sy+val1.sem).append('<tr><td></td><td></td><td>'+val1.feeType+'</td><td id="hideamt2">'+tonum(parseFloat(val1.amt2))+'</td><td></td></tr>')
              }
              else
              {
                //$('#pay'+paysysem).append('<tr><td></td><td></td><td></td><td id="hideamt2">______________</td><td></td></tr>')
                $('#pay'+paysysem).append('<tr><td>OR Total:</td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(ortotal))+'</td></tr>')
                totalpay=(totalpay+parseFloat(ortotal))
                if (totalpay>0) {
                  $('#pay'+paysysem).append('<tr><td></td><td></td><td></td><td></td><td id="hideamt2">______________</td></tr>')
                  $('#pay'+paysysem).append('<tr><td>TOTAL:</td><td></td><td></td><td></td><td id="hideamt2" class="payt'+paysysem+'" data-id="'+totalpay+'">'+tonum(parseFloat(totalpay))+'</td></tr>')
                  totalpay=0
                }
                $('#pay'+val1.sy+val1.sem).append('<tr><td>'+toDate(val1.paymentDate)+'</td><td>'+val1.orNo+'</td><td>'+val1.feeType+'</td><td id="hideamt2">'+tonum(parseFloat(val1.amt2))+'</td><td></td></tr>')
                ortotal=0
                ortotal=(ortotal+parseFloat(val1.amt2))
              }
            }
            if (asscount==val.assessmentPayments.length) {
              //$('#pay'+paysysem).append('<tr><td></td><td></td><td></td><td id="hideamt2">______________</td><td></td></tr>')
              $('#pay'+val1.sy+val1.sem).append('<tr><td>OR Total:</td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(ortotal))+'</td></tr>')
              totalpay=(totalpay+parseFloat(ortotal))
              $('#pay'+val1.sy+val1.sem).append('<tr><td></td><td></td><td></td><td></td><td id="hideamt2">______________</td></tr>')
              $('#pay'+val1.sy+val1.sem).append('<tr><td>TOTAL:</td><td></td><td></td><td></td><td id="hideamt2" class="payt'+val1.sy+val1.sem+'" data-id="'+totalpay+'">'+tonum(parseFloat(totalpay))+'</td></tr>')
            }
            paysysem=val1.sy+val1.sem
            or=val1.orNo
          });
          var sysem=""
          var totalbal=0
          var tass=""
          var tdis=""
          var tpay=""
          var oldacc=0
          var fdis=0
          var fass=0
          var fpay=0
          var cbal=0
          var tbal=0
          $.each(val.assessment, function(index1, val1) {
            if (sysem!=val1.sy+val1.sem) {
              sysem=val1.sy+val1.sem
              tass=$(".asst"+sysem).data("id");
              tdis=$(".dist"+sysem).data("id");
              tpay=$(".payt"+sysem).data("id");
              if (tass=== undefined) {
                tass=0
              }
              if (tdis=== undefined) {
                tdis=0
              }
              if (tpay=== undefined) {
                tpay=0
              }
              totalbal=(tass-tdis)-tpay
              oldacc=oldacc+totalbal
              if (sysem==$('#sy').val()+$('#sem').val()) {
                oldacc=oldacc-totalbal
                cbal=totalbal
                fdis=tdis
                fass=tass
                fpay=tpay
                $("#assessmenttotal").val(totalbal);
              }
              $('#pay'+sysem).append('<tr><td></td><td></td><td></td><td></td><td id="hideamt2">______________</td></tr>')
              $('#pay'+sysem).append('<tr><td colspan="3"><h3><b>TOTAL BALANCE:</b></h3></td><td></td><td id="hideamt2" class="balpersem'+sysem+'"><h3><b>'+tonum(parseFloat(totalbal))+'</b></h3></td></tr>')

            }
          });
          // var oldass=0
          // var oldtutorial=0
          // var oldbridging=0
          // $.each(val.oldsystem, function(index1, val1) {
          //   oldass+=parseFloat(val1.ass)
          //   oldtutorial+=parseFloat(val1.tutorial)
          //   oldbridging+=parseFloat(val1.bridg)
          // });
          $("#assessmentdispl").text(tonum(parseFloat(fass)))
          $("#oldaccdispl").text(tonum(parseFloat(oldacc)))
          $("#discountdispl").text(tonum(parseFloat(fdis)))
          $("#rgdis").text(tonum(parseFloat(fdis)))
          $("#paymentsdispl").text(tonum(parseFloat(fpay)))
          $("#cbalancedispl").text(tonum(parseFloat(cbal)))
          $('#as2').append('<tr><td align="left" colspan="3" id="acoldac"> Old Account: '+tonum(parseFloat(oldacc))+'</td><td colspan="2">  Assessment: '+tonum(parseFloat(fass-fdis))+'</td></tr>')

          var totalbridg=0
          var totalbridgpay=0
          var totaltutor=0
          var totaltutorpay=0

          $('#bridgingdiv').append('<div class="box"><div class="box-header with-border"><h3 class="box-title">Bridging:</h3><div class="box-tools pull-right"></div></div><div class="box-body"><div class="row"><div class="col-md-6"><table id="bridgtb" class="table table-sm"><tbody id="bridgingtd"><tr><td></td></tr></tbody></table></div><div class="box-body"><div class="row"><div class="col-md-6"><table id="bridgptb" class="table table-sm"><tbody id="bridgingtdpay"><tr><td></td></tr></tbody></table></div></div><div class="box-footer"></div></div>')
          $('#bridgtb').append('<tr><td>Subjects</td><td></td><td></td><td></td></tr>')

          $.each(val.bridging, function(index1, val1) {
            totalbridg=totalbridg+parseFloat(val1.amt2)
            $('#bridgtb').append('<tr><td>'+val1.sy+'</td><td>'+val1.sem+'</td><td>'+val1.particular+'</td><td id="hideamt2">'+tonum(parseFloat(val1.amt2))+'</td></tr>')
          });
          if (totalbridg>0) {
            $('#paytype option[value="bridging"]').attr("disabled", false);
          }
          $('#bridgtb').append('<tr><td></td><td></td><td></td><td id="hideamt2">______________</td></tr>')
          $('#bridgtb').append('<tr><td>TOTAL BRIDGING</td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(totalbridg))+'</td></tr>')
          $('#bridgptb').append('<tr><td>Total Bridging</td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(totalbridg))+'</td></td></tr>')
          $('#bridgptb').append('<tr><td>Payments</td><td></td><td></td><td></td></tr>')

          $.each(val.bridgingPayments, function(index1, val1) {
            totalbridgpay=totalbridgpay+parseFloat(val1.amt2)
            $('#bridgptb').append('<tr><td>'+val1.orNo+'</td><td>'+val1.paymentDate+'</td><td></td><td id="hideamt2">'+tonum(parseFloat(val1.amt2))+'</td></tr>')
          });

          $('#bridgptb').append('<tr><td></td><td></td><td></td><td id="hideamt2">______________</td></tr>')
          $('#bridgptb').append('<tr><td>TOTAL PAYMENT</td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(totalbridgpay))+'</td></tr>')
          $('#bridgptb').append('<tr><td></td><td></td><td></td><td id="hideamt2">______________</td></tr>')
          $('#bridgptb').append('<tr><td><h3><b>TOTAL BALANCE</td></b></h3><td></td><td></td><td id="hideamt2"><h3><b>'+tonum(parseFloat(totalbridg-totalbridgpay))+'</b></h3></td></tr>')
          $("#bridgingdispl").text(tonum(parseFloat(totalbridg-totalbridgpay)));

          $('#tutorialdiv').append('<div class="box"><div class="box-header with-border"><h3 class="box-title">Tutorial:</h3><div class="box-tools pull-right"></div></div><div class="box-body"><div class="row"><div class="col-md-6"><table id="tutortb" class="table table-sm"><tbody id="tutorialtd"><tr><td></td></tr></tbody></table></div><div class="box-body"><div class="row"><div class="col-md-6"><table id="bridgptb" class="table table-sm"><tbody id="tutorptb"><tr><td></td></tr></tbody></table></div></div><div class="box-footer"></div></div>')
          $('#tutortb').append('<tr><td>Subjects</td><td></td><td></td><td></td></tr>')
          $.each(val.tutorial, function(index1, val1) {
            totaltutor=totaltutor+parseFloat(val1.amt2)
            $('#tutortb').append('<tr><td>'+val1.sy+'</td><td>'+val1.sem+'</td><td>'+val1.particular+'</td><td id="hideamt2">'+tonum(parseFloat(val1.amt2))+'</td></tr>')
          });
          if (totaltutor>0) {
            $('#paytype option[value="tutorial"]').attr("disabled", false);
          }
          $('#tutortb').append('<tr><td></td><td></td><td></td><td id="hideamt2">______________</td></tr>')
          $('#tutortb').append('<tr><td>TOTAL TUTORIAL</td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(totaltutor))+'</td></tr>')
          $('#tutorptb').append('<tr><td>Total Tutorial</td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(totaltutor))+'</td></td></tr>')
          $('#tutorptb').append('<tr><td>Payments</td><td></td><td></td><td></td></tr>')

          $.each(val.tutorialPayments, function(index1, val1) {
            totaltutorpay=totaltutorpay+parseFloat(val1.amt2)
            $('#tutorptb').append('<tr><td>'+val1.orNo+'</td><td>'+val1.paymentDate+'</td><td></td><td id="hideamt2">'+tonum(parseFloat(val1.amt2))+'</td></tr>')
          });

          $('#tutorptb').append('<tr><td></td><td></td><td></td><td id="hideamt2">______________</td></tr>')
          $('#tutorptb').append('<tr><td>TOTAL PAYMENT</td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(totaltutorpay))+'</td></tr>')
          $('#tutorptb').append('<tr><td></td><td></td><td></td><td id="hideamt2">______________</td></tr>')
          $('#tutorptb').append('<tr><td><h3><b>TOTAL BALANCE</td></b></h3><td></td><td></td><td id="hideamt2"><h3><b>'+tonum(parseFloat(totaltutor-totaltutorpay))+'</b></h3></td></tr>')
          $("#tutorialdispl").text(tonum(parseFloat(totaltutor-totaltutorpay)));

          tbal=(oldacc+cbal+totaltutor-totaltutorpay+totalbridg-totalbridgpay)
          $("#tbalancedispl").text(tonum(parseFloat(tbal)));

          var bp = oldacc+fass-fdis-fpay+(totaltutor-totaltutorpay+totalbridg-totalbridgpay);
          $('#as2').append('<tr><td align="left" colspan="3"> Tutorial: '+tonum(parseFloat((totaltutor-totaltutorpay)))+'</td><td colspan="2">  Payments: '+tonum(parseFloat(fpay))+'</td></tr>')
          $('#as2').append('<tr><td align="left" colspan="3"> Bridging: '+tonum(parseFloat((totalbridg-totalbridgpay)))+'</td><td colspan="2">  Balance Payable: '+tonum(parseFloat(bp))+'</td></tr>');
          $('#as2').append('<tr style="height:20px;"><td colspan="5"></td></tr>');
          $('#as2').append('<tr><td colspan="5"><table class="table table-sm" id="tbbd" border="1" style="width:100%;"><tbody id="tbbd1"></tbody></table></td></tr>');
          $('#tbbd1').append('<tr><td style="width:25%" align="center">Schedule of Payment</td><td style="width:10%" align="center">Term</td><td style="width:20%" align="center">Assessment</td><td style="width:25%" align="center">OldAcc/Bridging/Tutorial</td><td style="width:20%" align="center">Total</td></tr>');
          var totalobt=oldacc+(totaltutor-totaltutorpay+totalbridg-totalbridgpay)
          var pertermobt=totalobt/4
          if (val.level=="College") {
            var pre=((fass-fdis)*parseFloat(val.prelim))-fpay
            if (pre<0) {
              pre=0;
            }
            $('#tbbd1').append('<tr><td>'+val.dl1+'</td><td>Prelim</td><td align="center">'+tonum(parseFloat(pre))+'</td><td align="center">'+tonum(parseFloat(pertermobt))+'</td><td align="center">'+tonum(parseFloat(pre+pertermobt))+'</td></tr>');
            var mid=((fass-fdis)*parseFloat(val.midterm))-fpay-pre
            if (mid<0) {
              mid=0;
            }
            $('#tbbd1').append('<tr><td>'+val.dl2+'</td><td>Midterm</td><td align="center">'+tonum(parseFloat(mid))+'</td><td align="center">'+tonum(parseFloat(pertermobt))+'</td><td align="center">'+tonum(parseFloat(mid+pertermobt))+'</td></tr>');
            var pref=((fass-fdis)*parseFloat(val.prefinal))-fpay-pre-mid
            if (pref<0) {
              pref=0;
            }
            $('#tbbd1').append('<tr><td>'+val.dl3+'</td><td>Pre-Final</td><td align="center">'+tonum(parseFloat(pref))+'</td><td align="center">'+tonum(parseFloat(pertermobt))+'</td><td align="center">'+tonum(parseFloat(pref+pertermobt))+'</td></tr>');
            var fin=(fass-fdis)-fpay-pre-mid-pref
            if (fin<0) {
              fin=0;
            }
            $('#tbbd1').append('<tr><td>'+val.dl4+'</td><td>Final</td><td align="center">'+tonum(parseFloat(fin))+'</td><td align="center">'+tonum(parseFloat(pertermobt))+'</td><td align="center">'+tonum(parseFloat(fin+pertermobt))+'</td></tr>');

          }else{
            var pre=0
            var mid=0
            var pref=0
            var fin=0
            var perterm =(fass-fdis)*0.25
            if (totalpay>perterm)
            {
              totalpay=totalpay-perterm
              pre=0
            }
            else
            {
              pre=perterm-totalpay
              totalpay=0
            }
            $('#tbbd1').append('<tr><td>'+val.dl1+'</td><td>Prelim</td><td align="center">'+tonum(parseFloat(pre))+'</td><td align="center">'+tonum(parseFloat(pertermobt))+'</td><td align="center">'+tonum(parseFloat(pre+pertermobt))+'</td></tr>');
            if (totalpay>perterm)
            {
              totalpay=totalpay-perterm
              mid=0
            }
            else
            {
              mid=perterm-totalpay
              totalpay=0
            }
            $('#tbbd1').append('<tr><td>'+val.dl2+'</td><td>Midterm</td><td align="center">'+tonum(parseFloat(mid))+'</td><td align="center">'+tonum(parseFloat(pertermobt))+'</td><td align="center">'+tonum(parseFloat(mid+pertermobt))+'</td></tr>');
            if (totalpay>perterm)
            {
              totalpay=totalpay-perterm
              pref=0
            }
            else
            {
              pref=perterm-totalpay
              totalpay=0
            }
            $('#tbbd1').append('<tr><td>'+val.dl3+'</td><td>Pre-Final</td><td align="center">'+tonum(parseFloat(pref))+'</td><td align="center">'+tonum(parseFloat(pertermobt))+'</td><td align="center">'+tonum(parseFloat(pref+pertermobt))+'</td></tr>');
            if (totalpay>perterm)
            {
              totalpay=totalpay-perterm
              fin=0
            }
            else
            {
              fin=perterm-totalpay
              totalpay=0
            }
            $('#tbbd1').append('<tr><td>'+val.dl4+'</td><td>Final</td><td align="center">'+tonum(parseFloat(fin))+'</td><td align="center">'+tonum(parseFloat(pertermobt))+'</td><td align="center">'+tonum(parseFloat(fin+pertermobt))+'</td></tr>');

          }
          var myElement = document.getElementById("rf1").innerHTML;
          $('#as2').append('<tr style="height:20px;"><td colspan="5"></td></tr>');
          $('#as2').append('<tr style="height:20px;"><td>School Year:</td><td>Sem:</td><td>Asessment:</td><td></td><td></td></tr>');
          var newsysass=0
          var newsyssysem=""
          $.each(val.oldaccnewsys, function(index1, val1) {
            $('#as2').append('<tr style="height:20px;"><td>'+val1.sy+'</td><td>'+val1.sem+'</td><td>'+val1.ass+'</td><td></td><td></td></tr>');
          });
          $.each(val.oldsystem, function(index1, val1) {
            $('#as2').append('<tr style="height:20px;"><td>'+val1.sy+'</td><td>'+val1.sem+'</td><td>'+val1.ass+'</td><td></td><td></td></tr>');
          });
          $('#tbmain3').append(myElement);
          var lab=0
          var lec=0
          var totalunit=0
          var studloadsysem=""
          var subj_code=""
          var slcount=0
          var row=0
          var desc=""
          var desc2=""
          var td=""
          var unitleclab=0
          var sysemtu=0
          $.each(val.studload, function(index1, val1) {
            if (studloadsysem!=val1.sy+val1.sem) {
              if (studloadsysem==sy+sem) {
                $('#assess_totalunit').val(totalunit);
                $('#assess_labunit').val(lab);
              }
              $('#studloadtd'+studloadsysem).append("<tr><td></td><td></td><td></td><td colspan='2' id='hideamt2'><h5><b>Lab: "+lab+"</b></h4></td><td colspan='2' id='hideamt2'><h5><b>Lec: "+lec+"</b></h4></td><td colspan='2' id='hideamt2'><h5><b>Total Unit: "+totalunit+"</b></h3></td></tr>")
              lab=0
              lec=0
              totalunit=0
              $('#studloaddiv').append('<div class="box"><div class="box-header with-border"><h3 class="box-title">'+val1.sy+' '+val1.sem+'</h3><div class="box-tools pull-right"></div></div><div class="box-body"><div class="row"><div class="col-md-12"><table id="studloadtb" class="table table-sm"><tbody id="studloadtd'+val1.sy+val1.sem+'"><tr><td></td></tr></tbody></table></div><div class="box-body"><div class="box-footer"></div></div>')
              $('#studloadtd'+val1.sy+val1.sem).append("<tr><td width='110px'>Subject Code</td><td width='450px'>Subject Name</td><td>Lab Type</td><td>Lab</td><td>Lec</td><td>Room</td><td>Day</td><td>Time Start</td><td>Time End</td></tr>")
              if (subj_code!=val1.subj_code+val1.subj_name) {
                $('#studloadtd'+val1.sy+val1.sem).append('<tr><td>'+val1.subj_code+'</td><td>'+val1.subj_name+'</td><td>'+val1.labType+'</td><td>'+val1.lab_unit+'</td><td>'+val1.lec_unit+'</td><td>'+val1.room_code+'</td><td>'+val1.abbreviation+'</td><td>'+val1.time_start+'</td><td>'+val1.time_end+'</td></tr>')
                lab=lab+parseFloat(val1.lab_unit)
                lec=lec+parseFloat(val1.lec_unit)
                totalunit=totalunit+parseFloat(val1.lec_unit)+parseFloat(val1.lab_unit)
              }
              else
              {

                $('#studloadtd'+val1.sy+val1.sem).append('<tr><td></td><td></td><td></td><td></td><td></td><td>'+val1.room_code+'</td><td>'+val1.abbreviation+'</td><td>'+val1.time_start+'</td><td>'+val1.time_end+'</td></tr>')
              }
            }
            else
            {
              if (subj_code!=val1.subj_code+val1.subj_name) {
                $('#studloadtd'+val1.sy+val1.sem).append('<tr><td>'+val1.subj_code+'</td><td>'+val1.subj_name+'</td><td>'+val1.labType+'</td><td>'+val1.lab_unit+'</td><td>'+val1.lec_unit+'</td><td>'+val1.room_code+'</td><td>'+val1.abbreviation+'</td><td>'+val1.time_start+'</td><td>'+val1.time_end+'</td></tr>')
                lab=lab+parseFloat(val1.lab_unit)
                lec=lec+parseFloat(val1.lec_unit)
                totalunit=totalunit+parseFloat(val1.lec_unit)+parseFloat(val1.lab_unit)
              }
              else
              {
                $('#studloadtd'+val1.sy+val1.sem).append('<tr><td></td><td></td><td></td><td></td><td></td><td>'+val1.room_code+'</td><td>'+val1.abbreviation+'</td><td>'+val1.time_start+'</td><td>'+val1.time_end+'</td></tr>')
              }
            }

            subj_code=val1.subj_code+val1.subj_name
            studloadsysem=val1.sy+val1.sem
            slcount+=1
            if (slcount==val.studload.length) {
              if (studloadsysem==sy+sem) {
                $('#assess_totalunit').val(totalunit);
                $('#assess_labunit').val(lab);
              }
              $('#studloadtd'+studloadsysem).append("<tr><td></td><td></td><td></td><td colspan='2' id='hideamt2'><h5><b>Lab: "+lab+"</b></h4></td><td colspan='2' id='hideamt2'><h5><b>Lec: "+lec+"</b></h4></td><td colspan='2' id='hideamt2'><h5><b>Total Unit: "+totalunit+"</b></h4></td></tr>")
              lab=0
              lec=0
              totalunit=0
            }
          });


          var opsysem=""
          var opor=""
          var oportotal=0
          var opcount=0
          $.each(val.otherPayments, function(index1, val1) {
            if (opsysem!=val1.sy+val1.sem) {
              $('#otherpaymentsdiv').append('<div class="box"><div class="box-header with-border"><h3 class="box-title">'+val1.sy+' '+val1.sem+'</h3><div class="box-tools pull-right"></div></div><div class="box-body"><div class="row"><div class="col-md-8"><table id="otherpaymentstb" class="table table-sm"><tbody id="otherpaymentstd'+val1.sy+val1.sem+'"><tr><td></td></tr></tbody></table></div><div class="box-body"><div class="box-footer"></div></div>')
            }
            if (opor!=val1.orNo) {
              $('#otherpaymentstd'+opsysem).append("<tr><td></td><td></td><td></td><td id='hideamt2'>______________</td><td></td></tr>")
              $('#otherpaymentstd'+opsysem).append("<tr><td>OR Total: </td><td></td><td></td><td id='hideamt2'>"+oportotal+"</td><td></td></tr>")
              oportotal=0
              $('#otherpaymentstd'+val1.sy+val1.sem).append("<tr><td>"+val1.paymentDate+"</td><td>"+val1.orNo+"</td><td>"+val1.particularName+"</td><td id='hideamt2'>"+val1.amt2+"</td><td></td></tr>")
            }
            else
            {
              $('#otherpaymentstd'+val1.sy+val1.sem).append("<tr><td></td><td></td><td>"+val1.particularName+"</td><td id='hideamt2'>"+val1.amt2+"</td><td></td></tr>")
            }
            oportotal=oportotal+parseFloat(val1.amt2)
            opcount+=1
            if (opcount==val.otherPayments.length) {
              $('#otherpaymentstd'+opsysem).append("<tr><td></td><td></td><td></td><td id='hideamt2'>______________</td><td></td></tr>")
              $('#otherpaymentstd'+opsysem).append("<tr><td>OR Total: </td><td></td><td></td><td id='hideamt2'>"+oportotal+"</td><td></td></tr>")
            }
            opsysem=val1.sy+val1.sem
            opor=val1.orNo
          })
          // var oldassesssysem=""
          // var oldasstotal=0
          // var oldasscount=0
          // $.each(val.oldsystembreakdown.assessment, function(index1, val1) {
          //   oldasscount+=1
          //   if (oldassesssysem!=val1.sy+val1.sem) {
          //     $('#oldsystemdiv').append('<div class="box"><div class="box-header with-border"><h3 class="box-title">'+val1.sy+' '+val1.sem+'</h3></div><div class="box-body"><div class="row"><div class="col-md-5"><table class="table table-sm"><thead></thead><tbody id="oldass'+val1.sy+val1.sem+'"><tr><td colspan="2"><h4><b>Assessment:</b></h4></td><td></tr></tbody></table></div><div class="col-md-7"><table class="table table-sm"><tbody id="oldpay'+val1.sy+val1.sem+'"><tr><td colspan="2"><h4><b>Assessment Payment:</b></h4></td><td></td><td></td></tr></tbody></table></div></div><div class="row"><div class="col-md-5"><table class="table table-sm"><thead></thead><tbody id="oldbridging'+val1.sy+val1.sem+'"><tr><td colspan="2"><h4><b>Bridging:</b></h4></td><td></tr></tbody></table></div><div class="col-md-7"><table class="table table-sm"><tbody id="oldbridgingpay'+val1.sy+val1.sem+'"><tr><td colspan="2"><h4><b>Bridging Payment:</b></h4></h4></td><td></td><td></td></tr></tbody></table></div></div><div class="row"><div class="col-md-5"><table class="table table-sm"><thead></thead><tbody id="oldtutorial'+val1.sy+val1.sem+'"><tr><td colspan="2"><h4><b>Tutorial:</b></h4></td><td></tr></tbody></table></div><div class="col-md-7"><table class="table table-sm"><tbody id="oldtutorialpay'+val1.sy+val1.sem+'"><tr><td colspan="2"><h4><b>Tutorial Payment:</b></h4></h4></td><td></td><td></td></tr></tbody><tfoot id="Total'+val1.sy+val1.sem+'"><tr><td><h4><b>Total Balance: </b></h4></td><td></td><td></td><td></td><td></td></tr></tfoot></table></div></div></div></div>');
          //     if (oldasstotal!=0) {
          //       $('#oldass'+oldassesssysem).append("<tr><td></td><td align='right'>______________</td></tr>");
          //       $('#oldass'+oldassesssysem).append("<tr><td>Assessment Total: </td><td align='right' id='oldasstotal"+oldassesssysem+"' data='"+oldasstotal+"'>"+tonum(oldasstotal)+"</td></tr>");
          //       $('#oldass'+oldassesssysem).append("<tr><td></td><td align='right'></td></tr>");
          //       $('#oldass'+oldassesssysem).append("<tr><td><h4><b>Discount: </b></h4></td><td align='right'></td></tr>");
          //     }
          //     oldasstotal=0
          //     oldassesssysem=val1.sy+val1.sem
          //   }
          //   $('#oldass'+val1.sy+val1.sem).append("<tr><td>"+val1.particular+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //   oldasstotal=oldasstotal+parseFloat(val1.amt)
          //   if (oldasscount==val.oldsystembreakdown.assessment.length) {
          //     $('#oldass'+val1.sy+val1.sem).append("<tr><td></td><td align='right'>______________</td></tr>");
          //     $('#oldass'+val1.sy+val1.sem).append("<tr><td>Assessment Total: </td><td align='right' id='oldasstotal"+val1.sy+val1.sem+"' data='"+oldasstotal+"'>"+tonum(oldasstotal)+"</td></tr>");
          //     $('#oldass'+val1.sy+val1.sem).append("<tr><td></td><td align='right'></td></tr>");
          //     $('#oldass'+val1.sy+val1.sem).append("<tr><td><h4><b>Discount: </b></h4></td><td align='right'></td></tr>");
          //   }
          // });
          // var olddissysem=""
          // var olddis=0
          // var olddiscount=0
          // $.each(val.oldsystembreakdown.discount, function(index1, val1) {
          //   olddiscount+=1
          //   if (olddissysem!=val1.sy+val1.sem) {
          //     $('#oldass'+olddissysem).append("<tr><td></td><td align='right'>______________</td></tr>");
          //     $('#oldass'+olddissysem).append("<tr><td>Discount Total: </td><td align='right' id='olddistotal"+val1.sy+val1.sem+"' data='"+olddis+"'>"+tonum(olddis)+"</td></tr>");
          //     olddis=0
          //     $('#oldass'+val1.sy+val1.sem).append("<tr><td>"+val1.discount+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //   }
          //   else
          //   {
          //     $('#oldass'+olddissysem).append("<tr><td>"+val1.discount+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //   }
          //   olddis+=parseFloat(val1.amt)
          //   if (olddiscount==val.oldsystembreakdown.discount.length) {
          //     $('#oldass'+val1.sy+val1.sem).append("<tr><td></td><td align='right'>______________</td></tr>");
          //     $('#oldass'+val1.sy+val1.sem).append("<tr><td>Discount Total: </td><td align='right' id='olddistotal"+val1.sy+val1.sem+"' data='"+olddis+"'>"+tonum(olddis)+"</td></tr>");
          //   }
          //   olddissysem=val1.sy+val1.sem
          // });
          // var oldpayor=""
          // var oldpaytotal=0
          // var oldpaycount=0
          // var oldpaysysem=""
          // var sysempaytotal=0
          // $.each(val.oldsystembreakdown.payment, function(index1, val1) {
          //
          //   oldpaycount+=1
          //   if (oldpaysysem!=val1.sy+val1.sem) {
          //     if (oldpayor!=val1.or){
          //       if (oldpaytotal!=0) {
          //         $('#oldpay'+oldpaysysem).append("<tr><td>OR Total: </td><td></td><td></td><td></td><td align='right'>"+tonum(oldpaytotal)+"</td></tr>");
          //         oldpaytotal=0
          //       }
          //       if (sysempaytotal!=0) {
          //         $('#oldpay'+oldpaysysem).append("<tr></td><td></td><td></td><td></td><td></td><td align='right'>______________</td></tr>");
          //         $('#oldpay'+oldpaysysem).append("<tr></td><td>Payment Total:</td><td></td><td></td><td></td><td align='right' id='oldpaytotal"+oldpaysysem+"' data='"+sysempaytotal+"'>"+tonum(sysempaytotal)+"</td></tr>");
          //         sysempaytotal=0
          //       }
          //       $('#oldpay'+val1.sy+val1.sem).append("<tr></td><td>"+toDate(val1.date)+"</td><td>"+val1.or+"</td><td>"+val1.particular+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //     }
          //     else
          //     {
          //       $('#oldpay'+val1.sy+val1.sem).append("<tr></td><td></td><td></td><td>"+val1.particular+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //     }
          //   }
          //   else
          //   {
          //     if (oldpayor!=val1.or){
          //       if (oldpaytotal!=0) {
          //         $('#oldpay'+val1.sy+val1.sem).append("<tr><td>OR Total: </td><td></td><td></td><td></td><td align='right'>"+tonum(oldpaytotal)+"</td></tr>");
          //         oldpaytotal=0
          //       }
          //       $('#oldpay'+val1.sy+val1.sem).append("<tr></td><td>"+toDate(val1.date)+"</td><td>"+val1.or+"</td><td>"+val1.particular+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //     }
          //     else
          //     {
          //       $('#oldpay'+val1.sy+val1.sem).append("<tr></td><td></td><td></td><td>"+val1.particular+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //     }
          //   }
          //   oldpaytotal+=parseFloat(val1.amt)
          //   sysempaytotal+=parseFloat(val1.amt)
          //   if (oldpaycount==val.oldsystembreakdown.payment.length) {
          //     $('#oldpay'+val1.sy+val1.sem).append("<tr><td>OR Total: </td><td></td><td></td><td></td><td align='right'>"+tonum(oldpaytotal)+"</td></tr>");
          //     $('#oldpay'+val1.sy+val1.sem).append("<tr></td><td></td><td></td><td></td><td></td><td align='right'>______________</td></tr>");
          //     $('#oldpay'+val1.sy+val1.sem).append("<tr></td><td>Payment Total:</td><td></td><td></td><td></td><td align='right' id='oldpaytotal"+val1.sy+val1.sem+"' data='"+sysempaytotal+"'>"+tonum(sysempaytotal)+"</td></tr>");
          //   }
          //   oldpayor=val1.or
          //   oldpaysysem=val1.sy+val1.sem
          // });
          // var oldbridgsysem=""
          // var oldbridg=0
          // var oldbridgcount=0
          // $.each(val.oldsystembreakdown.bridging, function(index1, val1) {
          //   oldbridgcount+=1
          //   if (oldbridgsysem!=val1.sy+val1.sem) {
          //     $('#oldbridging'+oldbridgsysem).append("<tr><td></td><td align='right'>______________</td></tr>");
          //     $('#oldbridging'+oldbridgsysem).append("<tr><td>Bridging Total: </td><td align='right' id='oldbridgtotal"+val1.sy+val1.sem+"' data='"+oldbridg+"'>"+tonum(oldbridg)+"</td></tr>");
          //     oldbridg=0
          //     $('#oldbridging'+val1.sy+val1.sem).append("<tr><td>"+val1.subject+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //   }
          //   else
          //   {
          //     $('#oldbridging'+oldbridgsysem).append("<tr><td>"+val1.subject+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //   }
          //   oldbridg+=parseFloat(val1.amt)
          //   if (oldbridgcount==val.oldsystembreakdown.bridging.length) {
          //     $('#oldbridging'+val1.sy+val1.sem).append("<tr><td></td><td align='right'>______________</td></tr>");
          //     $('#oldbridging'+val1.sy+val1.sem).append("<tr><td>Bridging Total: </td><td align='right' id='oldbridgtotal"+val1.sy+val1.sem+"' data='"+oldbridg+"'>"+tonum(oldbridg)+"</td></tr>");
          //   }
          //   oldbridgsysem=val1.sy+val1.sem
          // });
          // var oldbridgpayor=""
          // var oldbridgpaytotal=0
          // var oldbridgpaycount=0
          // var oldbridgpaysysem=""
          // var sysembridgpaytotal=0
          // $.each(val.oldsystembreakdown.bridgingpay, function(index1, val1) {
          //
          //   oldbridgpaycount+=1
          //   if (oldbridgpaysysem!=val1.sy+val1.sem) {
          //     if (oldbridgpayor!=val1.or){
          //       if (oldbridgpaytotal!=0) {
          //         $('#oldbridgingpay'+oldbridgpaysysem).append("<tr><td>OR Total: </td><td></td><td></td><td></td><td align='right'>"+tonum(oldbridgpaytotal)+"</td></tr>");
          //         oldbridgpaytotal=0
          //       }
          //       if (sysembridgpaytotal!=0) {
          //         $('#oldbridgingpay'+oldbridgpaysysem).append("<tr></td><td></td><td></td><td></td><td></td><td align='right'>______________</td></tr>");
          //         $('#oldbridgingpay'+oldbridgpaysysem).append("<tr></td><td>Bridging Payment Total:</td><td></td><td></td><td></td><td align='right' id='oldbridgpaytotal"+oldbridgpaysysem+"' data='"+sysembridgpaytotal+"'>"+tonum(sysembridgpaytotal)+"</td></tr>");
          //         sysembridgpaytotal=0
          //       }
          //       $('#oldbridgingpay'+val1.sy+val1.sem).append("<tr></td><td>"+toDate(val1.date)+"</td><td>"+val1.or+"</td><td>"+val1.subject+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //     }
          //     else
          //     {
          //       $('#oldbridgingpay'+val1.sy+val1.sem).append("<tr></td><td></td><td></td><td>"+val1.subject+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //     }
          //   }
          //   else
          //   {
          //     if (oldbridgpayor!=val1.or){
          //       if (oldbridgpaytotal!=0) {
          //         $('#oldbridgingpay'+val1.sy+val1.sem).append("<tr><td>OR Total: </td><td></td><td></td><td></td><td align='right'>"+tonum(oldbridgpaytotal)+"</td></tr>");
          //         oldbridgpaytotal=0
          //       }
          //       $('#oldbridgingpay'+val1.sy+val1.sem).append("<tr></td><td>"+toDate(val1.date)+"</td><td>"+val1.or+"</td><td>"+val1.subject+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //     }
          //     else
          //     {
          //       $('#oldbridgingpay'+val1.sy+val1.sem).append("<tr></td><td></td><td></td><td>"+val1.subject+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //     }
          //   }
          //   oldbridgpaytotal+=parseFloat(val1.amt)
          //   sysembridgpaytotal+=parseFloat(val1.amt)
          //   if (oldbridgpaycount==val.oldsystembreakdown.bridgingpay.length) {
          //     $('#oldbridgingpay'+val1.sy+val1.sem).append("<tr><td>OR Total: </td><td></td><td></td><td></td><td align='right'>"+tonum(oldbridgpaytotal)+"</td></tr>");
          //     $('#oldbridgingpay'+val1.sy+val1.sem).append("<tr></td><td></td><td></td><td></td><td></td><td align='right'>______________</td></tr>");
          //     $('#oldbridgingpay'+val1.sy+val1.sem).append("<tr></td><td>Bridging Payment Total:</td><td></td><td></td><td></td><td align='right' id='oldbridgpaytotal"+val1.sy+val1.sem+"' data='"+sysembridgpaytotal+"'>"+tonum(sysembridgpaytotal)+"</td></tr>");
          //   }
          //   oldbridgpayor=val1.or
          //   oldbridgpaysysem=val1.sy+val1.sem
          // });
          // var oldtutorialsysem=""
          // var oldtutorial=0
          // var oldtutorialcount=0
          // $.each(val.oldsystembreakdown.tutorial, function(index1, val1) {
          //   oldtutorialcount+=1
          //   if (oldtutorialsysem!=val1.sy+val1.sem) {
          //     $('#oldtutorial'sysem).append("<tr><td></td><td align='right'>______________</td></tr>");
          //     $('#oldtutorial'sysem).append("<tr><td>Tutorial Total: </td><td align='right' id='oldtutorialtotal"sysem+"' data='"+"'>"+tonum(oldtutorial)+"</td></tr>");
          //     oldtutorial=0
          //     $('#oldtutorial'+val1.sy+val1.sem).append("<tr><td>"+val1.subject+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //   }
          //   else
          //   {
          //     $('#oldtutorial'sysem).append("<tr><td>"+val1.subject+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //   }
          //   oldtutorial+=parseFloat(val1.amt)
          //   if (oldtutorialcount==val.oldsystembreakdown.tutorial.length) {
          //     $('#oldtutorial'+val1.sy+val1.sem).append("<tr><td></td><td align='right'>______________</td></tr>");
          //     $('#oldtutorial'+val1.sy+val1.sem).append("<tr><td>Tutorial Total: </td><td align='right' id='oldtutorialtotal"+val1.sy+val1.sem+"' data='"+"'>"+tonum(oldtutorial)+"</td></tr>");
          //   }
          //   oldtutorialsysem=val1.sy+val1.sem
          // });
          // var oldtutorialpayor=""
          // var oldtutorialpaytotal=0
          // var oldtutorialpaycount=0
          // var oldtutorialpaysysem=""
          // var sysemtutorialpaytotal=0
          // $.each(val.oldsystembreakdown.tutorialpayment, function(index1, val1) {
          //
          //   oldtutorialpaycount+=1
          //   if (oldtutorialpaysysem!=val1.sy+val1.sem) {
          //     if (oldtutorialpayor!=val1.or){
          //       if (oldtutorialpaytotal!=0) {
          //         $('#oldtutorialpay'paysysem).append("<tr><td>OR Total: </td><td></td><td></td><td></td><td align='right'>"+tonum(oldtutorialpaytotal)+"</td></tr>");
          //         oldtutorialpaytotal=0
          //       }
          //       if (sysemtutorialpaytotal!=0) {
          //         $('#oldtutorialpay'paysysem).append("<tr></td><td></td><td></td><td></td><td></td><td align='right'>______________</td></tr>");
          //         $('#oldtutorialpay'paysysem).append("<tr></td><td>Toturial Payment Total:</td><td></td><td></td><td></td><td align='right' id='oldtutorialpaytotal"paysysem+"' data='"+sysemtutorialpaytotal+"'>"+tonum(sysemtutorialpaytotal)+"</td></tr>");
          //         sysemtutorialpaytotal=0
          //       }
          //       $('#oldtutorialpay'+val1.sy+val1.sem).append("<tr></td><td>"+toDate(val1.date)+"</td><td>"+val1.or+"</td><td>"+val1.subject+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //     }
          //     else
          //     {
          //       $('#oldtutorialpay'+val1.sy+val1.sem).append("<tr></td><td></td><td></td><td>"+val1.subject+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //     }
          //   }
          //   else
          //   {
          //     if (oldtutorialpayor!=val1.or){
          //       if (oldtutorialpaytotal!=0) {
          //         $('#oldtutorialpay'+val1.sy+val1.sem).append("<tr><td>OR Total: </td><td></td><td></td><td></td><td align='right'>"+tonum(oldtutorialpaytotal)+"</td></tr>");
          //         oldtutorialpaytotal=0
          //       }
          //       $('#oldtutorialpay'+val1.sy+val1.sem).append("<tr></td><td>"+toDate(val1.date)+"</td><td>"+val1.or+"</td><td>"+val1.subject+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //     }
          //     else
          //     {
          //       $('#oldtutorialpay'+val1.sy+val1.sem).append("<tr></td><td></td><td></td><td>"+val1.subject+"</td><td align='right'>"+tonum(parseFloat(val1.amt))+"</td></tr>");
          //     }
          //   }
          //   oldtutorialpaytotal+=parseFloat(val1.amt)
          //   sysemtutorialpaytotal+=parseFloat(val1.amt)
          //   if (oldtutorialpaycount==val.oldsystembreakdown.tutorialpayment.length) {
          //     $('#oldtutorialpay'+val1.sy+val1.sem).append("<tr><td>OR Total: </td><td></td><td></td><td></td><td align='right'>"+tonum(oldtutorialpaytotal)+"</td></tr>");
          //     $('#oldtutorialpay'+val1.sy+val1.sem).append("<tr></td><td></td><td></td><td></td><td></td><td align='right'>______________</td></tr>");
          //     $('#oldtutorialpay'+val1.sy+val1.sem).append("<tr></td><td>Toturial Payment Total:</td><td></td><td></td><td></td><td align='right' id='oldtutorialpaytotal"+val1.sy+val1.sem+"' data='"+sysemtutorialpaytotal+"'>"+tonum(sysemtutorialpaytotal)+"</td></tr>");
          //   }
          //   oldtutorialpayor=val1.or
          //   oldtutorialpaysysem=val1.sy+val1.sem
          // });
          // var sysemcount=""
          // $.each(val.oldsystembreakdown.assessment, function(index1, val1) {
          //   if (sysemcount!=val1.sy+val1.sem) {
          //     var asstotal=$('#oldasstotal'+val1.sy+val1.sem).attr('data')
          //     if (typeof(asstotal) == "undefined"){
          //     asstotal=0
          //     }
          //     var distotal=$('#olddistotal'+val1.sy+val1.sem).attr('data')
          //     if (typeof(distotal) == "undefined"){
          //     distotal=0
          //     }
          //     var paytotal=$('#oldpaytotal'+val1.sy+val1.sem).attr('data')
          //     if (typeof(paytotal) == "undefined"){
          //     paytotal=0
          //     }
          //     var britotal=$('#oldbridgtotal'+val1.sy+val1.sem).attr('data')
          //     if (typeof(britotal) == "undefined"){
          //     britotal=0
          //     }
          //     var bridgpaytotal=$('#oldbridgpaytotal'+val1.sy+val1.sem).attr('data')
          //     if (typeof(bridgpaytotal) == "undefined"){
          //     bridgpaytotal=0
          //     }
          //     var tutortotal=$('#oldtutorialtotal'+val1.sy+val1.sem).attr('data')
          //     if (typeof(tutortotal) == "undefined"){
          //     tutortotal=0
          //     }
          //     var tutorpaytotal=$('#oldtutorialpaytotal'+val1.sy+val1.sem).attr('data')
          //     if (typeof(tutorpaytotal) == "undefined"){
          //     tutorpaytotal=0
          //     }
          //     var assbal
          //     var bridgbal
          //     var tutorbal
          //     assbal=(asstotal-distotal)-paytotal
          //     bridgbal=britotal-bridgpaytotal
          //     tutorbal=tutortotal-tutorpaytotal
          //     if (assbal<0) {
          //       assbal=0
          //     }
          //     if (bridgbal<0) {
          //       bridgbal=0
          //     }
          //     if (tutorbal<0) {
          //       tutorbal=0
          //     }
          //     $('#Total'+val1.sy+val1.sem).append('<tr><td></td><td></td><td></td><td>Assessment: </td><td>'+tonum(assbal)+'</td></tr>')
          //     $('#Total'+val1.sy+val1.sem).append('<tr><td></td><td></td><td></td><td>Bridging: </td><td>'+tonum(bridgbal)+'</td></tr>')
          //     $('#Total'+val1.sy+val1.sem).append('<tr><td></td><td></td><td></td><td>Tutorial: </td><td>'+tonum(tutorbal)+'</td></tr>')
          //     $('#Total'+val1.sy+val1.sem).append('<tr><td></td><td></td><td></td><td>Total Balance: </td><td>'+tonum(assbal+bridgbal+tutorbal)+'</td></tr>')
          //   }
          //   sysemcount=val1.sy+val1.sem
          // });
          setTimeout(function() {
            if ($("#assessmentdispl").text()=="0.00") {
              disableScreen()
              reassess()
            }
          }, 5000);


        }
        else
        {
          alert("Student not enrolled! Please refer to the Admission")
          $(".overlay").remove();
        }

        $(".overlay").remove();
      });
      particulartable()
      getor()
      paytype()
      getpaymenthistory()
      refundhistory()
      $('#searchstudent').attr("disabled", false);
      $(".overlay").remove();
    })
    .fail(function() {
      $('#searchstudent').attr("disabled", false);
      $(".overlay").remove();
    })
  }
  else if($('#accttype').val()=='otherpayee')
  {

    $('#paytype option[value="assessment"]').attr("disabled", true);
    $('#paytype option[value="tutorial"]').attr("disabled", true);
    $('#paytype option[value="bridging"]').attr("disabled", true);
    $('.fullname').text($('#search').val());
    $('#enrollmentstatus').attr('class','text-success');
    $('#enrollmentstatus').html("<i class='glyphicon glyphicon-ok alert-primary'></i> Other Payee");
    var id = $('#studentid').val();
    $(".paydiv").show()
    $('#addrefund').attr("disabled", false);
    $.ajax({
        url: "<?php echo base_url('fees2/loadotherpayeepayment') ?>",
        type: 'GET',
        dataType: 'JSON',
        data: {id: id},
      })
      .done(function(data) {
        $('#otherpaymentsdiv').append('<div class="box"><div class="box-header with-border"><h3 class="box-title">Other Payee Payments</h3><div class="box-tools pull-right"></div></div><div class="box-body"><div class="row"><div class="col-md-6"><table id="asstb"><tbody id=""><tr><td></td></tr></tbody></table></div><div class="row"><div class="col-md-6"><table id="assptb" class="table table-sm"><tbody id="otherpayeepay"><tr><td></td></tr></tbody></table></div></div></div><div class="box-footer"></div></div>')
        var or=""
        var ortotal=0
        var paycount=0
        $.each(data, function(index, val) {
          paycount+=1
          if (or==val.orNo) {
            ortotal=(ortotal+parseFloat(val.amt2))
            $('#otherpayeepay').append('<tr><td></td><td></td><td>'+val.particularName+'</td><td id="hideamt2">'+tonum(parseFloat(val.amt2))+'</td><td></td></tr>')
          }
          else
          {
            if (ortotal>0) {
              $('#otherpayeepay').append('<tr><td></td><td></td><td></td><td id="hideamt2">______________</td><td></td></tr>')
              $('#otherpayeepay').append('<tr><td>OR Total:</td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(ortotal))+'</td><td></td></tr>')
              ortotal=0
            }
            ortotal=(ortotal+parseFloat(val.amt2))
            $('#otherpayeepay').append('<tr><td>'+toDate(val.paymentDate)+'</td><td>'+val.orNo+'</td><td>'+val.particularName+'</td><td id="hideamt2">'+tonum(parseFloat(val.amt2))+'</td><td></td></tr>')

          }
          or=val.orNo
          if (paycount==data.length) {
            $('#otherpayeepay').append('<tr><td></td><td></td><td></td><td id="hideamt2">______________</td><td></td></tr>')
            $('#otherpayeepay').append('<tr><td>OR Total:</td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(ortotal))+'</td><td></td></tr>')
            ortotal=0
          }

        });
        $("#payhistory").html("")
        $("#paytype").val("others").change();
        particulartable()
        getor()
        paytype()
        $('#searchstudent').attr("disabled", false);
        $(".overlay").remove();
      })
      .fail(function() {
        console.log("error ");
        $('#searchstudent').attr("disabled", false);
        $(".overlay").remove();

      })
  }
  else {
    $('#searchstudent').attr("disabled", false);
    $(".overlay").remove();
  }

$('#redistribute').attr("disabled", false);
$('#reassess').attr("disabled", false);
}
$(document).on('click','#reassess',function(){
  disableScreen()
  $('#reassess').attr("disabled", true);
  reassess()
});
$(document).on('click','#redistribute',function(){
  disableScreen()
  $('#redistribute').attr("disabled", true);
  paymentbackup()

});
function paymentbackup()
{
  var id = $('#studentid').val();
  var sy = $('#sy').val();
  var sem = $('#sem').val();
  $.ajax({
      url: "<?php echo base_url('fees2/paymentbackup') ?>",
      type: 'GET',
      dataType: 'JSON',
      data: {id: id,sy: sy,sem: sem},
    })
    .done(function(data) {
      var id = $('#studentid').val();
      var sy = $('#sy').val();
      var sem = $('#sem').val();
      var stat = $('#assess_status').val();
      var course = $('#assess_course').val();
      var graduating = $('#assess_isgraduating').val();
      var level = $('#assess_level').val();
      var totalunit = $('#assess_totalunit').val();
      var labunit = $('#assess_labunit').val();
      $.ajax({
          url: "<?php echo base_url('fees2/assess') ?>",
          type: 'GET',
          dataType: 'JSON',
          data: {id: id,sy: sy,sem: sem,stat: stat,course: course,totalunit: totalunit,labunit: labunit,level: level,graduating: graduating},
        })
        .done(function(data) {
          setTimeout(function() {
            redistributepayment()
          }, 1000);
        })
        .fail(function() {
          console.log("error ");
        })
    })
    .fail(function() {
      console.log("error ");
    })
}
function redistributepayment()
{
  var id = $('#studentid').val();
  var sy = $('#sy').val();
  var sem = $('#sem').val();
  $.ajax({
      url: "<?php echo base_url('fees2/redistributepayment') ?>",
      type: 'GET',
      dataType: 'JSON',
      data: {id: id,sy: sy,sem: sem},
    })
    .done(function(data) {
      setTimeout(function() {
        searchstudent()
      }, 2000);
    })
    .fail(function() {
      console.log("error ");
    })
}
function reassess()
{
  var id = $('#studentid').val();
  var sy = $('#sy').val();
  var sem = $('#sem').val();
  var stat = $('#assess_status').val();
  var course = $('#assess_course').val();
  var graduating = $('#assess_isgraduating').val();
  var level = $('#assess_level').val();
  var totalunit = $('#assess_totalunit').val();

  var labunit = $('#assess_labunit').val();
  $.ajax({
      url: "<?php echo base_url('fees2/assess') ?>",
      type: 'GET',
      dataType: 'JSON',
      data: {id: id,sy: sy,sem: sem,stat: stat,course: course,totalunit: totalunit,labunit: labunit,level: level,graduating: graduating},
    })
    .done(function(data) {
    searchstudent()
    })
    .fail(function() {
      console.log("error ");
    })
}
function toDate(dateStr) {
  myDate = new Date(dateStr).toLocaleDateString();
  return myDate
}
$(document).on('click','#deleteDiscounts',function(){
  $('#Sibling').show();
  $('#FullPayment').show();
  var id = $('#studentid').val();
  var syId = $('#sy option:selected').attr('data');
  var semId = $('#sem option:selected').attr('data');
  $.ajax({
      url: "<?php echo base_url('fees2/removeDiscounts') ?>",
      type: 'GET',
      dataType: 'JSON',
      data: {id: id,syId: syId,semId: semId},
    })
    .done(function(data) {
      reassess()
    })
    .fail(function() {
      console.log("error removeDiscounts");
    })

});
$(document).on('click','#setDiscount',function(){
  var datas = [];
  var others = false;
  var tuition1 = 0;
  var tuition2 = 0;
  var id = $('#studentid').val();
  var syId = $('#sy option:selected').attr('data');
  var semId = $('#sem option:selected').attr('data');
  var sy = $('#sy').val();
  var sem = $('#sem').val();

  $.ajax({
    url: "<?php echo base_url('fees2/getStudentTuition') ?>",
    type: 'GET',
    dataType: 'JSON',
    data: {id: id, sy: sy, sem: sem},
  })
  .done(function(data) {
      $.each(data, function(index, val) {
       tuition1 = val.amt1;
       tuition2 = val.amt2;
       ass1 = val.ass1;
       ass2 = val.ass2;
        $('.discountCheckBoxes').each(function() {
          val1=0
          val2=0
          if($(this).prop('checked')){
            if($(this).attr('custom') == "true"){
              desc = $('#customDiscountDesc').val();
              percent = $('#customDiscountPercentage').val()/100;
              if(!others){
                others = $('#customDiscountOthers').prop('checked');
              }
              val1=tuition1*percent
              val2=tuition2*percent
            }else{
              desc = $(this).attr('value');
              percent = $(this).attr('less');
              if(!others){
                others = $(this).attr('removeOthers');
              }
              var n = desc.includes("Full Payment");
              if (n==true) {
                val1=ass1*percent
                val2=ass2*percent
              }else{
                val1=tuition1*percent
                val2=tuition2*percent
              }
            }
            datas.push({ssi_id:id, discountDesc:desc,amt1:val1,amt2:val2,semId:semId,syId:syId});
          }
        });
        // INSERT DATA HERE
        $.ajax({
          url: '<?php echo base_url('fees2/addAllDiscounts') ?>',
          type: 'GET',
          dataType: 'JSON',
          data: {id:id,syId:syId,semId:semId,discounts:datas,others:others},
          })
        .done(function(data) {
        })
        $('.discountCheckBoxes').prop('checked', false);

      });
      reassess()
  })
  .fail(function() {
    console.log("error getStudentTuition ");
  })

});
function printContent(divName)
{
  var printContents = document.getElementById(divName).innerHTML;
  var originalContents = document.body.innerHTML;
  document.body.innerHTML = printContents;
  window.print();
  document.body.innerHTML = originalContents;
}
function printContentslip(el)
{
  var divContent = document.getElementById(el);
  var WinPrint = window.open('', '', 'width=1000,height=800');
  WinPrint.document.write(divContent.innerHTML);
  WinPrint.document.close();
  WinPrint.focus();
  WinPrint.print();

}
function printContentor(el)
{
  var printContents = document.getElementById(el).innerHTML;
  var WinPrint = window.open('', '', 'width=1100,height=800');
  WinPrint.document.write(printContents);

  WinPrint.document.close();
  WinPrint.focus();
  WinPrint.print();
}
function changenull(val)
{
  if (val == null)
  {
    return "N/A";
  }
  else
  {
    return val;
  }
}
function checkneg(val)
{
  if (val < 0.4)
  {
    return 0;
  }
  else
  {
    return val;
  }
}
function getAge(dateString) {
  var today = new Date();
  var birthDate = new Date(dateString);
  var age = today.getFullYear() - birthDate.getFullYear();
  var m = today.getMonth() - birthDate.getMonth();
  if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
  }
  return age;
}
if ($('#studentid').val() != "null" ) {
  $(".paydiv").show()
  $('#addrefund').attr("disabled", false);
}
</script>
