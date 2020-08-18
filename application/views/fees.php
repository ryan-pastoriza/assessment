
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
          <a href="<?php echo site_url('fees') ?>"><i class="glyphicon glyphicon-barcode">
            </i> <span>Fees</span></a>
        </li>
        <li id="access_tab">
          <a href="<?php echo site_url('particular') ?>"><i class="fa fa-dropbox">
            </i> <span>Particulars</span></a>
        </li>
        <li id="access_tab">
          <a href="<?php echo site_url('reports') ?>"><i class="fa fa-calendar">
            </i> <span>Schedule</span></a>
        </li>
        <li id="access_tab">
          <a href="<?php echo site_url('users') ?>"><i class="fa fa-users">
            </i> <span>Users</span></a>
        </li>
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
        <div class="col-md-8">
          <div class="input-group">
            <span class="input-group-addon">STUDENT</span>
            <input type="hidden" class="form-control" id="studentid">
            <input type="hidden" class="form-control" id="oldacctno">
            <input type="text" class="form-control" placeholder="Search" id="search">
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
                    <input type="hidden" class="form-control" id="assess_flow">
                    <input type="hidden" class="form-control" id="assess_studentid">
                    <input type="hidden" class="form-control" id="assess_sy">
                    <input type="hidden" class="form-control" id="assess_sem">
                    <input type="hidden" class="form-control" id="assess_status">
                    <input type="hidden" class="form-control" id="assess_course">
                    <input type="hidden" class="form-control" id="assess_isgraduating">
                    <input type="hidden" class="form-control" id="assess_level">
                    <input type="hidden" class="form-control" id="assess_totalunit">
                    <input type="hidden" class="form-control" id="assess_labunit">
                    <p class="text-danger" id="enrollmentstatus"></p>
                    <p class="" id="acct_no"></p>
                    <p class="" id="usn_no"></p>
                    <p class="" id="course"></p>
                    <p class="" id="sysem"></p>
                    <p class="" id="stat"></p>
                  </p>
                  <div class="row" id="toprint">
                    <table class="table table-sm" id="tbmain" >
                      <tbody id="as">
                        <tr>
                          <td></td>
                        </tr>
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
                  <button type="button" id="discount" class="btn btn-block btn-primary" data-toggle="modal" data-target="#discountModal">Discount</button>
                  <button type="button" id="print" class="btn btn-block btn-primary" onclick="printContentslip('toprint');">Account Slip</button>
                  <button type="button" id="print2" class="btn btn-block btn-primary" onclick="printContent('toprintsi');">Registration Form 1</button>
                  <button type="button" id="print3" class="btn btn-block btn-primary" onclick="printContent('toprintsb');">Registration Form 2</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br/>
      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#assessment" data-toggle="tab"><i class="fa fa-reorder"></i> Assessment</a></li>
              <li><a href="#enrolledsubject" data-toggle="tab"><i class="fa fa-book"></i> Enrolled Subject</a></li>
              <li><a href="#enrolledsem" data-toggle="tab"><i class="fa fa-line-chart"></i> Enrolled History</a></li>
              <li><a href="#paymentstab" data-toggle="tab"><i class="fa fa-bar-chart"></i> Payment History</a></li>
              <li><a href="#oldsys" data-toggle="tab"><i class="fa fa-bar-chart"></i> Old System Balance</a></li>
              <li style='float: right;' id="viewassb"><a href="#"  id="viewasst"></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="assessment">
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
                <div class="box box-primary" id="libox">
                  <div class="box-header with-border">
                    <h3 class="box-title">Assessment Information</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="box-body no-padding" style="">

                    <div class="row">
                      <div class="col-xs-1">
                      </div>
                      <div class="col-xs-10">
                        <table class="table table-striped">
                          <tbody id="assessmentlistl">

                          </tbody>
                        </table>
                      </div>
                      <div class="col-xs-1">
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
                <div class="box box-primary" id="oibox">
                  <div class="box-header with-border">
                    <h3 class="box-title">Assessment Information</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="box-body no-padding" style="">

                    <div class="row">
                      <div class="col-xs-1">
                      </div>
                      <div class="col-xs-10">
                        <table class="table table-striped">
                          <tbody id="assessmentlisto">

                          </tbody>
                        </table>
                      </div>
                      <div class="col-xs-1">
                      </div>
                    </div>


                  </div>
                </div>
              </div>

              <div class="tab-pane" id="enrolledsubject">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Subject Content</h3>
                  </div>
                  <div class="box-body no-padding">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Code</th>
                          <th>Description</th>
                          <th>Lab Unit</th>
                          <th>Lec Unit</th>
                          <th>Total Unit</th>
                        </tr>
                      </thead>
                      <tbody id="studload">

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="enrolledsem">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Enrolled Details</h3>
                  </div>
                  <div class="box-body no-padding">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Course</th>
                          <th>School Year</th>
                          <th>Semester</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody id="enrolledtable">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="paymentstab">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Payments</h3>
                  </div>
                  <div class="box-body no-padding">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>School Year</th>
                          <th>Semester</th>
                          <th>Date</th>
                          <th>OR</th>
                          <th>Particular</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody id="paymentstable">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="oldsys">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Old System Balance</h3>
                  </div>
                  <div class="box-body no-padding">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>School Year</th>
                          <th>Semester</th>
                          <th>Assessment</th>
                          <th>Bridging</th>
                          <th>Tutorial</th>
                        </tr>
                      </thead>
                      <tbody id="oldsystable">
                      </tbody>
                    </table>
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
          <label><input type="checkbox" class="discountCheckBoxes" value="Full Payment" less="0.05" removeOthers="true">Full Payment 5%</label>
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
  <script>

  var userrole="<?php echo $user; ?>";
  $('#ocbox').hide();
  $('#oibox').hide();
  $('#toprint').hide();
  $('#toprintsi').hide();
  $('#toprintsb').hide();
  if (userrole=="Admin")
  {
    $('#viewassb').show();
    $('#viewasst').text("-");
  }
  else
  {
    $('#viewassb').hide();
  }
  $(document).on('click','#viewasst',function(){
    var t=$('#viewasst').text();
    console.log(t)
    if (t=="-") {
      $('#viewasst').text("+");
      $('#ocbox').show();
      $('#oibox').show();
      $('#lcbox').hide();
      $('#libox').hide();
    }else{
      $('#viewasst').text("-");
      $('#ocbox').hide();
      $('#oibox').hide();
      $('#lcbox').show();
      $('#libox').show();
    }

  });
  function loadold(id1)
  {
    var id=id1;
    $.ajax({
        url: "<?php echo base_url('fees/checkoldsys') ?>",
        type: 'GET',
        dataType: 'JSON',
        data: {id: id},
      })
      .done(function(data) {
        var tass=0;
        var tbridg=0;
        var ttutor=0;
        $("#oldsystable").html("");
        $.each(data, function(index, val) {
          console.log(data);
          $('#oldsystable').append('<tr><td>'+ val.sy +'</td><td>'+ val.sem +'</td><td>'+ tonum(parseFloat(val.ass)) +'</td><td>'+ tonum(parseFloat(val.bridg)) +'</td><td>'+ tonum(parseFloat(val.tutorial)) +'</td></tr>');
          tass=tass+val.ass;
          tbridg=tbridg+val.bridg;
          ttutor=ttutor+val.tutorial
        });
        $('#oldsystable').append('<tr><td></td><td><h3>Total:</h3></td><td><h3>'+ tonum(parseFloat(tass)) +'</h3></td><td><h3>'+ tonum(parseFloat(tbridg)) +'</h3></td><td><h3>'+ tonum(parseFloat(ttutor)) +'</h3></td></tr>');
      })
      .fail(function() {
        console.log("error ");
      })
  }
  function loadassess(id1,sy1,sem1,level)
  {
    var id=id1;
    var sy=sy1;
    var sem=sem1;
    $.ajax({
      url: "<?php echo base_url('fees/loadassess') ?>",
      type: 'GET',
      dataType: 'JSON',
      data: {id: id,sem: sem,sy: sy},
    })
    .done(function(data) {
      console.log(data)
      var assessment=0
      var assessment2=0
      var bridg=0
      var bridg2=0
      var tutor=0
      var tutor2=0
      var discou=0
      var discou2=0
      var paid=0
      var paid2=0
      var oldac=0
      var oldac2=0
      var cbal=0
      var cbal2=0
      var tbal=0
      var tbal2=0
      var t=0
      var t2=0
      var l=0
      var l2=0
      var i=0
      var i2=0
      var m=0
      var m2=0
      var o=0
      var o2=0
      var ta=0
      $("#assessmentlistl").html("");
      $("#assessmentlisto").html("");
      $.each(data, function(index, val) {
        $('#assessmentlistl').append("<tr><td colspan='2'></td><td></td><td align='center'>TOTAL</td></tr>");
        $('#assessmentlisto').append("<tr><td colspan='2'></td><td></td><td align='center'>TOTAL</td></tr>");
        $('#assessmentlistl').append("<tr><td colspan='2'>Tuition Fee:</td><td></td><td></td></tr>");
        $('#assessmentlisto').append("<tr><td colspan='2'>Tuition Fee:</td><td></td><td></td></tr>");
        $.each(val.assess, function(index2, assess) {
          if (assess.feeType=="Tuition") {
            assessment+=parseFloat(assess.amt2);
            assessment2+=parseFloat(assess.amt1);
            t+=parseFloat(assess.amt2);
            t2+=parseFloat(assess.amt1);
            $('#assessmentlistl').append("<tr><td></td><td>"+assess.particular+"</td><td align='right'>"+tonum(parseFloat(assess.amt2))+"</td><td></td></tr>");
            $('#assessmentlisto').append("<tr><td></td><td>"+assess.particular+"</td><td align='right'>"+tonum(parseFloat(assess.amt1))+"</td><td></td></tr>");
            $('#rgtuition').html("");
            $('#rgtuition').append(tonum(parseFloat(assess.amt2)));
          }
        });
        $('#assessmentlistl').append("<tr><td></td><td></td><td></td><td align='right'>"+tonum(parseFloat(t))+"</td></tr>");
        $('#assessmentlisto').append("<tr><td></td><td></td><td></td><td align='right'>"+tonum(parseFloat(t2))+"</td></tr>");
        $('#assessmentlistl').append("<tr><td colspan='2'>Laboratory Fee:</td><td></td><td></td></tr>");
        $('#assessmentlisto').append("<tr><td colspan='2'>Laboratory Fee:</td><td></td><td></td></tr>");
        $.each(val.assess, function(index2, assess) {
          if (assess.feeType=="Laboratory") {
            assessment+=parseFloat(assess.amt2);
            assessment2+=parseFloat(assess.amt1);
            l+=parseFloat(assess.amt2);
            l2+=parseFloat(assess.amt1);
            $('#assessmentlistl').append("<tr><td></td><td>"+assess.particular+"</td><td align='right'>"+tonum(parseFloat(assess.amt2))+"</td><td></td></tr>");
            $('#assessmentlisto').append("<tr><td></td><td>"+assess.particular+"</td><td align='right'>"+tonum(parseFloat(assess.amt1))+"</td><td></td></tr>");
          }
        });
        $('#assessmentlistl').append("<tr><td></td><td></td><td></td><td align='right'>"+tonum(parseFloat(l))+"</td></tr>");
        $('#assessmentlisto').append("<tr><td></td><td></td><td></td><td align='right'>"+tonum(parseFloat(l2))+"</td></tr>");
        $('#rglab').html("");
        $('#rglab').append(tonum(parseFloat(l)));

        $('#assessmentlistl').append("<tr><td colspan='2'>Miscellaneous:</td><td></td><td></td></tr>");
        $('#assessmentlisto').append("<tr><td colspan='2'>Miscellaneous:</td><td></td><td></td></tr>");
        $.each(val.assess, function(index2, assess) {
          if (assess.feeType=="Miscellaneous") {
            assessment+=parseFloat(assess.amt2);
            assessment2+=parseFloat(assess.amt1);
            m+=parseFloat(assess.amt2);
            m2+=parseFloat(assess.amt1);
            $('#assessmentlistl').append("<tr><td></td><td>"+assess.particular+"</td><td align='right'>"+tonum(parseFloat(assess.amt2))+"</td><td></td></tr>");
            $('#assessmentlisto').append("<tr><td></td><td>"+assess.particular+"</td><td align='right'>"+tonum(parseFloat(assess.amt1))+"</td><td></td></tr>");

          }
        });
        $('#assessmentlistl').append("<tr><td></td><td></td><td></td><td align='right'>"+tonum(parseFloat(m))+"</td></tr>");
        $('#assessmentlisto').append("<tr><td></td><td></td><td></td><td align='right'>"+tonum(parseFloat(m2))+"</td></tr>");
        $('#rgmisc').html("");
        $('#rgmisc').append(tonum(parseFloat(m)));

        $('#assessmentlistl').append("<tr><td colspan='2'>Other Fee:</td><td></td><td></td></tr>");
        $('#assessmentlisto').append("<tr><td colspan='2'>Other Fee:</td><td></td><td></td></tr>");
        $.each(val.assess, function(index2, assess) {
          if (assess.feeType=="Other Fee") {
            assessment+=parseFloat(assess.amt2);
            assessment2+=parseFloat(assess.amt1);
            o+=parseFloat(assess.amt2);
            o2+=parseFloat(assess.amt1);
            $('#assessmentlistl').append("<tr><td></td><td>"+assess.particular+"</td><td align='right'>"+tonum(parseFloat(assess.amt2))+"</td><td></td></tr>");
            $('#assessmentlisto').append("<tr><td></td><td>"+assess.particular+"</td><td align='right'>"+tonum(parseFloat(assess.amt1))+"</td><td></td></tr>");

          }
        });
        $('#assessmentlistl').append("<tr><td></td><td></td><td></td><td align='right'>"+tonum(parseFloat(o))+"</td></tr>");
        $('#assessmentlisto').append("<tr><td></td><td></td><td></td><td align='right'>"+tonum(parseFloat(o2))+"</td></tr>");
        $('#rgmisc').html("");
        $('#rgmisc').append(tonum(parseFloat(o)));

        $('#assessmentlistl').append("<tr><td></td><td></td><td align='right'>TOTAL ASSESSMENT:</td><td align='right'>"+tonum(parseFloat(assessment))+"</td></tr>");
        $('#assessmentlisto').append("<tr><td></td><td></td><td align='right'>TOTAL ASSESSMENT:</td><td align='right'>"+tonum(parseFloat(assessment2))+"</td></tr>");
        $('#assessmentdispl').text(tonum(parseFloat(assessment)));
        $('#assessmentdispo').text(tonum(parseFloat(assessment2)));

        $('#assessmentlistl').append("<tr><td colspan='2'>Bridging:</td><td></td><td></td></tr>");
        $('#assessmentlisto').append("<tr><td colspan='2'>Bridging:</td><td></td><td></td></tr>");
        $.each(val.assess, function(index2, assess) {
          if (assess.feeType=="Bridging") {
            bridg+=parseFloat(assess.amt2);
            bridg2+=parseFloat(assess.amt1);
            $('#assessmentlistl').append("<tr><td></td><td>"+assess.particular+"</td><td align='right'>"+tonum(parseFloat(assess.amt2))+"</td><td></td></tr>");
            $('#assessmentlisto').append("<tr><td></td><td>"+assess.particular+"</td><td align='right'>"+tonum(parseFloat(assess.amt1))+"</td><td></td></tr>");
          }
        });

        $('#assessmentlistl').append("<tr><td></td><td></td><td align='right'>TOTAL BRIDGING:</td><td align='right'>"+tonum(parseFloat(bridg))+"</td></tr>");
        $('#assessmentlisto').append("<tr><td></td><td></td><td align='right'>TOTAL BRIDGING:</td><td align='right'>"+tonum(parseFloat(bridg2))+"</td></tr>");
        $('#bridgingdispl').text(tonum(parseFloat(bridg)));
        $('#bridgingdispo').text(tonum(parseFloat(bridg2)));
        $('#assessmentlistl').append("<tr><td colspan='2'>Tutorial:</td><td></td><td></td></tr>");
        $('#assessmentlisto').append("<tr><td colspan='2'>Tutorial:</td><td></td><td></td></tr>");
        $.each(val.assess, function(index2, assess) {
          if (assess.feeType=="Tutorial") {
            tutor+=parseFloat(assess.amt2);
            tutor2+=parseFloat(assess.amt1);
            $('#assessmentlistl').append("<tr><td></td><td>"+assess.particular+"</td><td align='right'>"+tonum(parseFloat(assess.amt2))+"</td><td></td></tr>");
            $('#assessmentlisto').append("<tr><td></td><td>"+assess.particular+"</td><td align='right'>"+tonum(parseFloat(assess.amt1))+"</td><td></td></tr>");
          }
        });

        $('#assessmentlistl').append("<tr><td></td></td><td></td><td align='right'>TOTAL TUTORIAL:</td><td align='right'>"+tonum(parseFloat(tutor))+"</td></tr>");
        $('#assessmentlisto').append("<tr><td></td></td><td></td><td align='right'>TOTAL TUTORIAL:</td><td align='right'>"+tonum(parseFloat(tutor2))+"</td></tr>");
        $('#tutorialdispl').text(tonum(parseFloat(tutor)));
        $('#tutorialdispo').text(tonum(parseFloat(tutor2)));
        $('#assessmentlistl').append("<tr><td colspan='2'>Discount:</td><td></td><td></td></tr>");
        $('#assessmentlisto').append("<tr><td colspan='2'>Discount:</td><td></td><td></td></tr>");
        $.each(val.discount, function(index3, disc) {
          if ( disc.discountName!="No data") {
            if (disc.discountName=="Full Payment") {
              $('#FullPayment').hide();
            }
            if (disc.discountName=="Sibling") {
              $('#Sibling').hide();
            }
            discou+=parseFloat(disc.amt2);
            discou2+=parseFloat(disc.amt1);
            $('#assessmentlistl').append("<tr><td></td><td>"+disc.discountName+"</td><td align='right'>"+tonum(parseFloat(disc.amt2))+"</td><td></td></tr>");
            $('#assessmentlisto').append("<tr><td></td><td>"+disc.discountName+"</td><td align='right'>"+tonum(parseFloat(disc.amt1))+"</td><td></td></tr>");
          }
        });

        $('#assessmentlistl').append("<tr><td></td><td></td><td align='right'>TOTAL DISCOUNT:</td><td align='right'>"+tonum(parseFloat(discou))+"</td></tr>");
        $('#assessmentlisto').append("<tr><td></td><td></td><td align='right'>TOTAL DISCOUNT:</td><td align='right'>"+tonum(parseFloat(discou2))+"</td></tr>");
        $('#discountdispl').text(tonum(parseFloat(discou)));
        $('#discountdispo').text(tonum(parseFloat(discou2)));
        $('#rgdis').html("");
        $('#rgdis').append(tonum(parseFloat(discou)));
        ta=assessment-discou
        $('#rgtass').html("");
        $('#rgtass').append(tonum(parseFloat(ta)));
        $('#assessmentlistl').append("<tr><td colspan='2'>Payment:</td><td></td><td></td></tr>");
        $('#assessmentlisto').append("<tr><td colspan='2'>Payment:</td><td></td><td></td></tr>");
        var cpay=0
        $.each(val.payments, function(index4, pay) {
          if ( pay.or!="No data") {
            paid+=parseFloat(pay.amt2);
            paid2+=parseFloat(pay.amt1);
            $('#assessmentlistl').append("<tr><td></td><td>"+pay.or+" / "+pay.date+"</td><td align='right'>"+tonum(parseFloat(pay.amt2))+"</td><td></td></tr>");
            $('#assessmentlisto').append("<tr><td></td><td>"+pay.or+" / "+pay.date+"</td><td align='right'>"+tonum(parseFloat(pay.amt1))+"</td><td></td></tr>");
            if (cpay==0) {
              $('#rgamt').html("");
              $('#rgamt').append(tonum(parseFloat(pay.amt2)));
              $('#rgor').html("");
              $('#rgor').append(pay.or);
              $('#rgdate').html("");
              $('#rgdate').append(pay.date);
            }
            cpay+=1
          }
        });
        $('#tbmain3').html("");
        var myElement = document.getElementById("rf1").innerHTML;
        $('#tbmain3').append(myElement);
        $('#assessmentlistl').append("<tr><td></td><td></td><td align='right'>TOTAL PAYMENT:</td><td align='right'>"+tonum(parseFloat(paid))+"</td></tr>");
        $('#assessmentlisto').append("<tr><td></td><td></td><td align='right'>TOTAL PAYMENT:</td><td align='right'>"+tonum(parseFloat(paid2))+"</td></tr>");
        $('#paymentsdispl').text(tonum(parseFloat(paid)));
        $('#paymentsdispo').text(tonum(parseFloat(paid2)));
        $.each(val.oldaccount, function(index5, old) {
          oldac+=parseFloat(old.oldacc2);
          oldac2+=parseFloat(old.oldacc1);
        });
        $('#oldaccdispl').text(tonum(parseFloat(oldac)));
        $('#oldaccdispo').text(tonum(parseFloat(oldac2)));
        cbal+=(assessment+bridg+tutor)-(discou+paid);
        cbal2+=(assessment2+bridg2+tutor2)-(discou2+paid2);
        tbal+=cbal+oldac;
        tbal2+=cbal2+oldac2;
        $('#cbalancedispl').text(tonum(parseFloat(cbal)));
        $('#cbalancedispo').text(tonum(parseFloat(cbal2)));
        $('#tbalancedispl').text(tonum(parseFloat(tbal)));
        $('#tbalancedispo').text(tonum(parseFloat(tbal2)));
        $('#assessmentlistl').append("<tr><td></td><td></td><td align='right'>CURRENT BALANCE:</td><td align='right'>"+tonum(parseFloat(cbal))+"</td></tr>");
        $('#assessmentlisto').append("<tr><td></td><td></td><td align='right'>CURRENT BALANCE:</td><td align='right'>"+tonum(parseFloat(cbal2))+"</td></tr>");
      });
      generate(id,sy,sem,level)

    })
    .fail(function() {
      console.log("error2 ");
    })
  }
  function reassess()
  {
    var id = $('#assess_studentid').val();
    var sy = $('#assess_sy').val();
    var sem = $('#assess_sem').val();
    var stat = $('#assess_status').val();
    var course = $('#assess_course').val();
    var graduating = $('#assess_isgraduating').val();
    var level = $('#assess_level').val();
    var totalunit = $('#assess_totalunit').val();
    var labunit = $('#assess_labunit').val();
    $.ajax({
        url: "<?php echo base_url('fees/assess') ?>",
        type: 'GET',
        dataType: 'JSON',
        data: {id: id,sy: sy,sem: sem,stat: stat,course: course,totalunit: totalunit,labunit: labunit,level: level,graduating: graduating},
      })
      .done(function(data) {
        loadassess(id,sy,sem);
      })
      .fail(function() {
        console.log("error ");
      })
  }
  function tonum(num1)
  {
    var n=num1
    var parts = n.toFixed(2).split(".");
    var num = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + (parts[1] ? "." + parts[1] : "");
    return num;
  }
  $(function () {
    $('#reassess').hide();
    $('#discount').hide();
    $('#print').hide();
    $('#print2').hide();
    $('#print3').hide();
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
        url: "<?php echo base_url('fees/searchs') ?>",
        type: 'GET',
        dataType: 'JSON',
        data: {searchtext: searchtext},
      })
      .done(function(data) {
          $.each(data, function(index, val) {
            tbody += '<a href="#" id="searchres" data-id="'+val.ssi_id+'" data-acct="'+val.acct_no+'" class="list-group-item list-group-item-action border-1">['+val.acct_no+'] '+val.lname+', '+val.fname+' '+val.mname+'</a>';
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

  $(document).on('click','#searchres',function(){
    $('#search').val($(this).text());
    $('#studentid').val($(this).attr('data-id'));
    $('#oldacctno').val($(this).attr('data-acct'));
    $("#show-list").html('');
  });
  $(document).on('click','#searchstudent',function(){
    var id = $('#studentid').val();
    var level = $('#assess_level').val();
    var acctno = $('#oldacctno').val();
    var sy = $('#sy').val();
    var sem = $('#sem').val();
    var sem2 ="";
    var stud = false;
    if (sem=="1st") {
      sem2 = "First Semester"
    }else{
      sem2 = "Second Semester"
    }

    $.ajax({
        url: "<?php echo base_url('fees/searchinfo') ?>",
        type: 'GET',
        dataType: 'JSON',
        data: {id: id,sem: sem,sy: sy,acctno: acctno},
      })
      .done(function(data) {
        console.log(data)
        var lectotal=0
        var labtotal=0
        var discr=0
        var contact=""
        var age=""
        $('#rf2').html("");
        $('#rf2').append('<tr><td width="35px" height="50px"></td><td width="40px"></td><td width="50px"></td><td width="50px"></td><td width="50px"></td><td width="50px"></td><td width="35px"></td><td width="35px"></td><td width="120px"></td><td width="80px"></td><td width="100px"></td></tr>');
        $('#rf1').html("");
        $('#tbmain3').html("");
        $('#rf1').append('<tr><td width="70px" height="80px"></td><td width="92px"></td><td width="90px"></td><td width="35px"></td><td width="48px"></td><td width="50px"></td><td width="60px"></td><td width="48px"></td><td width="60px"></td><td width="78px"></td><td width="62px"></td><td width="86px"></td></tr>');
        $("#studload").html("");
        $("#enrolledtable").html("");
        $("#paymentstable").html("");
        $.each(data, function(index, val) {
          if (val.telephone_number == null || val.telephone_number == "")
          {
            contact=val.phone_number
          }
          else
          {
            contact=val.telephone_number
          }
          age=getAge(val.birthdate)
          $('#assess_isgraduating').val(val.is_graduating);
          $('#rf2').append('<tr><td></td><td></td><td></td><td colspan="7">'+val.lname +', '+ val.fname +' '+ val.mname+'</td><td>'+changenull(contact)+'</td></tr>');
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
          $('.fullname').text(val.lname + ", " + val.fname +" " + val.mname);
          $('#acct_no').html("<i class='glyphicon glyphicon-user'></i> "+val.acct_no);
          $('#usn_no').html("<i class='glyphicon glyphicon-credit-card'></i> "+ val.usn_no);
          $('#assess_studentid').val(val.ssi_id);
          $('#rf1').append("<tr><td></td><td colspan='5'>"+val.usn_no+"</td><td></td><td></td><td></td><td id='studclass'></td><td></td><td></td></tr>");
          $('#rf1').append("<tr><td height='24px'></td><td colspan='5'>"+val.lname+", "+val.fname+" "+val.mname+"</td><td id='rgsem'></td><td></td><td></td><td id='rgsy' align='right'></td><td></td><td></td></tr>");
          $('#rf1').append("<tr><td height='24px'></td><td colspan='5'>"+val.street+"</td><td colspan='2' align='center'>"+val.gfname+"</td><td></td><td>"+contact+"</td><td></td><td></td></tr>");
          $('#rf1').append("<tr><td></td><td>"+val.birthdate+"</td><td colspan='3' align='right'>"+val.birthplace+"</td><td align='right'>"+val.gender+"</td><td id='rgcourse' colspan='2' align='right'></td><td></td><td align='right'>"+val.year+"</td><td></td><td></td></tr>");
          $('#rf1').append('<tr><td height="20px"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>');
          $.each(val.status, function(index1, val1) {
            if(val1.status == 'enrolled'){
              console.log(val1.status)
              $('#enrollmentstatus').attr('class','text-success');
              $('#enrollmentstatus').html("<i class='glyphicon glyphicon-ok alert-primary'></i> Enrolled");
              $('#course').html('<i class="glyphicon glyphicon-education"></i> '+val1.course+'');
              $('#rgcourse').append(val1.course);
              $('#sysem').html('<i class="glyphicon glyphicon-calendar"></i> '+val1.sem+' '+val1.sy+'');
              $('#stat').html("<i class='glyphicon glyphicon-education'></i> "+val1.current_stat);
              $('#reassess').show();
              if ($('#assess_level').val()=="Senior High") {
                $('#discount').hide();
              } else {
                $('#discount').show();
              }
              $('#print').show();
              $('#print2').show();
              $('#print3').show();
              $('#assess_sy').val(val1.sy);
              $('#assess_sem').val(val1.sem);
              $('#assess_status').val(val1.current_stat);
              $('#assess_course').val(val1.course);
              $('#assess_level').val(val1.level);
              $('#studclass').text(val1.current_stat);
              $('#rgsem').text(val1.sem);
              $('#rgsy').text(val1.sy);
            }else{
              $('#enrollmentstatus').attr('class','text-danger');
              $('#enrollmentstatus').html("<i class='glyphicon glyphicon-remove alert-primary'></i> Not Enrolled");
              $('#course').html('<i class="glyphicon glyphicon-education"></i> No Course');
              $('#sysem').html('<i class="glyphicon glyphicon-calendar"></i> '+sem+' '+sy+'');
              $('#stat').html("<i class='glyphicon glyphicon-education'></i> No Data");
              $('#reassess').hide();
              $('#discount').hide();
              $('#print').hide();
              $('#print2').hide();
              $('#print3').hide();
              $('#assess_sy').val("");
              $('#assess_sem').val("");
              $('#assess_status').val("");
              $('#assess_course').val("");
              $('#assess_level').val("");
            }
          });
          var desc=""
          var row=0
          var td=""
          var tu=0
          var sy = $('#sy').val();
          $.each(val.studload, function(index2, val2) {
            if(val2.sy == sy && val2.sem == sem2){
              stud = true;
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
              else
              {
                td="<td></td><td></td>"
              }
              if (desc==val2.subj_code)
              {
                //$('#rf1').append('<tr><td></td><td colspan="2"></td><td></td><td></td><td align="center">'+val2.day+'</td><td align="center">'+val2.time+'</td><td align="center">'+val2.room+'</td>'+td+'<td></td><td></td></tr>');
                $('#rf1').append('<tr><td></td><td colspan="2"></td><td></td><td></td><td align="center"></td><td align="center"></td><td align="center"></td>'+td+'<td></td><td></td></tr>');
                row+=1
              }
              else
              {
                var total= parseFloat(val2.lab_unit) + parseFloat(val2.lec_unit);
                lectotal+=parseFloat(val2.lec_unit);
                labtotal+=parseFloat(val2.lab_unit);
                desc=val2.subj_code
                $('#studload').append("<tr><td>"+val2.subj_code+"</td><td>"+val2.subj_name1+"</td><td>"+val2.lab_unit+"</td><td>"+val2.lec_unit+"</td><td>"+total+"</td><td>");
                //$('#rf1').append('<tr><td>'+val2.subj_code+'</td><td colspan="2">'+val2.subj_name+'</td><td></td><td align="center">'+total+'</td><td align="center">'+val2.day+'</td><td align="center">'+val2.time+'</td><td align="center">'+val2.room+'</td>'+td+'<td></td><td></td></tr>');
                $('#rf1').append('<tr><td>'+val2.subj_code+'</td><td colspan="2">'+val2.subj_name+'</td><td></td><td align="center">'+total+'</td><td align="center"></td><td align="center"></td><td align="center"></td>'+td+'<td></td><td></td></tr>');
                row+=1
                tu+=total
              }
            }
          });
          $('#rf1').append('<tr><td></td><td colspan="2"></td><td></td><td align="center">'+tu+'</td><td colspan="2"></td><td></td><td>Discount</td><td id="rgdis" align="right"></td><td></td><td></td></tr>');
          $('#rf1').append('<tr><td height="40px"></td><td colspan="2"></td><td></td><td></td><td colspan="2"></td><td></td><td>Total</td><td align="right"><b></b><h4 id="rgtass"></h4></b></td><td></td><td></td></tr>');
          $('#rf1').append('<tr><td></td><td></td><td colspan="2">ALAN L. ATEGA</td><td></td><td></td><td id="rgamt"><td></td></td><td id="rgor"></td><td align="right" id="rgdate"></td><td></td><td></td></tr>');
          $.each(val.discredit, function(index2, val2) {
            discr+= parseFloat(val2.dc);
          });
          $('#assess_totalunit').val((lectotal+labtotal-discr));
          $('#assess_labunit').val(labtotal);
          if (stud==true) {
            $('#studload').append("<tr><td></td><td>Total:</td><td>"+labtotal+"</td><td>"+lectotal+"</td><td>"+(lectotal+labtotal)+"</td><td>");
          }
          $.each(val.sy_sem_enrolled, function(index3, val3) {
            if ( val3.course!="No Data") {
              $('#enrolledtable').append("<tr><td>"+val3.course+"</td><td>"+val3.sy+"</td><td>"+val3.sem+"</td><td>"+val3.status+"</td></tr>");
            }
           });
          var ins=0;
          var amtt=0;
          var sy="";
          var sem="";
          $.each(val.payments, function(index3, val3) {
            if ( val3.paymentDate!="No Data") {
              if(ins==val3.orNo)
              {
                $('#paymentstable').append("<tr><td></td><td></td><td></td><td></td><td>"+val3.particular+"</td><td>"+val3.amt2+"</td></tr>");
                amtt+=parseFloat(val3.amt2);
              }
              else
              {
                if(amtt!=0)
                {
                  $('#paymentstable').append("<tr><td></td><td></td><td></td><td></td><td></td><td>____________</td></tr>");
                  $('#paymentstable').append("<tr><td></td><td></td><td></td><td></td><td>TOTAL: </td><td>"+amtt+"</td></tr>");
                  amtt=0;
                }
                ins=val3.orNo;
                var monthNames = [ "January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December" ];
                var newDate = new Date(val3.paymentDate);
                var formattedDate = monthNames[newDate.getMonth()] +" "+ newDate.getDay() +", "+ newDate.getFullYear();
                $('#paymentstable').append("<tr><td>"+val3.sy+"</td><td>"+val3.sem+"</td><td>"+formattedDate+"</td><td>"+val3.orNo+"</td><td></td><td></td></tr>");
                $('#paymentstable').append("<tr><td></td><td></td><td></td><td></td><td>"+val3.particular+"</td><td>"+val3.amt2+"</td></tr>");
                amtt+=parseFloat(val3.amt2);
              }
            }
          });
          $('#paymentstable').append("<tr><td></td><td></td><td></td><td></td><td></td><td>____________</td></tr>");
          $('#paymentstable').append("<tr><td></td><td></td><td></td><td></td><td>TOTAL: </td><td>"+amtt+"</td></tr>");
          $('#assess_flow').val(val.efsm_id);
        });
        loadassess(id,sy,sem,level);
      })
      .fail(function() {
        console.log("error ");
      })

      loadold(acctno);
  });

  $(document).on('click','#reassess',function(){
    var id = $('#assess_studentid').val();
    var sy = $('#assess_sy').val();
    var sem = $('#assess_sem').val();
    var stat = $('#assess_status').val();
    var course = $('#assess_course').val();
    var graduating = $('#assess_isgraduating').val();
    var level = $('#assess_level').val();
    var totalunit = $('#assess_totalunit').val();
    var labunit = $('#assess_labunit').val();
    $.ajax({
        url: "<?php echo base_url('fees/assess') ?>",
        type: 'GET',
        dataType: 'JSON',
        data: {id: id,sy: sy,sem: sem,stat: stat,course: course,totalunit: totalunit,labunit: labunit,level: level,graduating: graduating},
      })
      .done(function(data) {
        loadassess(id,sy,sem,level);
      })
      .fail(function() {
        console.log("error ");
      })
  });
  $(document).on('click','#deleteDiscounts',function(){
    $('#Sibling').show();
    $('#FullPayment').show();
    var id = $('#assess_studentid').val();
    var syId = $('#sy option:selected').attr('data');
    var semId = $('#sem option:selected').attr('data');
    $.ajax({
        url: "<?php echo base_url('fees/removeDiscounts') ?>",
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
    var id = $('#assess_studentid').val();
    var sy = $('#assess_sy').val();
    var sem = $('#assess_sem').val();
    var stat = $('#assess_status').val();
    var course = $('#assess_course').val();
    var graduating = $('#assess_isgraduating').val();
    var level = $('#assess_level').val();
    var totalunit = $('#assess_totalunit').val();
    var labunit = $('#assess_labunit').val();
    $.ajax({
        url: "<?php echo base_url('fees/assess') ?>",
        type: 'GET',
        dataType: 'JSON',
        data: {id: id,sy: sy,sem: sem,stat: stat,course: course,totalunit: totalunit,labunit: labunit,level: level,graduating: graduating},
      })
      .done(function(data) {
        $.ajax({
          url: "<?php echo base_url('fees/loadassess') ?>",
          type: 'GET',
          dataType: 'JSON',
          data: {id: id,sem: sem,sy: sy},
        })
        .done(function(data) {
        })
        .fail(function() {
          console.log("error loadassess");
        })
      })
      .fail(function() {
        console.log("error assess");
      })

    var datas = [];
    var others = false;
    var tuition1 = 0;
    var tuition2 = 0;
    var syId = $('#sy option:selected').attr('data');
    var semId = $('#sem option:selected').attr('data');

    $.ajax({
      url: "<?php echo base_url('fees/getStudentTuition') ?>",
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
                if (desc=="Full Payment") {
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
            url: '<?php echo base_url('fees/addAllDiscounts') ?>',
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

  function generate(id,sy,sem,level)
  {
    var fullDate = new Date()
    var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
    var currentDate =  twoDigitMonth + "/" + fullDate.getDate()+ "/" + fullDate.getFullYear();
    var id1 = $('#assess_studentid').val();
    var sy1 = $('#assess_sy').val();
    var sem1 = $('#assess_sem').val();
    var level1 = $('#assess_level').val();
    if (sy1!=null && sem1!=null && level1!=null ) {
      $.ajax({
        url: "<?php echo base_url('fees/generate') ?>",
        type: 'GET',
        dataType: 'JSON',
        data: {id: id1,sy: sy1,sem: sem1,level: level1},
      })
      .done(function(data) {
        $('#as').html("");
        console.log(data)
        var count =0;
        var counter=0;
        var counter1=0;
        var h=800;
        var w = 0
        $.each(data, function(index, val) {
          $.each(val.student, function(index1, val1) {
            counter1+=1
            if (counter1<=5) {
              w+=230
              $("#tbmain").width(w);
            }
            if (count==0) {
              $('#as').append('<tr id="tr'+counter+'"  valign="top">');
            }
            $("#tr"+counter+"").append("<td id='as"+val1.ssi_id+"' style='width:250px;'");
            $("#as"+val1.ssi_id+"").append('<table frame="box" width="230px" class="table table-sm" id="table'+val1.ssi_id+'">');
            $('#table'+val1.ssi_id+'').append('<tr style="height:10px;"><td></td><td></td><td></td></tr>');
            $('#table'+val1.ssi_id+'').append('<tr><td align="center" colspan="3">ACLC College of Butan City, Inc.</td></tr>');
            $('#table'+val1.ssi_id+'').append('<tr><td align="center" colspan="3">HDS Building JC Aquino Ave.</td></tr>');
            $('#table'+val1.ssi_id+'').append('<tr style="height:10px;"><td></td><td></td><td></td></tr>');
            $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="2">Account Slip</td><td align="right">'+currentDate+'</td></tr>');
            if (val1.mname!=null) {
              $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="3">'+val1.lname+' '+val1.fname+', '+val1.mname.charAt(0)+'.</td></tr>');
            }
            if (val1.stud_id!=null) {
              $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="3">'+val1.stud_id+'</td></tr>');
            }
            $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="3">'+val1.prog_abv+'</td></tr>');
            $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="2">Assessment:</td><td align="right">'+tonum(parseFloat(val1.assessment))+'</td></tr>');
            $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="3">Payments:</td></tr>');
            $('#table'+val1.ssi_id+'').append('<tr><td align="left"><u>OR</u></td><td align="left"><u>Date</u></td><td align="right"><u>Amount</u></td></tr>');
            var totalpay=0;
            var assess=parseFloat(val1.assessment);
            $.each(val1.payment, function(index2, val2) {
              if (val2.or!=undefined) {
                $('#table'+val1.ssi_id+'').append('<tr><td align="left">'+val2.or+'</td><td align="left">'+val2.date+'</td><td align="right">'+tonum(parseFloat(val2.amt2))+'</td></tr>');
                totalpay+=parseFloat(val2.amt2)
              }

            });
            $('#table'+val1.ssi_id+'').append('<tr><td></td><td></td><td align="right"></td></tr>');
            $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="2">Total:</td><td align="right">'+tonum(parseFloat(totalpay))+'</td></tr>');
            var balance = assess-totalpay;
            $('#table'+val1.ssi_id+'').append('<tr style="height:10px;"><td></td><td></td><td align="right"></td></tr>');
            $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="2">Balance Payable:</td><td align="right">'+tonum(parseFloat(balance))+'</td></tr>');
            $('#table'+val1.ssi_id+'').append('<tr style="height:10px;"><td></td><td></td><td align="right"></td></tr>');
            if (val1.level=="College") {
              var pre=(assess*parseFloat(val1.prelim))-totalpay
              if (pre<0) {
                pre=0;
              }
              $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="2">Prelim</td><td align="right">'+tonum(parseFloat(pre))+'</td></tr>');
              var mid=(assess*parseFloat(val1.midterm))-totalpay-pre
              if (mid<0) {
                mid=0;
              }
              $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="2">Midterm</td><td align="right">'+tonum(parseFloat(mid))+'</td></tr>');
              var pref=(assess*parseFloat(val1.prefinal))-totalpay-pre-mid
              if (pref<0) {
                pref=0;
              }
              $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="2">Prefinal</td><td align="right">'+tonum(parseFloat(pref))+'</td></tr>');
              var fin=assess-totalpay-pre-mid-pref
              if (fin<0) {
                fin=0;
              }
              $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="2">Final</td><td align="right">'+tonum(parseFloat(fin))+'</td></tr>');

            }else{
              var pre=0
              var mid=0
              var pref=0
              var fin=0
              var perterm =assess*0.25
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
              $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="2">Prelim</td><td align="right">'+tonum(parseFloat(pre))+'</td></tr>');
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
              $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="2">Midterm</td><td align="right">'+tonum(parseFloat(mid))+'</td></tr>');
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
              $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="2">Prefinal</td><td align="right">'+tonum(parseFloat(pref))+'</td></tr>');
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
              $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="2">Final</td><td align="right">'+tonum(parseFloat(fin))+'</td></tr>');

            }
            $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="3">Issued By:</td></tr>');
            $('#table'+val1.ssi_id+'').append('<tr><td align="center" colspan="3"><img height="35" src="<?php echo $this->config->base_url(); ?>assets/dist/img/sign.png"></div></td></tr>');//insert pic
            $('#table'+val1.ssi_id+'').append('<tr><td align="center" colspan="3"><u>ELDIE D. ENCARNADO</u></td></tr>');
            $('#table'+val1.ssi_id+'').append('<tr><td align="center" colspan="3">Accounting Coordinator</td></tr>');
            $.each(val1.old, function(index3, val3) {
              var oldac=val3.oldacc2+val1.assessold;
                  if (oldac!=0) {
                    $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="2">Old Account:</td><td align="right">'+tonum(parseFloat(oldac))+'</td></tr>');
                  }

                });
                var t=0;
                if (val1.tutorial!=null && val1.tutorial!=0) {
                  t=val1.tutorial-val1.tutorialpayment
                }
                t+=val1.tutorialold;
                if (t=null && t!=0) {
                  $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="2">Tutorial:</td><td align="right">'+tonum(parseFloat(t))+'</td></tr>');
                }

                var b=0;
                if (val1.bridging!=null && val1.bridging!=0) {
                  b=val1.bridging-val1.bridgingpayment
                }
                b+=val1.bridgold;
                if (b!=null && b!=0) {
                  $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="2">Bridging:</td><td align="right">'+tonum(parseFloat(b))+'</td></tr>');
                }

            $('#table'+val1.ssi_id+'').append('</table>');

            $('#as').append("</td>");
            count+=1
            if (count==5) {
              $('#as').append("</tr>");
              count=0;
              counter+=1
              if (h>880) {
                h-=2
              }else{
                h=900
              }

            }
          });



        });
      })
      .fail(function() {
        console.log("error ");
      })
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
  function printContentslip(el)
  {
    var divContent = document.getElementById(el);
    var WinPrint = window.open('', '', 'width=1000,height=800');
    WinPrint.document.write(divContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();

  }
  $(document).on('click','#viewasst',function(){
    var t=$('#viewasst').text();
    console.log(t)
    if (t=="-") {
      $('#viewasst').text("+");
      $('#ocbox').show();
      $('#oibox').show();
      $('#lcbox').hide();
      $('#libox').hide();
    }else{
      $('#viewasst').text("-");
      $('#ocbox').hide();
      $('#oibox').hide();
      $('#lcbox').show();
      $('#libox').show();
    }

  });
  function printContent(divName)
  {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
    var id = $('#assess_flow').val();
    $.ajax({
      url: "<?php echo base_url('fees/updateflow') ?>",
      type: 'GET',
      dataType: 'JSON',
      data: {id: id},
    })
    .always(function(data) {
      console.log("updated");
    })
  }
  </script>
