<html>
<head>
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta name="keywords" content="Flat Search Box Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<style>
      #map-canvas {width:100%;height:400px;border:solid #999 1px;}
      select {width:240px;}
      #kab_box,#kec_box,#kel_box,#lat_box,#lng_box{display:none;}
    </style>
	<script src="jquery-1.11.2.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPc6yxbOd1dd3N7bWNWUzPKQgLNivirvY&v=3.exp"></script>
</head>
<body>
	<div class="header"> <p>User : <a href="login.php">Login, </a> <a href="register.php"> Register</a></p> </div>
	<div class="search">
	<div class="s-bar">
	   <form>
		<input type="hidden" id="hiddenApiKey" value="dfe79f7a4a408c981b07d55a2d498ad7">
		<input type="text" id="txtFind" value="Search here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search Here';}">
		<input type="button" onclick="find()" id="btnFind" value="Find">
		<div class="hasil">
			<div id="ajaxFind"></div>
			<div id="map-canvas" style="display:none;"></div>
		</div>
	  </form>
	</div>
	</div>
	<!--search end here-->	
	<div class="copyright">
		 <p>2018 &copy Project SOA | Design by Kevin, Michael Chandra, Ryan, Surya.<p>
	</div>	
	<script>
		function find()
		{
			var text = $("#txtFind").val();
			text = text.replace(" ","%20");
			var apikey = $("#hiddenApiKey").val();
			var request = "search";
			$.ajax({
			  type: "POST",
			  url: "curltest.php",
			  data: {request:request,apikey:apikey,text:text},
			  success: function (response) {
				  $("#ajaxFind").empty();
				  console.log(response);
				  if(response != false)
				  {
					 var obj = jQuery.parseJSON(response);
					 var provinsi = obj.provinsi;
					  var kabupaten = obj.kabupaten;
					  var kecamatan = obj.kecamatan;
					  var kelurahan = obj.kelurahan;
					  $.each(provinsi, function(idx, resp){
							var gabung = "";
							gabung += "- Provinsi, <a href='javascript:void(0);' onclick=detail('provinsi','"+resp.id_prov+"')>"+resp.nama+"</a><br>";
							$("#ajaxFind").append(gabung);
					  });
					  $.each(kabupaten, function(idx, resp){
							var gabung = "";
							gabung += "- Kabupaten, <a href='javascript:void(0);' onclick=detail('kabupaten','"+resp.id_kab+"')>"+resp.nama+"</a><br>";
							$("#ajaxFind").append(gabung);
					  });
					  $.each(kecamatan, function(idx, resp){
							var gabung = "";
							gabung += "- Kecamatan, <a href='javascript:void(0);' onclick=detail('kecamatan','"+resp.id_kec+"')>"+resp.nama+"</a><br>";
							$("#ajaxFind").append(gabung);
					  });
					  $.each(kelurahan, function(idx, resp){
							var gabung = "";
							gabung += "- Kelurahan, <a href='javascript:void(0);' onclick=detail('kelurahan','"+resp.id_kel+"')>"+resp.nama+"</a><br>";
							$("#ajaxFind").append(gabung);
					  }); 
				  }
				  $("#map-canvas").hide();
				  
			  },
			  error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				alert(xhr.responseText);
			  }
			});
		}
		function detail(kondisi,id)
		{
			var apikey = $("#hiddenApiKey").val();
			if(kondisi == "provinsi")
			{
				var id = id;
				var request = "provinsiId";
			}
			else if(kondisi == "kabupaten")
			{
				var id = id;
				var request = "kabupatenId";
			}
			else if(kondisi == "kecamatan")
			{
				var id = id;
				var request = "kecamatanId";
			}
			else if(kondisi == "kelurahan")
			{
				var id = id;
				var request = "kelurahanId";
			}
			
			$.ajax({
			  type: "POST",
			  url: "curltest.php",
			  data: {request:request,id:id,apikey:apikey},
			  success: function (response) {
				  $("#ajaxFind").empty();
				  if(kondisi == "provinsi")
				  {
					  var obj = jQuery.parseJSON(response);
					  var gabung = "";
					  gabung += "Nama Provinsi : "+ obj.nama + "<br>";
					  $("#ajaxFind").append(gabung);
					  var address = obj.nama;
					  showCoordinate(address);
					  $("#map-canvas").show();
				  }
				  else if(kondisi == "kabupaten")
				  {
					  var obj = jQuery.parseJSON(response);
					  var gabung = "";
					  gabung += "Nama Provinsi : "+ obj.nama_prov + "<br>";
					  gabung += "Nama Kabupaten : "+obj.nama + "<br>";
					  $("#ajaxFind").append(gabung);
					  var address = obj.nama_prov+", "+obj.nama;
					  showCoordinate(address);
					  $("#map-canvas").show();
				  }
				  else if(kondisi == "kecamatan")
				  {
					  var obj = jQuery.parseJSON(response);
					  var gabung = "";
					  gabung += "Nama Provinsi : "+ obj.nama_prov + "<br>";
					  gabung += "Nama Kabupaten : "+obj.nama_kab + "<br>";
					  gabung += "Nama Kecamatan : "+obj.nama + "<br>";
					  $("#ajaxFind").append(gabung);
					  var address = obj.nama_prov+", "+obj.nama_kab+", "+obj.nama;
					  showCoordinate(address);
					  $("#map-canvas").show();
				  }
				  else if(kondisi == "kelurahan")
				  {
					  var obj = jQuery.parseJSON(response);
					  var gabung = "";
					  gabung += "Nama Provinsi : "+ obj.nama_prov + "<br>";
					  gabung += "Nama Kabupaten : "+obj.nama_kab + "<br>";
					  gabung += "Nama Kecamatan : "+obj.nama_kec + "<br>";
					  gabung += "Nama Kelurahan : "+obj.nama + "<br>";
					  $("#ajaxFind").append(gabung);
					  var address = obj.nama_prov+", "+obj.nama_kab+", "+obj.nama_kec+", "+obj.nama;
					  showCoordinate(address);
					  $("#map-canvas").show();
				  }
			  },
			  error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				alert(xhr.responseText);
			  }
			});
		}
		var map;
		var geocoder;
		var marker;
		var markersArray = [];
		function initialize() {
		  geocoder = new google.maps.Geocoder();
		  var myLatlng =new google.maps.LatLng(-6.176655999999999, 106.83058389999997);
		  var mapOptions = {
			center: myLatlng,
			zoom: 14
		  };
		  map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
		  marker = new google.maps.Marker({
			  position: myLatlng,
			  map: map,
			  title: 'Jakarta'
		  });  
		  markersArray.push(marker);
		  google.maps.event.addListener(marker,"click",function(){});  
		}

		function clearOverlays() {
		  for (var i = 0; i < markersArray.length; i++ ) {
			markersArray[i].setMap(null);
		  }
		  markersArray.length = 0;
		}

		function showCoordinate(address){  
		  geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
			  clearOverlays();
			  var position=results[0].geometry.location;
			  $("#ajaxFind").append("Lattitude : "+position.lat()+"<br>");
			  $("#ajaxFind").append("Longtitude : "+position.lng()+"<br>");
			  map.setCenter(results[0].geometry.location);
			  marker = new google.maps.Marker({
				  map: map,
				  position: results[0].geometry.location,
				  title:address
			  });
			  markersArray.push(marker);
			  google.maps.event.addListener(marker,"click",function(){});
			} else {
			  alert('Geocode was not successful for the following reason: ' + status);
			}
		  });
		}
		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
</body>
</html>