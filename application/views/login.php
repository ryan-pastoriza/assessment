<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<h4>Login</h4>
			<form method="post" action="<?php $this->config->base_url(); ?>login/verify">
				<div class="form-group">
					<input type="text" name="username" class="form-control" placeholder="Username" >
					<span class="text-danger"><?php echo form_error('username'); ?></span>
				</div>
				<div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="Password" >
					<span class="text-danger"><?php echo form_error('password'); ?></span>
				</div>
				<div class="form-group">
					<span class="text-danger"><?php echo $this->session->flashdata('error'); ?></span>
				</div>
				<div class="form-group">
					<input type="submit" name="insert" value="Login" class="btn btn-primary btn-block">
				</div>
			</form>
		</div>
	</div>
</body>
<script>
	$(function () {
		var currenty = new Date().getFullYear()
		for (i = 2000; i <= currenty; i++) {
			var sy= i+1;
			var sy1=i+"-"+sy;
			$.ajax({
				url: "<?php echo base_url('login/updatesy') ?>",
				type: 'GET',
				dataType: 'JSON',
				data: {sy: sy1},
			})
			.done(function(data) {
				console.log("done ");
			})
			.fail(function() {
				console.log("error ");
			})	
		}
	})
</script>
</html>