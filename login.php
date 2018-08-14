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
                        			<h3>Login to our site</h3>
                            		<p>Enter your email and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="#" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Email</label>
										<input type="text" class="form-username form-control" placeholder="Email" id="txtEmail" value="">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
										<input type="password" placeholder="Password" class="form-password form-control" id="txtPass" value="">
			                        </div>
									<input type="button" onclick="login()" id="btnLogin" value="Login" class="btn">
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<script>
		function login()
		{
			var email = $("#txtEmail").val();
			var password = $("#txtPass").val();
			var request = "login";
			$.ajax({
			  type: "POST",
			  url: "curltest.php",
			  data: {request:request,email:email,password:password},
			  success: function (response) {
				  console.log(response);
				  var obj = jQuery.parseJSON(response);
				  if(obj.message == "success")
				  {
					window.location.href = "home.php";  
				  }
				  else
				  {
					  alert("Error");
				  }
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