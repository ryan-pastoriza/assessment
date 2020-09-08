
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
                  <div class="row" id="toprintas2">
                    <table class="table table-sm" id="tbmainas2" border="1" style="width:800px;">
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
                  <button type="button" id="discount" class="btn btn-block btn-primary" data-toggle="modal" data-target="#discountModal">Discount</button>
                  <button type="button" id="print" class="btn btn-block btn-primary" onclick="printContentslip('toprint');">Account Slip</button>
                  <button type="button" id="print2" class="btn btn-block btn-primary" onclick="printContent('toprintsi');">Registration Form 1</button>
                  <button type="button" id="print3" class="btn btn-block btn-primary" onclick="printContent('toprintsb');">Registration Form 2</button>
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
              <li class="active"><a href="#assessmenttab" data-toggle="tab">Assessment</a></li>
              <li><a href="#bridgingtab" data-toggle="tab">Bridging</a></li>
              <li><a href="#tutorialtab" data-toggle="tab">Tutorial</a></li>
              <li><a href="#subjectstab" data-toggle="tab">Subjects</a></li>
              <li><a href="#otherptab" data-toggle="tab">Other Payments</a></li>
              <li style='float: right;' id="viewassb"><a href="#"  id="viewasst"></a></li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="assessmenttab">
                <div class="box">
                  <!-- <div class="box-header">
                    <h3 class="box-title">Assessment</h3>
                  </div> -->
                  <div class="box-body no-padding" id="test">

                  </div>
                </div>
              </div>

              <div class="tab-pane" id="bridgingtab">
                <div class="box">
                  <!-- <div class="box-header">
                    <h3 class="box-title">Bridging</h3>
                  </div> -->
                  <div class="box-body no-padding">

                  </div>
                </div>
              </div>

              <div class="tab-pane" id="tutorialtab">
                <div class="box">
                  <!-- <div class="box-header">
                    <h3 class="box-title">Tutorial</h3>
                  </div> -->
                  <div class="box-body no-padding">

                  </div>
                </div>
              </div>

              <div class="tab-pane" id="subjectstab">
                <div class="box">
                  <!-- <div class="box-header">
                    <h3 class="box-title">Subjects</h3>
                  </div> -->
                  <div class="box-body no-padding">

                  </div>
                </div>
              </div>

              <div class="tab-pane" id="otherptab">
                <div class="box">
                  <!-- <div class="box-header">
                    <h3 class="box-title">Other Payments</h3>
                  </div> -->
                  <div class="box-body no-padding">

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
$('#toprintas2').hide();
//$('#reassess').hide();
//$('#discount').hide();
// $('#print').hide();
// $('#print2').hide();
// $('#print3').hide();
if (userrole=="Admin")
{
  $('#viewassb').show();
  $('#viewasst').text("-");
}
else
{
  $('#viewassb').hide();
}

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
      url: "<?php echo base_url('fees2/searchinfo') ?>",
      type: 'GET',
      dataType: 'JSON',
      data: {id: id,sem: sem,sy: sy,acctno: acctno},
    })
    .done(function(data) {
      console.log(data);
      $.each(data, function(index, val) {
        var assesssysem=""
        var box=""
        var ft=''
        var amt2=0
        var asscount=0
        var totalass2=0
        $.each(val.assessment, function(index1, val1) {
          asscount+=1
          if (assesssysem!=val1.sy+val1.sem) {
            $('#test').append('<div class="box"><div class="box-header with-border"><h3 class="box-title">'+val1.sy+' '+val1.sem+'</h3><div class="box-tools pull-right"></div></div><div class="box-body"><div class="row"><div class="col-md-6"><table id="asstb"><tbody id="'+val1.sy+val1.sem+'"><tr><td></td></tr></tbody></table></div><div class="row"><div class="col-md-6"><table id="assptb"><tbody id="pay'+val1.sy+val1.sem+'"><tr><td></td></tr></tbody></table></div></div></div><div class="box-footer"></div></div>')
            $('#pay'+val1.sy+val1.sem).append('<tr><td><h3>Asessment:</h3></td><td></td><td></td><td></td><td></td></tr>')
            if (amt2>0) {
              $('#'+assesssysem).append('<tr><td></td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(amt2))+'</td></tr>')
              $('#pay'+assesssysem).append('<tr><td>'+ft+'</td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(amt2))+'</td></tr>')
              amt2=0
              $('#'+assesssysem).append('<tr><td></td><td></td><td></td><td></td><td>______________</td></tr>')
              $('#'+assesssysem).append('<tr><td>TOTAL ASSESSMENT:</td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(totalass2))+'</td></tr>')
              $('#pay'+assesssysem).append('<tr><td></td><td></td><td></td><td></td><td>____________</td></tr>')
              $('#pay'+assesssysem).append('<tr><td>TOTAL ASSESSMENT:</td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(totalass2))+'</td></tr>')
              totalass2=0
            }
            assesssysem=val1.sy+val1.sem
            amt2=0
          }
          if (ft==val1.feeType) {
            $('#'+val1.sy+val1.sem).append('<tr><td></td><td>'+val1.particular+'</td><td id="hideamt2">'+tonum(parseFloat(val1.amt2))+'</td></tr>')
            amt2=(amt2+parseFloat(val1.amt2))
            totalass2=(totalass2+parseFloat(val1.amt2))
          }
          else
          {
            if (amt2>0) {
              $('#'+val1.sy+val1.sem).append('<tr><td></td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(amt2))+'</td></tr>')
              $('#pay'+val1.sy+val1.sem).append('<tr><td>'+ft+'</td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(amt2))+'</td></tr>')
              amt2=0
            }
            ft=val1.feeType
            $('#'+val1.sy+val1.sem).append('<tr><td>'+val1.feeType+'</td><td></td><td></td><td></td></tr>')
            $('#'+val1.sy+val1.sem).append('<tr><td></td><td>'+val1.particular+'</td><td id="hideamt2">'+tonum(parseFloat(val1.amt2))+'</td></tr>')
            amt2=(amt2+parseFloat(val1.amt2))
            totalass2=(totalass2+parseFloat(val1.amt2))
          }

          if (asscount==val.assessment.length) {
            $('#'+assesssysem).append('<tr><td></td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(amt2))+'</td></tr>')
            $('#pay'+val1.sy+val1.sem).append('<tr><td>'+ft+'</td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(amt2))+'</td></tr>')
            amt2=0
            $('#'+assesssysem).append('<tr><td></td><td></td><td></td><td></td><td>______________</td></tr>')
            $('#'+assesssysem).append('<tr><td>TOTAL ASSESSMENT:</td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(totalass2))+'</td></tr>')
            $('#pay'+assesssysem).append('<tr><td></td><td></td><td></td><td></td><td>____________</td></tr>')
            $('#pay'+assesssysem).append('<tr><td>TOTAL ASSESSMENT:</td><td></td><td></td><td></td><td id="hideamt2">'+tonum(parseFloat(totalass2))+'</td></tr>')
            totalass2=0
          }
        });
        var or=""
        var paysysem=""
        $.each(val.assessmentPayments, function(index1, val1) {
          if (paysysem==val1.sy+val1.sem) {
            if (or==val1.orNo) {
              $('#pay'+paysysem).append('<tr><td></td><td></td><td>'+val1.feeType+'</td><td></td><td id="hideamt2">'+tonum(parseFloat(val1.amt2))+'</td></tr>')
            }
            else
            {
              $('#pay'+paysysem).append('<tr><td>'+toDate(val1.paymentDate)+'</td><td>'+val1.orNo+'</td><td>'+val1.feeType+'</td><td></td><td id="hideamt2">'+tonum(parseFloat(val1.amt2))+'</td></tr>')
            }
          }
          else
          {
            $('#pay'+val1.sy+val1.sem).append('<tr><td><h3>Payments:</h3></td><td></td><td></td><td></td><td></td></tr>')
            if (or==val1.orNo) {
              $('#pay'+val1.sy+val1.sem).append('<tr><td></td><td></td><td>'+val1.feeType+'</td><td></td><td id="hideamt2">'+tonum(parseFloat(val1.amt2))+'</td></tr>')
            }
            else
            {
              $('#pay'+val1.sy+val1.sem).append('<tr><td>'+toDate(val1.paymentDate)+'</td><td>'+val1.orNo+'</td><td>'+val1.feeType+'</td><td></td><td id="hideamt2">'+tonum(parseFloat(val1.amt2))+'</td></tr>')
            }
          }
          paysysem=val1.sy+val1.sem
          or=val1.orNo
        });
      });
    })
    .fail(function() {

    })
});
function toDate(dateStr) {
  myDate = new Date(dateStr).toLocaleDateString();
  return myDate
}
$(document).on('click','#viewasst',function(){
  var t=$('#viewasst').text();
  console.log(t)
  if (t=="-") {
    $('#viewasst').text("+");
    $('#hideamt1').hide();
    $('#hideamt2').hide();
    // $('#ocbox').show();
    // $('#oibox').show();
    // $('#lcbox').hide();
    // $('#libox').hide();
  }else{
    $('#viewasst').text("-");
    $('#hideamt1').hide();
    $('#hideamt2').hide();
    // $('#ocbox').hide();
    // $('#oibox').hide();
    // $('#lcbox').show();
    // $('#libox').show();
  }
  $('#viewasst').click(function() {
    $('#asstb tbody:td:nth-child(1)').hide();
    console.log("click")
})
})
</script>
