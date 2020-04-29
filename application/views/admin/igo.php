<div class="wrapper">
  <header class="main-header">
    <a href="#" class="logo">
      <span class="logo-mini"><b>T</b>B</span>
      <span class="logo-lg"><b>Test </b>Bank</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

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
          <p><?php echo ucfirst($_SESSION['user']->fullname); ?></p>
          <a href="accessibility/logout"><i class="fa fa-circle text-success"></i> Logout</a>
        </div>
      </div>
      <ul class="sidebar-menu">
        <li class="header"><b>MAIN NAVIGATION</b></li>
        <li id="dashboard_tab">
          <a href="admindash">
            <i class="fa fa-dashboard"></i><span>Dashboard</span>
          </a>
        </li>
       <li id="access_tab">
          <a href="accessibility"><i class="glyphicon glyphicon-lock">
            </i> <span>Accessibilty</span></a>
        </li>
        <li id="access_tab">
          <a href="institutional"><i class="glyphicon glyphicon-folder-open">
            </i> <span>Institutional</span></a>
        </li>
        <li class="active" id="access_tab">
          <a href="igo"><i class="glyphicon glyphicon-list-alt">
            </i> <span>IGO</span></a>
        </li>
      </ul>
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <!-- <h1>
        Dashboard
        <small>Control panel</small>
      </h1> -->
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
    </section>
    <section class="content">
      <?php echo"igo"; ?>
    </section>
  </div>
  
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>