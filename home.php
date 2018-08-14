<html>
<head>
	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assetForHome/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assetForHome/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assetForHome/css/form-elements.css">
        <link rel="stylesheet" href="assetForHome/css/style.css">
	<script src="jquery-1.11.2.min.js"></script>
	<script src="assetForHome/js/jquery-1.11.1.min.js"></script>
	<script src="assetForHome/bootstrap/js/bootstrap.min.js"></script>
	<script src="assetForHome/js/jquery.backstretch.min.js"></script>
	<script src="assetForHome/js/scripts.js"></script>
</head>
<body>
	<div class="top-content">
		<div class="inner-bg">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3 form-box">
						<div class="form-top">
							<div class="form-top-left">
								<?php
								session_start();
								?>
								Welcome, <?php echo $_SESSION["nama"]?> <br><br>
								Email : <?php echo $_SESSION["email"]?> <br>
								Your API Key : <?php echo $_SESSION["apikey"] ?> <br>
								Your Credit : <?php echo "Rp. ".$_SESSION["saldo"] ?> <br>
								<button id="pay-button">Pay!</button>
								<input type="hidden" id="hiddenApiKey" value="<?php echo $_SESSION["apikey"]?>">
								<input type="hidden" id="hiddenEmail" value="<?php echo $_SESSION["email"]?>"> <br>
								Change Password : <input type="password" id="txtPassword" value =""> <br>
								<input type="button" value="Change Password" onclick="changePassword()" class="btn" style="color:#fff;position:relative;margin-left:37%;margin-top:1%">
							</div>
							<div class="form-top-right">
								<input type="button" value="Log Out" onclick="logout()" class="btn">
							</div>
						</div>
						<div class="form-bottom" style="display:none;">
							<select onchange="changeCRUD">
							<option value="provinsi" checked>Provinsi</option>
							<option value="kabupaten">Kabupaten</option>
							<option value="kecamatan">Kecamatan</option>
							<option value="kelurahan">Kelurahan</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			
			<div class="bottom-content">
			<div class="form-bottom">
							<form role="form" action="#" method="post" class="login-form">
								<div id="ajaxCRUD">
								<div id="ajaxProv">
								<h2>Provinsi</h2>
								<div class="form-group">
									<div id="prov1">
									<input type="text" id="txtInsertProvinsi" value="" placeholder="Insert Provinsi" class="form-username form-control">
									<input type="button" value="Insert Provinsi" id="btnInsertProvinsi" onclick="insertProvinsi()" class="btn" style="margin-top:0.5%">
									</div>
								</div>
								<div class="form-group">
									<div id="prov2" >
									<?php
										$apikey = $_SESSION["apikey"];
										$url = 'localhost/soa_master/api/provinsiku';
										$curl = curl_init();
										curl_setopt($curl,CURLOPT_URL,$url);
										curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
										curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
										//curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
										curl_setopt($curl, CURLOPT_HTTPHEADER, array(
											'apikey: '.$apikey
										));
										$output = curl_exec($curl);
										$obj = json_decode($output);
										echo "<select id='selectUpdateProvinsi' class='form-username form-control'>";
										foreach($obj as $r)
										{
											echo "<option value='".$r->id_prov."'>".$r->nama."</option>";
										}
										echo "</select>";
									?>
									<input type="text" id="txtUpdateProvinsi" value="" placeholder="Update Provinsi" class="form-username form-control" style="margin-top:0.5%;margin-bottom:0.5%">
									<input type="button" value="Update Provinsi" id="btnChangeProvinsi" onclick="updateProvinsi()" class="btn">
									</div>
								</div>
								<div class="form-group">
									<div id="prov3">
									<?php
										$apikey = $_SESSION["apikey"];
										$url = 'localhost/soa_master/api/provinsiku';
										$curl = curl_init();
										curl_setopt($curl,CURLOPT_URL,$url);
										curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
										curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
										//curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
										curl_setopt($curl, CURLOPT_HTTPHEADER, array(
											'apikey: '.$apikey
										));
										$output = curl_exec($curl);
										$obj = json_decode($output);
										echo "<select id='selectDeleteProvinsi' class='form-username form-control'>";
										foreach($obj as $r)
										{
											echo "<option value='".$r->id_prov."'>".$r->nama."</option>";
										}
										echo "</select>";
									?>
									<input type="button" value="Delete Provinsi" id="btnDeleteProvinsi" onclick="deleteProvinsi()" class="btn" style="margin-top:0.5%">
									</div>
								</div>
								</div>
								<div id="ajaxKab">
								<h2>Kabupaten</h2>
									<div class="form-group">
										<div id="kab1">
										<?php
											$apikey = $_SESSION["apikey"];
											$url = 'localhost/soa_master/api/provinsiku';
											$curl = curl_init();
											curl_setopt($curl,CURLOPT_URL,$url);
											curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
											curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
											//curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
											curl_setopt($curl, CURLOPT_HTTPHEADER, array(
												'apikey: '.$apikey
											));
											$output = curl_exec($curl);
											$obj = json_decode($output);
											echo "<select id='selectInsertKabupatenProvinsi' class='form-username form-control'>";
											foreach($obj as $r)
											{
												echo "<option value='".$r->id_prov."'>".$r->nama."</option>";
											}
											echo "</select>";
										?>
										<input type="text" id="txtInsertKabupaten" value="" placeholder="Insert Kabupaten" class="form-username form-control" style="margin-top:0.5%;margin-bottom:0.5%">
										<input type="button" value="Insert Kabupaten" id="btnInsertKabupaten" onclick="insertKabupaten()" class="btn">
										</div>
									</div>
									<div class="form-group">
										<div id="kab2">
											<?php
												$apikey = $_SESSION["apikey"];
												$url = 'localhost/soa_master/api/kabupatenku';
												$curl = curl_init();
												curl_setopt($curl,CURLOPT_URL,$url);
												curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
												curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
												//curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
												curl_setopt($curl, CURLOPT_HTTPHEADER, array(
													'apikey: '.$apikey
												));
												$output = curl_exec($curl);
												$obj = json_decode($output);
												echo "<select id='selectUpdateKabupaten' class='form-username form-control'>";
												foreach($obj as $r)
												{
													echo "<option value='".$r->id_kab."'>".$r->nama."</option>";
												}
												echo "</select>";
											?>
											<input type="text" id="txtUpdateKabupaten" placeholder="Update Kabupaten" value="" class="form-username form-control" style="margin-top:0.5%;margin-bottom:0.5%">
											<input type="button" value="Update Kabupaten" id="btnChangeKabupaten" onclick="updateKabupaten()" class="btn">
										</div>
									</div>
									<div class="form-group">
										<div id="kab3">
											<?php
												$apikey = $_SESSION["apikey"];
												$url = 'localhost/soa_master/api/kabupatenku';
												$curl = curl_init();
												curl_setopt($curl,CURLOPT_URL,$url);
												curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
												curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
												//curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
												curl_setopt($curl, CURLOPT_HTTPHEADER, array(
													'apikey: '.$apikey
												));
												$output = curl_exec($curl);
												$obj = json_decode($output);
												echo "<select id='selectDeleteKabupaten' class='form-username form-control'>";
												foreach($obj as $r)
												{
													echo "<option value='".$r->id_prov."'>".$r->nama."</option>";
												}
												echo "</select>";
											?>
											<input type="button" value="Delete Kabupaten" id="btnDeleteKabupaten" onclick="deleteKabupaten()" class="btn" style="margin-top:0.5%">
										</div>
									</div>
								</div>
								<div id="ajaxKec">
								<h2>Kecamatan</h2>
								<div class="form-group">
									<div id="kec1">
									<?php
										$apikey = $_SESSION["apikey"];
										$url = 'localhost/soa_master/api/kabupatenku';
										$curl = curl_init();
										curl_setopt($curl,CURLOPT_URL,$url);
										curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
										curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
										//curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
										curl_setopt($curl, CURLOPT_HTTPHEADER, array(
											'apikey: '.$apikey
										));
										$output = curl_exec($curl);
										$obj = json_decode($output);
										echo "<select id='selectInsertKecamatanKabupaten' class='form-username form-control'>";
										foreach($obj as $r)
										{
											echo "<option value='".$r->id_kab."'>".$r->nama."</option>";
										}
										echo "</select>";
									?>
									<input type="text" id="txtInsertKecamatan" value="" placeholder="Insert Kecamatan" class="form-username form-control" style="margin-top:0.5%;margin-bottom:0.5%">
									<input type="button" value="Insert Kecamatan" id="btnInsertKecamatan" onclick="insertKecamatan()" class="btn">
									</div>
								</div>
								<div class="form-group">
									<div id="kec2">
									<?php
										set_time_limit(0);
										$apikey = $_SESSION["apikey"];
										$url = 'localhost/soa_master/api/kecamatanku';
										$curl = curl_init();
										curl_setopt($curl,CURLOPT_URL,$url);
										curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
										curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
										//curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
										curl_setopt($curl, CURLOPT_HTTPHEADER, array(
											'apikey: '.$apikey
										));
										$output = curl_exec($curl);
										$obj = json_decode($output);
										echo "<select id='selectUpdateKecamatan' class='form-username form-control'>";
										foreach($obj as $r)
										{
											echo "<option value='".$r->id_kec."'>".$r->nama."</option>";
										}
										echo "</select>";
									?>
									<input type="text" id="txtUpdateKecamatan" value="" placeholder="Update Kecamatan" class="form-username form-control" style="margin-top:0.5%;margin-bottom:0.5%">
									<input type="button" value="Update Kecamatan" id="btnChangeKecamatan" onclick="updateKecamatan()" class="btn">
								</div>
								</div>
								<div class="form-group">
								<div id="kec3">
								<?php
									$apikey = $_SESSION["apikey"];
									$url = 'localhost/soa_master/api/kecamatanku';
									$curl = curl_init();
									curl_setopt($curl,CURLOPT_URL,$url);
									curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
									curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
									//curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
									curl_setopt($curl, CURLOPT_HTTPHEADER, array(
										'apikey: '.$apikey
									));
									$output = curl_exec($curl);
									$obj = json_decode($output);
									echo "<select id='selectDeleteKecamatan' class='form-username form-control'>";
									foreach($obj as $r)
									{
										echo "<option value='".$r->id_kec."'>".$r->nama."</option>";
									}
									echo "</select>";
								?>
								<input type="button" value="Delete Kecamatan" id="btnDeleteKecamatan" onclick="deleteKecamatan()" class="btn" style="margin-top:0.5%">
								</div>
								</div>
								</div>
								<div id="ajaxKel">
								<h2>Kelurahan</h2>
								<div class="form-group">
								<div id="kel1">
								<?php
									$apikey = $_SESSION["apikey"];
									$url = 'localhost/soa_master/api/kecamatanku';
									$curl = curl_init();
									curl_setopt($curl,CURLOPT_URL,$url);
									curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
									curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
									//curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
									curl_setopt($curl, CURLOPT_HTTPHEADER, array(
										'apikey: '.$apikey
									));
									$output = curl_exec($curl);
									$obj = json_decode($output);
									echo "<select id='selectInsertKelurahanKecamatan' class='form-username form-control'>";
									foreach($obj as $r)
									{
										echo "<option value='".$r->id_kec."'>".$r->nama."</option>";
									}
									echo "</select>";
								?>
								<input type="text" id="txtInsertKelurahan" value="" placeholder="Insert Kelurahan" class="form-username form-control" style="margin-top:0.5%;margin-bottom:0.5%">
								<input type="button" value="Insert Kelurahan" id="btnInsertKelurahan" onclick="insertKelurahan()" class="btn">
								</div>
								</div>
								<div class="form-group">
								<div id="kel2">
								<?php
									set_time_limit(0);
									$apikey = $_SESSION["apikey"];
									$url = 'localhost/soa_master/api/kelurahanku';
									$curl = curl_init();
									curl_setopt($curl,CURLOPT_URL,$url);
									curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
									curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
									//curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
									curl_setopt($curl, CURLOPT_HTTPHEADER, array(
										'apikey: '.$apikey
									));
									$output = curl_exec($curl);
									$obj = json_decode($output);
									echo "<select id='selectUpdateKelurahan' class='form-username form-control'>";
									foreach($obj as $r)
									{
										echo "<option value='".$r->id_kel."'>".$r->nama."</option>";
									}
									echo "</select>";
								?>
								<input type="text" id="txtUpdateKelurahan" value="" placeholder="Update Kelurahan" class="form-username form-control" style="margin-top:0.5%;margin-bottom:0.5%">
								<input type="button" value="Update Kelurahan" id="btnChangeKelurahan" onclick="updateKelurahan()" class="btn">
								</div>
								</div>
								<div class="form-group">
								<div id="kel3">
								<?php
									$apikey = $_SESSION["apikey"];
									$url = 'localhost/soa_master/api/kelurahanku';
									$curl = curl_init();
									curl_setopt($curl,CURLOPT_URL,$url);
									curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
									curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
									//curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
									curl_setopt($curl, CURLOPT_HTTPHEADER, array(
										'apikey: '.$apikey
									));
									$output = curl_exec($curl);
									$obj = json_decode($output);
									echo "<select id='selectDeleteKelurahan' class='form-username form-control'>";
									foreach($obj as $r)
									{
										echo "<option value='".$r->id_kel."'>".$r->nama."</option>";
									}
									echo "</select>";
								?>
								<input type="button" value="Delete Kelurahan" id="btnDeleteKelurahan" onclick="deleteKelurahan()" class="btn" style="margin-top:0.5%;">
								</div>
								</div>
								</div>
							</form>
						</div>
			</div>
		</div>
		</div>
		</div>
		</div>
	</div>
	<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-hNYFeJ2u_a4w-pa8"></script>
	<script type="text/javascript">
	  document.getElementById('pay-button').onclick = function(){
		// This is minimal request body as example.
		// Please refer to docs for all available options: https://snap-docs.midtrans.com/#json-parameter-request-body
		// TODO: you should change this gross_amount and order_id to your desire. 
		var requestBody = 
		{
		  transaction_details: {
			gross_amount: 1000,
			// as example we use timestamp as order ID
			order_id: 'T-'+Math.round((new Date()).getTime() / 1000) 
		  }
		}
		
		getSnapToken(requestBody, function(response){
		  var response = JSON.parse(response);
		  console.log("new token response", response);
		  // Open SNAP payment popup, please refer to docs for all available options: https://snap-docs.midtrans.com/#snap-js
		  snap.pay(response.token);
		})
	  };
	  /**
	  * Send AJAX POST request to checkout.php, then call callback with the API response
	  * @param {object} requestBody: request body to be sent to SNAP API
	  * @param {function} callback: callback function to pass the response
	  */
	  function getSnapToken(requestBody, callback) {
		var xmlHttp = new XMLHttpRequest();
		xmlHttp.onreadystatechange = function() {
		  if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			callback(xmlHttp.responseText);
		  }
		}
		xmlHttp.open("post", "http://localhost/midtrans/checkout.php");
		xmlHttp.send(JSON.stringify(requestBody));
	  }
	</script>
	<script>
		function changePassword()
		{
			var apikey = $("#hiddenApiKey").val();
			var email = $("#hiddenEmail").val();
			var newPassword = $("#txtPassword").val();
			var request = "changePassword";
			$.ajax({
			  type: "POST",
			  url: "curltest.php",
			  data: {request:request,email:email,apikey:apikey,newPassword:newPassword},
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
		
		function insertProvinsi()
		{
			var text = $("#txtInsertProvinsi").val();
			var request="insertProvinsi";
			var apikey = $("#hiddenApiKey").val();
			$.ajax({
			  type: "POST",
			  url: "curltest.php",
			  data: {request:request,text:text,apikey:apikey},
			  success: function (response) {
				  console.log(response);
				  location.reload();
			  },
			  error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				alert(xhr.responseText);
			  }
			});
		}
		function insertKabupaten()
		{
			var text = $("#txtInsertKabupaten").val();
			var request = "insertKabupaten";
			var apikey = $("#hiddenApiKey").val();
			var id_prov = $("#selectInsertKabupatenProvinsi").val();
			$.ajax({
			  type: "POST",
			  url: "curltest.php",
			  data: {request:request,text:text,apikey:apikey,id_prov:id_prov},
			  success: function (response) {
				  console.log(response);
				  location.reload();
			  },
			  error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				alert(xhr.responseText);
			  }
			});
		}
		function insertKecamatan()
		{
			var text = $("#txtInsertKecamatan").val();
			var request = "insertKelurahan";
			var apikey = $("#hiddenApiKey").val();
			var id_kec = $("#selectInsertKelurahanKecamatan").val();
			$.ajax({
			  type: "POST",
			  url: "curltest.php",
			  data: {request:request,text:text,apikey:apikey,id_kec:id_kec},
			  success: function (response) {
				  console.log(response);
				  location.reload();
			  },
			  error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				alert(xhr.responseText);
			  }
			});
		}
		function insertKelurahan()
		{
			var text = $("#txtInsertKelurahan").val();
			var request = "insertKelurahan";
			var apikey = $("#hiddenApiKey").val();
			var id_kec = $("#selectInsertKelurahanKecamatan").val();
			$.ajax({
			  type: "POST",
			  url: "curltest.php",
			  data: {request:request,text:text,apikey:apikey,id_kec:id_kec},
			  success: function (response) {
				  console.log(response);
				  location.reload();
			  },
			  error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				alert(xhr.responseText);
			  }
			});
		}
		//79328
		function updateProvinsi()
		{
			var select = $("#selectUpdateProvinsi").val();
			var text = $("#txtUpdateProvinsi").val();
			var request = "updateProvinsi";
			var apikey = $("#hiddenApiKey").val();
			$.ajax({
			  type: "POST",
			  url: "curltest.php",
			  data: {request:request,id_prov:select,text:text,apikey:apikey},
			  success: function (response) {
				  console.log(response);
				  location.reload();
			  },
			  error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				alert(xhr.responseText);
			  }
			});
		}
		function updateKabupaten()
		{
			var select = $("#selectUpdateKabupaten").val();
			var text = $("#txtUpdateKabupaten").val();
			var request = "updateKabupaten";
			var apikey = $("#hiddenApiKey").val();
			$.ajax({
			  type: "POST",
			  url: "curltest.php",
			  data: {request:request,id_kab:select,text:text,apikey:apikey},
			  success: function (response) {
				  console.log(response);
				  location.reload();
			  },
			  error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				alert(xhr.responseText);
			  }
			});
		}
		function updateKecamatan()
		{
			var select = $("#selectUpdateKecamatan").val();
			var text = $("#txtUpdateKecamatan").val();
			var request = "updateKecamatan";
			var apikey = $("#hiddenApiKey").val();
			$.ajax({
			  type: "POST",
			  url: "curltest.php",
			  data: {request:request,id_kec:select,text:text,apikey:apikey},
			  success: function (response) {
				  console.log(response);
				  //location.reload();
			  },
			  error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				alert(xhr.responseText);
			  }
			});
		}
		function updateKelurahan()
		{
			var select = $("#selectUpdateKelurahan").val();
			var text = $("#txtUpdateKelurahan").val();
			var request = "updateKelurahan";
			var apikey = $("#hiddenApiKey").val();
			$.ajax({
			  type: "POST",
			  url: "curltest.php",
			  data: {request:request,id_kel:select,text:text,apikey:apikey},
			  success: function (response) {
				  console.log(response);
				  location.reload();
			  },
			  error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				alert(xhr.responseText);
			  }
			});
		}
		function deleteProvinsi()
		{
			var select = $("#selectDeleteProvinsi").val();
			var request ="deleteProvinsi";
			var apikey = $("#hiddenApiKey").val();
			$.ajax({
			  type: "POST",
			  url: "curltest.php",
			  data: {request:request,id_prov:select,apikey:apikey},
			  success: function (response) {
				  console.log(response);
				  location.reload();
			  },
			  error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				alert(xhr.responseText);
			  }
			});
		}
		function deleteKabupaten()
		{
			var select = $("#selectDeleteKabupaten").val();
			var request ="deleteKabupaten";
			var apikey = $("#hiddenApiKey").val();
			$.ajax({
			  type: "POST",
			  url: "curltest.php",
			  data: {request:request,id_kab:select,apikey:apikey},
			  success: function (response) {
				  console.log(response);
				  location.reload();
			  },
			  error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				alert(xhr.responseText);
			  }
			});
		}
		function deleteKecamatan()
		{
			var select = $("#selectDeleteKecamatan").val();
			var request ="deleteKecamatan";
			var apikey = $("#hiddenApiKey").val();
			$.ajax({
			  type: "POST",
			  url: "curltest.php",
			  data: {request:request,id_kec:select,apikey:apikey},
			  success: function (response) {
				  console.log(response);
				  location.reload();
			  },
			  error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				alert(xhr.responseText);
			  }
			});
		}
		function deleteKelurahan()
		{
			var select = $("#selectDeleteKelurahan").val();
			var request ="deleteKelurahan";
			var apikey = $("#hiddenApiKey").val();
			$.ajax({
			  type: "POST",
			  url: "curltest.php",
			  data: {request:request,id_kel:select,apikey:apikey},
			  success: function (response) {
				  console.log(response);
				  location.reload();
			  },
			  error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				alert(xhr.responseText);
			  }
			});
		}
		
		function logout()
		{
			var request = "logout";
			$.ajax({
			  type: "POST",
			  url: "curltest.php",
			  data: {request:request},
			  success: function (response) {
				  window.location.href = "index.php";
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