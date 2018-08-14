<?php

require 'vendor/autoload.php';
require 'src/models/Kabupatenku.php';
require 'src/models/Provinsiku.php';
require 'src/models/Kecamatanku.php';
require 'src/models/Kelurahanku.php';
require 'src/models/Userku.php';
require 'src/models/Voucher.php';

$config = include('src/config.php');
$app = new \Slim\App(['settings' => $config]);
$container=$app->getContainer();
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
$capsule->getContainer()->singleton(
	IlluminateContractsDebugExceptionHandler::class,
	AppExceptionHandler::class
);

$app->put('/coba/{id}',function($request,$response,$args)
{
	$apikey = $request->getHeader('apikey');
	$id = $args["id"];
	$param = $request->getParsedBody();
	$nama = $param["nama"];
	$user = Userku::where("id",$id)->first();
	$user->nama = $nama;
	$user->save();
	$arr = array(
		"nama"=>$nama,
		"id"=>$id,
		"apikey"=>$apikey
	);
	return $response->withStatus(200)->withJson($arr);
	
});
$app->delete('/del/{id}',function($request,$response,$args)
{
	$apikey = $request->getHeader('apikey');
	$id = $args["id"];
	$provinsiku = Provinsiku::where("id_prov",$id)->first();
	$provinsiku->status = "0";
	$provinsiku->save();
	$arr = array(
		"id"=>$id,
		"apikey"=>$apikey
	);
	return $response->withStatus(200)->withJson($arr);
	
});

$app->post('/user/top_up', function($request,$response){
	$param = $request->getParsedBody();
	$apikey = $param["apikey"];
	$checkUser = Userku::where('apikey',$apikey)->first();
	$message = "";
	if($checkUser == null)
	{
		$checkUser->saldo+=10000;
		$checkUser->save();
		$message = array(
			"message" => "Your credit has been increased by Rp 10.000."
		);
		return $response->withStatus(200)->withJSON($message);
	}
	else
	{
		$message = array(
			"error" => "User not found!"
		);
		return $response->withStatus(404)->withJSON($message);
	}
});

$app->post('/user/register', function($request,$response){
	$param = $request->getParsedBody();
	$email = $param["email"];
	$checkUser = Userku::where('email',$email)->first();
	$message = "";
	if($checkUser == null)
	{
		$index = Userku::count();
		$id = "U".str_pad($index,4,'0',STR_PAD_LEFT);
		$userku = new Userku();
		$userku->id = $id;
		$userku->email = $param['email'];
		$userku->password = md5($param["password"]);
		$userku->nama = $param["nama"];
		$apikey = md5($param["email"]);
		$userku->apikey = $apikey;
		$userku->saldo = 0;
		$userku->save();
		$message = array(
			"apikey" => $apikey
		);
	}
	else
	{
		$message = array(
			"error" => "Error"
		);
	}
    return $response->withStatus(200)->withJSON($message);
});

$app->post('/provinsiku/insert', function($request,$response){
	$param = $request->getParsedBody();
	$apikey = $param["apikey"];
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$provinsiku = new Provinsiku();
		$text = $param["text"];
		$index = Provinsiku::count();
		$id = str_pad($index,3,'0',STR_PAD_LEFT);
		$provinsiku->id_prov = $id;
		$provinsiku->nama = $text;
		$provinsiku->status = "1";
		$provinsiku->save();
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($provinsiku);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
});
$app->post('/kabupatenku/insert', function($request,$response){
	$param = $request->getParsedBody();
	$apikey = $param["apikey"];
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$kabupatenku = new Kabupatenku();
		$index = Kabupatenku::count();
		$text = $param["text"];
		$id_prov = $param["id_prov"];
		$id = str_pad($index,3,'0',STR_PAD_LEFT);
		$kabupatenku->id_kab = $id;
		$kabupatenku->nama = $text;
		$kabupatenku->id_prov = $id_prov;
		$kabupatenku->status = "1";
		$kabupatenku->save();
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($kabupatenku);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
});
$app->post('/kecamatanku/insert', function($request,$response){
	$param = $request->getParsedBody();
	$apikey = $param["apikey"];
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$kecamatanku = new Kecamatanku();
		$index = Kecamatanku::count();
		$text = $param["text"];
		$id_kab = $param["id_kab"];
		$id = str_pad($index,5,'0',STR_PAD_LEFT);
		$kecamatanku->id_kec = $id;
		$kecamatanku->nama = $text;
		$kecamatanku->id_kab = $id_kab;
		$kecamatanku->status = "1";
		$kecamatanku->save();
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($kecamatanku);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
});
$app->post('/kelurahanku/insert', function($request,$response){
	$param = $request->getParsedBody();
	$apikey = $param["apikey"];
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$kelurahanku = new Kelurahanku();
		$index = Kelurahanku::count();
		$text = $param["text"];
		$id_kec = $param["id_kec"];
		$id = str_pad($index,8,'0',STR_PAD_LEFT);
		$kelurahanku->id_kel = $id;
		$kelurahanku->nama = $text;
		$kelurahanku->id_kec = $id_kec;
		$kelurahanku->status = "1";
		$kelurahanku->save();
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($kelurahanku);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
});
$app->put('/provinsiku/update/{id}', function($request,$response,$args){
	$param = $request->getParsedBody();
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$id_prov = $args["id"];
		$text = $param["text"];
		$provinsiku = Provinsiku::where("id_prov",$id_prov)->first();
		$provinsiku->nama = $text;
		$provinsiku->save();
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($provinsiku);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
});
$app->put('/kabupatenku/update/{id}', function($request,$response,$args){
	$param = $request->getParsedBody();
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$id_kab = $args["id"];
		$text = $param["text"];
		$kabupatenku = Kabupatenku::where("id_kab",$id_kab)->first();
		$kabupatenku->nama = $text;
		$kabupatenku->save();
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($kabupatenku);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
});
$app->put('/kecamatanku/update/{id}', function($request,$response,$args){
	$param = $request->getParsedBody();
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$id_kec = $args["id"];
		$text = $param["text"];
		$kecamatanku = Kecamatanku::where("id_kec",$id_kec)->first();
		$kecamatanku->nama = $text;
		$kecamatanku->save();
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($kecamatanku);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
});
$app->put('/kelurahanku/update/{id}', function($request,$response,$args){
	$param = $request->getParsedBody();
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$id_kel = $args["id"];
		$text = $param["text"];
		$kelurahanku = Kelurahanku::where("id_kel",$id_kel)->first();
		$kelurahanku->nama = $text;
		$kelurahanku->save();
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($kelurahanku);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
});

$app->delete('/provinsiku/delete/{id}', function($request,$response,$args){
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$id_prov = $args["id"];
		$provinsiku = Provinsiku::where("id_prov",$id_prov)->first();
		$provinsiku->status = "0";
		$provinsiku->save();
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($provinsiku);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
});
$app->delete('/kabupatenku/delete/{id}', function($request,$response,$args){
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$id_kab = $args["id"];
		$kabupatenku = Kabupatenku::where("id_kab",$id_kab)->first();
		$kabupatenku->status = "0";
		$kabupatenku->save();
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($kabupatenku);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
});
$app->delete('/kecamatanku/delete/{id}', function($request,$response,$args){
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$id_kec = $args["id"];
		$kecamatanku = Kecamatanku::where("id_kec",$id_kec)->first();
		$kecamatanku->status = "0";
		$kecamatanku->save();
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($kecamatanku);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
});
$app->delete('/kelurahanku/delete/{id}', function($request,$response,$args){
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$id_kel = $args["id"];
		$kelurahanku = Kelurahanku::where("id_kel",$id_kel)->first();
		$kelurahanku->status = "0";
		$kelurahanku->save();
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($kelurahanku);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
});
$app->get('/search/{nama}',function($request,$response,$args)
{
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$accessCount = $authentication->accessCount;
		$saldo = $authentication->saldo;
		$rules = true;
		if($accessCount <= 50)
		{
			$rules = true;
		}
		else
		{
			$saldo = $saldo-1000;
			if($saldo < 0)
			{
				$rules = false;
			}
			else
			{
				$rules = true;
				$authentication->saldo = $saldo;
			}
		}
		if($rules == true)
		{
			$nama = $args['nama'];
			if (strpos($nama, '%20') !== true) 
			{
				str_replace('%20',' ',$nama);
			}
			$provinsiku = Provinsiku::where("nama","like","%".$nama."%")->where('status','1')->get();
			$kabupatenku = Kabupatenku::where("nama","like","%".$nama."%")->where('status','1')->get();
			$kecamatanku = Kecamatanku::where("nama","like","%".$nama."%")->where('status','1')->get();
			$kelurahanku = Kelurahanku::where("nama","like","%".$nama."%")->where('status','1')->get();
			$datas = array(
				"provinsi" => $provinsiku,
				"kabupaten" => $kabupatenku,
				"kecamatan" => $kecamatanku,
				"kelurahan" => $kelurahanku
			);
			$authentication->accessCount++;
			$authentication->save();
			return $response->withStatus(200)->withJSON($datas);
		}
		else
		{
			$message= array(
				"error"=>"Your credit is not enough."
			);
			return $response->withStatus(401)->withJSON($message);
		}
		
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
	
});
$app->get('/provinsikuById/{id}',function($request,$response,$args)
{
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$id = $args['id'];
		$provinsiku = Provinsiku::where("id_prov","=",$id)->first();
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($provinsiku);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
	
});
$app->get('/provinsiku',function($request,$response,$args)
{
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$provinsiku = Provinsiku::where("status","1")->get();
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($provinsiku);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
	
});
$app->get('/kabupatenku',function($request,$response,$args)
{
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$kabupatenku = Kabupatenku::where("status","1")->limit(50)->get();
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($kabupatenku);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
	
});
$app->get('/kecamatanku',function($request,$response,$args)
{
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$kecamatanku = Kecamatanku::where("status","1")->limit(50)->get();
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($kecamatanku);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
	
});
$app->get('/kelurahanku',function($request,$response,$args)
{
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$kelurahanku = Kelurahanku::where("status","1")->limit(50)->get();
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($kelurahanku);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
	
});
$app->get('/userkuByEmail/{email}',function($request,$response,$args)
{
	$email = $args["email"];
	$userku = Userku::where("email",$email)->first();
	if($userku)
	{
		$datas = array(
			"message"=>"success",
			"user"=>$userku
		);
		return $response->withStatus(200)->withJSON($datas);
	}
	else
	{
		$message= array(
			"message"=>"Not Found"
		);
		return $response->withStatus(404)->withJSON($message);
	}
	
});

$app->get('/kabupatenkuById/{id}',function($request,$response,$args)
{
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$id = $args['id'];
		$kabupatenku = Kabupatenku::where("id_kab","=",$id)->first();
		$id_prov = $kabupatenku->id_prov;
		$provinsi = Provinsiku::where("id_prov",$id_prov)->first();
		$nama_provinsi = $provinsi->nama;
		$datas = array(
			"id_kab"=>$kabupatenku->id_kab,
			"nama_prov"=> $nama_provinsi,
			"nama"=>$kabupatenku->nama
		);
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($datas);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
	
});
$app->get('/kecamatankuById/{id}',function($request,$response,$args)
{
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$id = $args['id'];
		$kecamatanku = Kecamatanku::where("id_kec","=",$id)->first();
		$kabupatenku = Kabupatenku::where("id_kab",$kecamatanku->id_kab)->first();
		$nama_kabupaten = $kabupatenku->nama;
		$id_prov = $kabupatenku->id_prov;
		$provinsiku = Provinsiku::where("id_prov",$id_prov)->first();
		$nama_provinsi = $provinsiku->nama;
		$datas = array(
			"id_kec"=>$kecamatanku->id_kec,
			"nama"=> $kecamatanku->nama,
			"id_kab"=>$kabupatenku->id_kab,
			"nama_kab"=>$nama_kabupaten,
			"nama_prov"=>$nama_provinsi
		);
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($datas);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
});
$app->get('/kelurahankuById/{id}',function($request,$response,$args)
{
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$id = $args['id'];
		$kelurahanku = Kelurahanku::where("id_kel",$id)->first();
		$kecamatanku = Kecamatanku::where("id_kec","=",$kelurahanku->id_kec)->first();
		$kabupatenku = Kabupatenku::where("id_kab",$kecamatanku->id_kab)->first();
		$nama_kecamatan = $kecamatanku->nama;
		$nama_kabupaten = $kabupatenku->nama;
		$id_prov = $kabupatenku->id_prov;
		$provinsiku = Provinsiku::where("id_prov",$id_prov)->first();
		$nama_provinsi = $provinsiku->nama;
		$datas = array(
			"id_kel"=>$kelurahanku->id_kel,
			"nama"=> $kelurahanku->nama,
			"id_kec"=>$kelurahanku->id_kec,
			"nama_kec"=>$nama_kecamatan,
			"nama_kab"=>$nama_kabupaten,
			"nama_prov"=>$nama_provinsi
		);
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($datas);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
});

$app->put('/redeem_voucher/{voucher_key}', function($request,$response,$args){
	
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		
		$voucher_key = $args["voucher_key"];
		$voucher = Voucher::where("voucher_key",$voucher_key)->first();
		if($voucher != null)
		{
			//voucher ditemukan
			if($voucher->voucher_status == "1")
			{
				//voucher bisa digunakan
				$voucher->voucher_status = "0";
				$authentication->saldo+=10000;
				$authentication->save();
				$datas = array(
					"message"=>"Saldo anda bertambah sebanyak Rp 10.000."
				);
				return $response->withStatus(200)->withJSON($datas);
			}
			else
			{
				//voucher tidak bisa digunakan
				$datas = array(
					"message"=>"Voucher tidak bisa digunakan."
				);
				return $response->withStatus(401)->withJSON($datas);
			}
		}
		else
		{
			//voucher tidak ditemukan
			$datas = array(
					"message"=>"Voucher tidak ditemukan."
				);
				return $response->withStatus(401)->withJSON($datas);
		}
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
	return $email;
});

$app->put('/user/updateput/{email}', function($request,$response,$args){
	
	$apikey = $request->getHeader();
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$email = $args["email"];
		$param = $request->getParsedBody();
		$authentication->password = md5($param["password"]);
		$datas = array(
			"message"=>"Berhasil"
		);
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($datas);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
	return $email;
});

$app->put('/user/update/{email}', function($request,$response,$args){
	$param = $request->getParsedBody();
	$apikey = $request->getHeader('apikey');
	$authentication = Userku::where("apikey",$apikey)->first();
	if($authentication)
	{
		$email = $args["email"];
		$authentication->password = md5($param["newPassword"]);
		$authentication->save();
		$datas = array(
			"message"=>"Berhasil"
		);
		$authentication->accessCount++;
		$authentication->save();
		return $response->withStatus(200)->withJSON($datas);
	}
	else
	{
		$message= array(
			"error"=>"Unauthorized access"
		);
		return $response->withStatus(401)->withJSON($message);
	}
	return $email;
});

$app->run();
