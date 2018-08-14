<html>
<head>
	<script src="jquery-1.11.2.min.js"></script>
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.backstretch.min.js"></script>
	<script src="assets/js/scripts.js"></script>
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/form-elements.css">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<div class="top-content">
		<div class="inner-bg">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3 form-box">
						<div class="form-top">
							<div class="form-top-left">
								<h3>Register to our site</h3>
								<p>Enter your name, email, and password to registration:</p>
							</div>
							<div class="form-top-right">
								<i class="fa fa-lock"></i>
							</div>
						</div>
						<div class="form-bottom">
							<form role="form" action="#" method="post" class="login-form">
								<div class="form-group">
									<label class="sr-only" for="form-username">Nama</label>
									<input type="text" id="txtNama" value="" placeholder="Nama" class="form-username form-control">
								</div>
								<div class="form-group">
									<label class="sr-only" for="form-username">Email</label>
									<input type="text" id="txtEmail" value="" placeholder="Email" class="form-username form-control">
								</div>
								<div class="form-group">
									<label class="sr-only" for="form-password">Password</label>
									<input type="password" id="txtPass" value="" placeholder="Password" class="form-password form-control">
								</div>
								<input type="button" onclick="register()" id="btnRegister" value="Register" class="btn">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	<script>
		function register()
		{
			var nama = $("#txtNama").val();
			var email = $("#txtEmail").val();
			var password = $("#txtPass").val();
			var request = "register";
			$.ajax({
			  type: "POST",
			  url: "curltest.php",
			  data: {request:request,nama:nama,email:email,password:password},
			  success: function (response) {
				  console.log(response);
			  },
			  error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				alert(xhr.responseText);
			  }
			});
		}
	</script>
</body>
</html>