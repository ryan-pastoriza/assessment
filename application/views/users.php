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
        Users
      </h1>
    </section>
    <section class="content">
      <div class="form-group">
        <div class="col-md-3">
          <div class="input-group">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Create New User</h3>
              </div>
              <?php echo form_open('users/create'); ?>
                <div class="box-body">
                  <div class="form-group">
                    <label for="Username">Username *</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter username">
                    <span class="text-danger"><?php echo form_error('username'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password *</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter Password">
                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="userrole">User Role *</label>
                    <select class="form-control" name="userrole">
                      <option selected="true" disabled="disabled">Choose User Role</option>
                      <option value="Accounting" >Accounting</option>
                      <option value="Cashier" >Cashier</option>
                      <option value="Queue Admin" >Queue Admin</option>
                    </select>
                    <span class="text-danger"><?php echo form_error('userrole'); ?></span>
                  </div>
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
              <?php if ($_SESSION['user']->userRole=="Admin"): ?>
              <div class="box-body">
                <div class="form-group">
                  <label for="mastercode">MasterCode</label>
                  <input type="text" class="form-control" id="mastercode" placeholder="Enter MasterCode">
                  <span class="text-danger"><?php echo form_error('mastercode'); ?></span>
                </div>
              </div>
              <div class="box-footer">
                <button id="savemastercode" class="btn btn-primary">Save</button>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Users</h3>
            </div>
            <div class="box-body ">
              <table class="table" id="user">
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                    <?php foreach ($users as $item):?>
                    <tr>
                    <td><?php echo $item->username;?></td>
                    <td><?php echo $item->userRole;?></td>
                    <td>
                    <?php
                    if ($item->userStatus=="Online")
                    {
                      echo '<span class="label label-success">Online</span>';
                    }else{
                      echo '<span class="label label-danger">Offline</span>';
                    }
                    ?>
                    </td>
                    <td>
                      <a href="#" data-toggle="modal" data-target="#modal-info<?php echo $item->userId; ?>">
                        <span style="color:blue" class="fa fa-edit "></span>
                      </a>
                      <!-- <a href="users/delete/<?php echo $item->userId;?>">
                        <span style="color:#CC0000" class="glyphicon glyphicon-trash"></span>
                      </a> -->
                      <div class="modal  fade" id="modal-info<?php echo $item->userId; ?>">
                        <div class="modal-dialog modal-sm">
                          <?php echo form_open('users/update/'.$item->userId) ?>
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit User</h4>
                              </div>
                              <div class="modal-body">
                                <div class="container-fluid">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="Username">Username</label>
                                        <input style="width:240px;" type="text" class="form-control" name="username<?php echo $item->userId; ?>" value="<?php echo $item->username;?>">

                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Password *</label>
                                        <input style="width:240px;" type="password" class="form-control" name="password<?php echo $item->userId; ?>" >

                                        </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="userrole">User Role</label>
                                        <select style="width:240px;" class="form-control" name="userrole<?php echo $item->userId; ?>">
                                          <option selected="true" disabled="disabled">Choose User Role</option>
                                          <?php
                                          if ($item->userRole=="Accounting") {
                                            echo
                                            '<option selected value="Accounting" >Accounting</option>
                                            <option value="Cashier" >Cashier</option>
                                            <option value="Queue Admin" >Queue Admin</option>';
                                          }elseif($item->userRole=="Cashier"){
                                            echo
                                            '<option value="Accounting" >Accounting</option>
                                            <option selected value="Cashier" >Cashier</option>
                                            <option value="Queue Admin" >Queue Admin</option>';
                                          }elseif($item->userRole=="Queue Admin"){
                                            echo
                                            '<option value="Accounting" >Accounting</option>
                                            <option value="Cashier" >Cashier</option>
                                            <option selected value="Queue Admin" >Queue Admin</option>';
                                          }
                                          ?>
                                        </select>

                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </td>

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
<script type="text/javascript">
$(document).on('click','#savemastercode',function(){
  var mastercode = $("#mastercode").val();
  $.ajax({
    url: "<?php echo base_url('users/savemastercode') ?>",
    type: 'GET',
    dataType: 'JSON',
    data: {mastercode: mastercode},
  })
  .done(function(data) {
      console.log(data);
      $("#mastercode").val("");
  })
  .fail(function() {
    console.log("error ");
  })
});

</script>
