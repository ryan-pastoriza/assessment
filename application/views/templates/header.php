<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Assessment</title>
  <link rel="icon" href="<?php echo $this->config->base_url(); ?>assets/dist/img/logo.png">

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>/assets/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>/assets/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>/assets/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>/assets/dist/css/skins/_all-skins.min.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>/assets/bower_components/morris.js/morris.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>/assets/bower_components/jvectormap/jquery-jvectormap.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   <!-- Select2 -->
   <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>/assets/bower_components/select2/dist/css/select2.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>/assets/plugins/iCheck/all.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>/assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>/assets/dist/css/skins/_all-skins.min.css">

   <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<!-- jQuery 3 -->
<script src="<?php echo $this->config->base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $this->config->base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo $this->config->base_url(); ?>assets/bower_components/chart.js/Chart.js"></script>
<!-- FastClick -->
<script src="<?php echo $this->config->base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $this->config->base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $this->config->base_url(); ?>assets/dist/js/demo.js"></script>
<!-- Select2 -->
<script src="<?php echo $this->config->base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo $this->config->base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo $this->config->base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<!-- InputMask -->
<script src="<?php echo $this->config->base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo $this->config->base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo $this->config->base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- datatable -->
<script src="<?php echo $this->config->base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $this->config->base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- page script -->
<script type="text/javascript">
function date_time(id)
{
  date = new Date;
  year = date.getFullYear();
  month = date.getMonth();
  months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
  d = date.getDate();
  day = date.getDay();
  days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
  h = date.getHours();
  if(h<10)
  {
    h = "0"+h;
  }
  m = date.getMinutes();
  if(m<10)
  {
    m = "0"+m;
  }
  s = date.getSeconds();
  if(s<10)
  {
    s = "0"+s;
  }
  result = ''+days[day]+' '+months[month]+' '+d+' '+year+' '+h+':'+m+':'+s;
  document.getElementById(id).innerHTML = result;
  setTimeout('date_time("'+id+'");','1000');
  return true;
}
</script>
<style type="text/css">
#date_time{
  font-family: Arial, Helvetica, sans-serif;
  font-size: 11px;
  }
#show-list{
  height: 300px;
  overflow-y: auto;
  position: absolute;
  width:90%;
  z-index: 99;
}
.studimg{
  width: 200px;
  margin-top: 20px;
  margin-left: 20px;
  margin-bottom: 20px;
  margin-right: 20px;
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
}
.cb{
  margin-top: 10%;
  margin-left: 10%;
  margin-bottom: 10%;
  margin-right: 10%;
  border-radius: 4px;
}
.example-modal .modal {
  position: relative;
  top: auto;
  bottom: auto;
  right: auto;
  left: auto;
  display: block;
  z-index: 1;
}

.example-modal .modal {
  background: transparent !important;
}
@media print {
    
    #tbmain2 {
        font-size: 11px;       
    }
    #tbmain3 {
        font-size: 11px;        
    }
    #tbmain4 {
        font-size: 16px;        
    }
}
</style>

<body class="hold-transition skin-blue sidebar-mini">