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
        <li id="access_tab">
          <a href="<?php echo site_url('fees') ?>"><i class="glyphicon glyphicon-barcode">
            </i> <span>Fees</span></a>
        </li>
        <li id="access_tab">
          <a href="<?php echo site_url('particular') ?>"><i class="fa fa-dropbox">
            </i> <span>Particulars</span></a>
        </li>
        <li class="active" id="access_tab">
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
      Schedule
      </h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#feesched" data-toggle="tab"><i class="fa fa-calendar"></i> Fee Schedule</a></li>
              <li><a href="#accountslip" data-toggle="tab"><i class="fa fa-reorder"></i> Account Slip</a></li>
              <li><a href="#collectionreport" data-toggle="tab"><i class="fa fa-folder-o"></i> Collection Report</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="feesched">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="box-header with-border">
                        <h3 class="box-title">Create Fee Schedule</h3>
                      </div>
                      <?php echo form_open('reports/create'); ?>
                        <div class="box-body">
                          <div class="form-group">
                            <label for="month">Month *</label>
                            <select class="form-control" name="month">
                              <option selected="true" disabled="disabled">Choose Month</option>
                              <option value="January" >January</option>
                              <option value="February" >February</option>
                              <option value="March" >March</option>
                              <option value="April" >April</option>
                              <option value="May" >May</option>
                              <option value="June" >June</option>
                              <option value="July" >July</option>
                              <option value="August" >August</option>
                              <option value="September" >September</option>
                              <option value="October" >October</option>
                              <option value="November" >November</option>
                              <option value="December" >December</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('month'); ?></span>
                          </div>
                          <div class="form-group">
                            <label for="year">Year *</label>
                            <select class="form-control" name="year" id="year">
                              <option selected="true" disabled="disabled">Choose Year</option>
                              <?php
                              $sy2 = date('Y');
                              for ($i=$sy2; $i > 2004; $i--) {
                                echo'<option value="'.$i.'" >'.$i.'</option>';
                              }
                              ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('year'); ?></span>
                          </div>
                          <div class="form-group">
                            <label for="percent">Percent *</label>
                            <select class="form-control" name="percent">
                              <option selected="true" disabled="disabled">Choose Percent</option>
                              <option value="1" >100%</option>
                              <option value="0.95" >95%</option>
                              <option value="0.90" >90%</option>
                              <option value="0.85" >85%</option>
                              <option value="0.80" >80%</option>
                              <option value="0.75" >75%</option>
                              <option value="0.70" >70%</option>
                              <option value="0.65" >65%</option>
                              <option value="0.60" >60%</option>
                              <option value="0.55" >55%</option>
                              <option value="0.50" >50%</option>
                              <option value="0.45" >45%</option>
                              <option value="0.40" >40%</option>
                              <option value="0.35" >35%</option>
                              <option value="0.30" >30%</option>
                              <option value="0.25" >25%</option>
                              <option value="0.20" >20%</option>
                              <option value="0.15" >15%</option>
                              <option value="0.10" >10%</option>
                              <option value="0.05" >5%</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('percent'); ?></span>
                          </div>
                          <div class="form-group">
                            <label for="term">Term *</label>
                            <select class="form-control" name="term">
                              <option selected="true" disabled="disabled">Choose Term</option>
                              <option value="Prelim" >Prelim</option>
                              <option value="Midterm" >Midterm</option>
                              <option value="PreFinal" >PreFinal</option>
                              <option value="Final" >Final</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('term'); ?></span>
                          </div>
                          <div class="form-group">
                            <label for="sy">School Year *</label>
                            <select class="form-control" name="sy">
                              <option selected="true" disabled="disabled">Choose School Year</option>
                              <?php foreach ($syId as $item):?>
                                <option value="<?php echo $item->syId; ?>" ><?php echo $item->sy; ?></option>
                              <?php endforeach;?>
                            </select>
                            <span class="text-danger"><?php echo form_error('sy'); ?></span>
                          </div>
                          <div class="form-group">
                            <label for="sem">Semester *</label>
                            <select class="form-control sem" id="sem" name="sem" style="width: 100%;" placeholder="Select Semester">\
                              <option selected="true" disabled="disabled">Choose Semester</option>
                              <option value="1">1st</option>
                              <option value="2">2nd</option>
                              <option value="3">Summer</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('sem'); ?></span>
                          </div>
                        </div>
                        <div class="box-footer">
                          <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-9">
                      <div class="box-header with-border">
                        <h3 class="box-title">Schedules</h3>
                      </div>
                      <table class="table" id="scheduletable">
                        <thead>
                          <tr>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Percent</th>
                            <th>Term</th>
                            <th>SY</th>
                            <th>SEM</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($sched as $item):?>
                          <tr>
                            <td><?php echo $item->month; ?></td>
                            <td><?php echo $item->year; ?></td>
                            <td><?php echo $item->percent; ?></td>
                            <td><?php echo $item->label; ?></td>
                            <td><?php echo $item->sy; ?></td>
                            <td><?php echo $item->sem; ?></td>
                            <td>
                              <a href="<?php echo $this->config->base_url(); ?>reports/delete/<?php echo $item->feeSchedId;?>">
                                <span style="color:#CC0000" class="glyphicon glyphicon-trash"></span>
                              </a>
                            </td>
                          </tr>
                          <?php endforeach;?>
                        </tbody>
                      </table>
                    </div>
                  </div>

              </div>

              <div class="tab-pane" id="accountslip">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <select class="form-control" name="sygen" id="sygen">
                        <option selected="true" disabled="disabled">Select SY</option>
                        <?php foreach ($syId as $item):?>
                          <option value="<?php echo $item->sy; ?>" ><?php echo $item->sy; ?></option>
                        <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <select class="form-control" id="semgen" name="semgen" style="width: 100%;">
                        <option selected="true" disabled="disabled">Select SEM</option>
                        <option value="1st">1st</option>
                        <option value="2nd">2nd</option>
                        <option value="Summer">Summer</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <select class="form-control" id="level" name="level" style="width: 100%;">
                        <option selected="true" disabled="disabled">Select Level</option>
                        <option value="Senior High" >Senior High</option>
                        <option value="College" >College</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary" id="generate">Generate</button>
                      <button class="btn btn-primary" id="print" onclick="printContent('toprint');">Print</button>
                    </div>
                  </div>
                </div>
                <div class="row" id="toprint">
                  <table class="table table-sm" id="tbmain" >
                    <tbody id="as">

                    </tbody>

                  </table>

                </div>

              </div>
              <div class="tab-pane active" id="collectionreport">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <select class="form-control" name="month1" id="month1">
                        <option selected="true" disabled="disabled">Choose Month</option>
                        <option value="1" >January</option>
                        <option value="2" >February</option>
                        <option value="3" >March</option>
                        <option value="4" >April</option>
                        <option value="5" >May</option>
                        <option value="6" >June</option>
                        <option value="7" >July</option>
                        <option value="8" >August</option>
                        <option value="9" >September</option>
                        <option value="10" >October</option>
                        <option value="11" >November</option>
                        <option value="12" >December</option>
                      </select>
                      <span class="text-danger"><?php echo form_error('month1'); ?></span>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <select class="form-control" name="year" id="year1">
                        <option selected="true" disabled="disabled">Choose Year</option>
                        <?php
                        $sy2 = date('Y');
                        for ($i=$sy2; $i > 2004; $i--) {
                          echo'<option value="'.$i.'" >'.$i.'</option>';
                        }
                        ?>
                      </select>
                      <span class="text-danger"><?php echo form_error('year1'); ?></span>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary" id="transfercollection">Transfer Collection</button><h5 id="status"></h5>
                    </div>
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
  <script>
  var fullDate = new Date()
  var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : + (fullDate.getMonth()+1);
  var currentDate =  twoDigitMonth + "/" + fullDate.getDate()+ "/" + fullDate.getFullYear();
  $(document).on('click','#transfercollection',function(){
    var year2 = $('#year1').val();
    var month2 = $('#month1').val();
    if (year2!=null   && month2!=null) {
      $("#status").text('  Generating...');
      $.ajax({
        url: "<?php echo base_url('reports/transfercollection') ?>",
        type: 'GET',
        dataType: 'JSON',
        data: {month: month2,year: year2}
      })
      .done(function(data) {
        $.each(data, function(index, val) {

        });
        $("#status").text('  Done!');
      })
      .fail(function(data) {
        $("#status").text('  Error!');
      })
    }
  });
  $(document).on('click','#generate',function(){
    var sy1 = $('#sygen').val();
    var sem1 = $('#semgen').val();
    var level = $('#level').val();
    console.log(sy1)
    console.log(sem1)
    console.log(level)
    if (sy1!=null && sem1!=null && level!=null ) {
      $.ajax({
        url: "<?php echo base_url('reports/generate') ?>",
        type: 'GET',
        dataType: 'JSON',
        data: {sy: sy1,sem: sem1,level: level},
      })
      .done(function(data) {
        $('#as').html("");
        console.log(data)
        var count =0;
        var counter=0;
        var counter1=0;
        var h=900;
        var w = 0
        $.each(data, function(index, val) {
          $.each(val.student, function(index1, val1) {
              if (val1.ssi_id !== undefined) {
                counter1+=1
                if (counter1<=5) {
                  w+=230
                  $("#tbmain").width(w);
                }
                if (count==0) {
                  $('#as').append('<tr id="tr'+counter+'" style="height:'+h+';" valign="top">');
                }
                $("#tr"+counter+"").append("<td id='as"+val1.ssi_id+"' style='width:250px;'");
                $("#as"+val1.ssi_id+"").append('<table frame="box" width="230px" class="table table-sm" id="table'+val1.ssi_id+'">');
                $('#table'+val1.ssi_id+'').append('<tr style="height:30px;"><td></td><td></td><td></td></tr>');
                $('#table'+val1.ssi_id+'').append('<tr><td align="center" colspan="3">ACLC College of Butan City, Inc.</td></tr>');
                $('#table'+val1.ssi_id+'').append('<tr><td align="center" colspan="3">HDS Building JC Aquino Ave.</td></tr>');
                $('#table'+val1.ssi_id+'').append('<tr style="height:10px;"><td></td><td></td><td></td></tr>');
                $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="2">Account Slip</td><td align="right">'+currentDate+'</td></tr>');
                $('#table'+val1.ssi_id+'').append('<tr><td align="left" colspan="3">'+val1.lname+' '+val1.fname+', '+val1.mname.charAt(0)+'.</td></tr>');
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
              }else{
                alert("No Result!")
              }
          });
        });
      })
      .fail(function() {
        console.log("error ");
      })
    }

  });
  function tonum(num1)
  {
    var n=num1
    var parts = n.toFixed(2).split(".");
    var num = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + (parts[1] ? "." + parts[1] : "");
    return num;
  }
  function printContent(el){
    // var restorepage = $('body').html();
    // var printcontent = $('#' + el).clone();
    // $('body').empty().html(printcontent);
    // window.print();
    // $('body').html(restorepage);
    var divContent = document.getElementById(el);
    var WinPrint = window.open('', '', 'width=1300,height=800');
    WinPrint.document.write(divContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
    location.reload();


  }




  </script>
