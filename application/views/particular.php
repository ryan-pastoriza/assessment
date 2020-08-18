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
        <li class="active" id="access_tab">
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
        Particulars
      </h1>
    </section>
    <section class="content">
      <div class="form-group">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create New Particular</h3>
            </div>
            <?php echo form_open('particular/create'); ?>
            <div class="box-body">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="particular">Particular Name *</label>
                  <input type="text" class="form-control" name="particular" placeholder="Enter Particular">
                  <span class="text-danger"><?php echo form_error('particular'); ?></span>
                </div>
                <div class="form-group">
                  <label for="amount1">Amount 1 *</label>
                  <input type="text" class="form-control" name="amount1" placeholder="Enter Amount 1">
                  <span class="text-danger"><?php echo form_error('amount1'); ?></span>
                  </div>
                <div class="form-group">
                  <label for="amount2">Amount 2 *</label>
                  <input type="text" class="form-control" name="amount2" placeholder="Enter Amount 2">
                  <span class="text-danger"><?php echo form_error('amount2'); ?></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="courseType">Course Type *</label>
                  <select class="form-control courseType" id="courseType" name="courseType" style="width: 100%;" placeholder="Select Course Type">
                    <option value=""></option>
                    <option value="1">others</option>
                    <option value="3">Senior High School</option>
                    <option value="2">2 Year Course</option>
                    <option value="5">3 Year Course</option>
                    <option value="4">4 Year Course</option>
                  </select>
                  <span class="text-danger"><?php echo form_error('courseType'); ?></span>
                </div>
                <div class="form-group">
                  <label for="feeType">Fee Type *</label>
                  <select class="form-control feeType" id="feeType" name="feeType" style="width: 100%;" placeholder="Select Fee Type">
                    <option value=""></option>
                    <option value="Others">Others</option>
                    <option value="Registration fee">Registration fee(Misc.)</option>
                    <option value="Other Fee">Other Fee(Misc.)</option>
                    <option value="Handling Fee">Handling Fee(Misc.)</option>
                    <option value="Miscellaneous">Miscellaneous</option>
                    <option value="Laboratory">Laboratory</option>
                    <option value="Subject">Subject (per unit)</option>
                    <option value="Graduation">Graduation Fee</option>
                  </select>
                  <span class="text-danger"><?php echo form_error('feeType'); ?></span>
                </div>
                <div class="form-group">
                  <label for="billType">Bill Type *</label>
                  <select class="form-control billType" id="billType" name="billType" style="width: 100%;" placeholder="Select Bill Type">
                    <option value=""></option>
                    <option value="regular">Regular</option>
                    <option value="special">Special</option>
                  </select>
                  <span class="text-danger"><?php echo form_error('sem'); ?></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="studentStatus">Student Status *</label>
                  <select class="form-control studentStatus" id="studentStatus" name="studentStatus" style="width: 100%;" placeholder="Select Student Status">
                    <option value=""></option>
                    <option value="New">New</option>
                    <option value="Old">Old</option>
                  </select>
                  <span class="text-danger"><?php echo form_error('studentStatus'); ?></span>
                </div>
                <div class="form-group">
                  <label for="sy">School Year *</label>
                  <select class="form-control sy" id="sy" name="sy" style="width: 100%;" placeholder="Select School Year">
                  <option value=""></option>
                  </select>
                  <span class="text-danger"><?php echo form_error('sy'); ?></span>
                </div>
                <div class="form-group">
                  <label for="sem">Semester *</label>
                  <select class="form-control sem" id="sem" name="sem" style="width: 100%;" placeholder="Select Semester">
                    <option value=""></option>
                    <option value="1">1st</option>
                    <option value="2">2nd</option>
                    <option value="3">Summer</option>
                  </select>
                  <span class="text-danger"><?php echo form_error('sem'); ?></span>
                </div>
              </div>
              <div class="col-md-8">
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="collection">Collection Report Group</label>
                  <select class="form-control collection" id="collection" name="collection" style="width: 100%;">
                    <option value=""></option>
                    <option value="merchandise">Merchandise</option>
                    <option value="others">Others</option>
                    <option value="unifast">Unifast</option>
                    <option value="specialExam">Special Exam</option>
                    <option value="scnl">SC/NL</option>
                    <option value="elearning">E-Learning</option>
                    <option value="nccuk">NCC-UK</option>
                    <option value="msfee">MS Fee</option>
                    <option value="oracle">Oracle</option>
                    <option value="hp">HP</option>
                    <option value="studentServices">Student Services</option>
                    <option value="stcab">ST Cab</option>
                    <option value="specialExam">Special Exam</option>
                    <option value="insurance">Insurance</option>
                    <option value="office365">Office 365</option>
                    <option value="sap">SAP</option>
                    <option value="culturalFee">Cultural Fee</option>
                    <option value="shs">SHS</option>
                    <option value="netR">NetR</option>
                  </select>
                  <span class="text-danger"><?php echo form_error('collection'); ?></span>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block">Add Particular</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Particulars</h3>
            </div>
            <div class="box-body">

              <table class="table" id="user">
                <thead>
                  <tr>
                    <th>Particular</th>
                    <th>amt1</th>
                    <th>amt2</th>
                    <th>Course</th>
                    <th>Status</th>
                    <th>Fee Type</th>
                    <th>Bill Type</th>
                    <th>SY</th>
                    <th>Sem</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($particulars as $item):?>
                    <tr>
                      <td><?php echo $item->particularName;?></td>
                      <td><?php echo $item->amt1;?></td>
                      <td><?php echo $item->amt2;?></td>
                      <td><?php echo $item->courseType;?></td>
                      <td><?php echo $item->studentStatus;?></td>
                      <td><?php echo $item->feeType;?></td>
                      <td><?php echo $item->billType;?></td>
                      <td><?php echo $item->sy;?></td>
                      <td><?php echo $item->sem;?></td>
                      <td><button class="btn btn-danger btn-block deleteButton" type="button" name="delete" value="<?php echo $item->particularId;?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>  </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
              </table>
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

  $(function () {
    $.ajax({
      url: "<?php echo base_url('particular/getsy') ?>",
      type: 'GET',
      dataType: 'JSON',
    })
    .done(function(data) {
        $.each(data, function(index, val) {
          $('#sy').append('<option value="'+val.syId+'">'+val.sy+'</option>');
          $('#sy1').append('<option value="'+val.syId+'">'+val.sy+'</option>');
        });
    })
    .fail(function() {
      console.log("error getsy");
    })

    $(document).on('click','.deleteButton',function(){
      $.ajax({
        url: '<?php echo base_url('particular/deleteParticular') ?>',
        type: 'POST',
        dataType: 'JSON',
        data: {
          particularId : $(this).val()
          },
        success: function (data) {
          window.location.reload();
        }

      });
    });
  });
  </script>
