<?php
	$request = $_POST["request"];
	session_start();
	if($request == "search")
	{
		$text = $_POST["text"];
		$apikey = $_POST["apikey"];
		$url = 'localhost/soa_master/api/search/'.$text;
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
		//curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'apikey: '.$apikey
		));
		$output = curl_exec($curl);
		if($output === FALSE)
		{
			echo "Data Gagal";
		}
		else
		{
			echo $output;
		}
		curl_close($curl);
	}
	else if($request == "register")
	{
		$nama = $_POST["nama"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$post_data = array(
			"nama" => $nama,
			"email" => $email,
			"password" => $password
		);
		$url = 'www.geoindosoa.xyz/api/user/register';
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		//curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
		curl_setopt($curl,CURLOPT_POST,TRUE);
		curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		//curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		//	'APIKEY: 18c86fc9a70fd942e862ec17313385a7'
		//));
		$output = curl_exec($curl);
		if($output === FALSE)
		{
			echo "Failed!";
			//echo "cURL Error :".curl_error($curl);
		}
		else
		{
			echo $output;
		}
		curl_close($curl);
	}
	else if($request == "provinsiId")
	{
		$id = $_POST["id"];
		$apikey = $_POST["apikey"];
		$url = 'www.geoindosoa.xyz/api/provinsikuById/'.$id;
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
		//curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'apikey: '.$apikey
		));
		$output = curl_exec($curl);
		if($output === FALSE)
		{
			echo "Data Gagal";
		}
		else
		{
			echo $output;
		}
		curl_close($curl);
	}
	else if($request == "kabupatenId")
	{
		$id = $_POST["id"];
		$apikey = $_POST["apikey"];
		$url = 'localhost/soa_master/api/kabupatenkuById/'.$id;
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
		//curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'apikey: '.$apikey
		));
		$output = curl_exec($curl);
		if($output === FALSE)
		{
			echo "Data Gagal";
		}
		else
		{
			echo $output;
		}
		curl_close($curl);
	}
	else if($request == "kecamatanId")
	{
		$id = $_POST["id"];
		$apikey = $_POST["apikey"];
		$url = 'www.geoindosoa.xyz/api/kecamatankuById/'.$id;
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
		//curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'apikey: '.$apikey
		));
		$output = curl_exec($curl);
		if($output === FALSE)
		{
			echo "Data Gagal";
		}
		else
		{
			echo $output;
		}
		curl_close($curl);
	}
	else if($request == "kelurahanId")
	{
		$id = $_POST["id"];
		$apikey = $_POST["apikey"];
		$url = 'localhost/soa_master/api/kelurahankuById/'.$id;
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
		//curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'apikey: '.$apikey
		));
		$output = curl_exec($curl);
		if($output === FALSE)
		{
			echo "Data Gagal";
		}
		else
		{
			echo $output;
		}
		curl_close($curl);
	}
	else if($request == "login")
	{
		$email = $_POST["email"];
		$password = $_POST["password"];
		$url = 'www.geoindosoa.xyz/api/userkuByEmail/'.$email;
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
		$output = curl_exec($curl);
		if($output === FALSE)
		{
			echo "Data Gagal";
		}
		else
		{
			$obj = json_decode($output,true);
			if($output != null)
			{
				if($obj["message"] == "success")
				{
					if($obj["user"]["password"] == md5($password))
					{
						//berhasil
						$_SESSION["favcolor"] = "green";
						$_SESSION["id"] = $obj["user"]["id"];
						$_SESSION["nama"] = $obj["user"]["nama"];
						$_SESSION["email"] = $obj["user"]["email"];
						$_SESSION["apikey"] = $obj["user"]["apikey"];
						$_SESSION["saldo"] = $obj["user"]["saldo"];
						echo json_encode($obj);	
					}
					else{
						echo json_encode(array("message"=>"Invalid email or password."));
					}
				}
				else{
					$arr = array(
						"message"=>"Invalid email or password."
					);
					echo json_encode($arr);
				}
			}
			else
			{
				$arr = array(
					"message"=>"Invalid email or password."
				);
				echo json_encode($arr);
			}
		}
		curl_close($curl);
	}
	else if($request == "logout")
	{
		session_destroy();
	}
	else if($request == "changePassword")
	{
		$email = $_POST["email"];
		$newPassword = $_POST["newPassword"];
		$apikey = $_POST["apikey"];
		$url = 'www.geoindosoa.xyz/api/user/update';
		$curl = curl_init();
		$post_data = array(
			"newPassword"=> $newPassword,
			"email"=> $email,
			"apikey"=>$apikey
		);
		
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_POST,TRUE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'apikey: '.$apikey
		));
		curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		$output = curl_exec($curl);
		echo $output;
	}
	else if($request == "insertProvinsi")
	{
		$text = $_POST["text"];
		$apikey = $_POST["apikey"];
		$url = 'www.geoindosoa.xyz/api/provinsiku/insert';
		$curl = curl_init();
		$post_data = array(
			"text"=> $text,
			"apikey"=> $apikey
		);
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_POST,TRUE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'apikey: '.$apikey
		));
		curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		$output = curl_exec($curl);
		echo $output;
	}
	else if($request == "updateProvinsi")
	{
		$id_prov = $_POST["id_prov"];
		$text = $_POST["text"];
		$apikey = $_POST["apikey"];
		$url = 'www.geoindosoa.xyz/api/provinsiku/update';
		$curl = curl_init();
		$post_data = array(
			"id_prov"=>$id_prov,
			"text"=> $text,
			"apikey"=> $apikey
		);
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_POST,TRUE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'apikey: '.$apikey
		));
		curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		$output = curl_exec($curl);
		echo $output;
	}
	else if($request == "deleteProvinsi")
	{
		$id_prov = $_POST["id_prov"];
		$apikey = $_POST["apikey"];
		$url = 'www.geoindosoa.xyz/api/provinsiku/delete';
		$curl = curl_init();
		$post_data = array(
			"id_prov"=>$id_prov,
			"apikey"=> $apikey
		);
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_POST,TRUE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'apikey: '.$apikey
		));
		curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		$output = curl_exec($curl);
		echo $output;
	}
	else if($request == "insertKabupaten")
	{
		$id_prov = $_POST["id_prov"];
		$text = $_POST["text"];
		$apikey = $_POST["apikey"];
		$url = 'www.geoindosoa.xyz/api/kabupatenku/insert';
		$curl = curl_init();
		$post_data = array(
			"id_prov"=>$id_prov,
			"text"=>$text,
			"apikey"=> $apikey
		);
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_POST,TRUE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'apikey: '.$apikey
		));
		curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		$output = curl_exec($curl);
		echo $output;
	}
	else if($request == "updateKabupaten")
	{
		$id_kab = $_POST["id_kab"];
		$text = $_POST["text"];
		$apikey = $_POST["apikey"];
		$url = 'www.geoindosoa.xyz/api/kabupatenku/update';
		$curl = curl_init();
		$post_data = array(
			"id_kab"=>$id_kab,
			"text"=> $text,
			"apikey"=> $apikey
		);
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_POST,TRUE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'apikey: '.$apikey
		));
		curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		$output = curl_exec($curl);
		echo $output;
	}
	else if($request == "deleteKabupaten")
	{
		$id_kab = $_POST["id_kab"];
		$apikey = $_POST["apikey"];
		$url = 'www.geoindosoa.xyz/api/kabupatenku/delete';
		$curl = curl_init();
		$post_data = array(
			"id_kab"=>$id_kab,
			"apikey"=> $apikey
		);
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_POST,TRUE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'apikey: '.$apikey
		));
		curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		$output = curl_exec($curl);
		echo $output;	
	}
	else if($request == "insertKecamatan")
	{
		$text = $_POST["text"];
		$id_kab = $_POST["id_kab"];
		$apikey = $_POST["apikey"];
		$url = 'www.geoindosoa.xyz/api/kecamatanku/insert';
		$curl = curl_init();
		$post_data = array(
			"text"=> $text,
			"id_kab"=>$id_kab,
			"apikey"=> $apikey
		);
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_POST,TRUE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'apikey: '.$apikey
		));
		curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		$output = curl_exec($curl);
		echo $output;
	}
	else if($request == "updateKecamatan")
	{
		$id_kec = $_POST["id_kec"];
		$text = $_POST["text"];
		$apikey = $_POST["apikey"];
		$url = 'www.geoindosoa.xyz/api/kecamatanku/update';
		$curl = curl_init();
		$post_data = array(
			"id_kec"=>$id_kec,
			"text"=> $text,
			"apikey"=> $apikey
		);
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_POST,TRUE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'apikey: '.$apikey
		));
		curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		$output = curl_exec($curl);
		echo $output;
	}
	else if($request == "deleteKecamatan")
	{
		$id_kec = $_POST["id_kec"];
		$apikey = $_POST["apikey"];
		$url = 'www.geoindosoa.xyz/api/kecamatanku/delete';
		$curl = curl_init();
		$post_data = array(
			"id_kec"=>$id_kec,
			"apikey"=> $apikey
		);
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_POST,TRUE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'apikey: '.$apikey
		));
		curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		$output = curl_exec($curl);
		echo $output;
	}
	else if($request == "insertKelurahan")
	{
		$text = $_POST["text"];
		$id_kec = $_POST["id_kec"];
		$apikey = $_POST["apikey"];
		$url = 'www.geoindosoa.xyz/api/kelurahanku/insert';
		$curl = curl_init();
		$post_data = array(
			"text"=> $text,
			"id_kec"=>$id_kec,
			"apikey"=> $apikey
		);
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_POST,TRUE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'apikey: '.$apikey
		));
		curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		$output = curl_exec($curl);
		echo $output;
	}
	else if($request == "updateKelurahan")
	{
		$id_kel = $_POST["id_kel"];
		$text = $_POST["text"];
		$apikey = $_POST["apikey"];
		$url = 'www.geoindosoa.xyz/api/kelurahanku/update';
		$curl = curl_init();
		$post_data = array(
			"id_kel"=>$id_kel,
			"text"=> $text,
			"apikey"=> $apikey
		);
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_POST,TRUE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'apikey: '.$apikey
		));
		curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		$output = curl_exec($curl);
		echo $output;
	}
	else if($request == "deleteKelurahan")
	{
		$id_kel = $_POST["id_kel"];
		$apikey = $_POST["apikey"];
		$url = 'www.geoindosoa.xyz/api/kelurahanku/delete';
		$curl = curl_init();
		$post_data = array(
			"id_kel"=>$id_kel,
			"apikey"=> $apikey
		);
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_POST,TRUE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'apikey: '.$apikey
		));
		curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
		$output = curl_exec($curl);
		echo $output;
	}