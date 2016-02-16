<?php

require 'vendor/autoload.php';
require 'libs/NotORM/NotORM.php';

/* db item */
$server = 'localhost';
$db_name = 'paypal';
$db_user = 'root';
$db_pass = '292409';

use PayPal\Api\Payment;

/* paypal config*/
$currency = 'USD';
$PayPal_Client_Id = 'ATPZm7k-jA0PuYvl8h_i7OwIU6ZvowFVbMDnyMf2u8xKF6Rf-W7GH-U4nf7FxWR_ys8yucvrK1_vAW6L';
$PayPal_Secret = 'EGcHZFi2ChI-dz__yowD2NneU68RQOld9ukzSp3VtCrHAXe9inBO2Ea2pGGW9eaAaTuzmweDosvz1bBp';


/* db config */
$pdo = new PDO("mysql:host=$server;dbname=$db_name", $db_user, $db_pass);
$db = new NotORM($pdo);


$app = new \Slim\Slim();

$app->get('/hai/:name', function($name){
	echo "hello ". $name;
});

$app->get('/tes', function() use($app, $db){
	$query = $db->tes;
	foreach ($query as $value) {
		$result[] = array(
			"nama" => $value["nama"],
			"kota" => $value["kota"]
			);
	}
	echo json_encode($result);
});

$app->post('/tes', function() use($app, $db){
	$nama = $app->request->post('nama');
	$kota = $app->request->post('kota');

	$add = $db->tes->insert(array(
		"nama" => $nama,
		"kota" => $kota,
		));
	if ($add != null) {
		$pesan = "input berhasil";
	} else {
		$pesan = 'input gagal';
	}

	echo $pesan;
});


$app->get('/pdo1', function() use($app, $pdo){
	$query = "select * from author";
	$hasil = $pdo->query($query);
	foreach ($hasil as $value) {
		$tampil["hasil"] = array(
			"nama" => $value["author_name"],
			"email" => $value["author_email"]
			);
	}
	echo json_encode($tampil);
});


/*----------------------------------------- table products -----------------------------------------------------------------*/
$app->get('/products', function() use($app, $db){
	$query = $db->products()->order("id desc");
	foreach ($query as $value) {
		$result["status"] = true;
		$result["result"][] = array(
			"id" => $value["id"],
			"name" => $value["name"],
			"price" => $value["price"],
			"description" => $value["description"],
			"image" => $value["image"],
			"sku" => $value["sku"],
			"created_at" => $value["created_at"]
			);
	}
	if ($query->count("*") > 0) {
		echo json_encode($result);
	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "nothing data yet"
			));
	}
	
});


/* Search record on table products */
$app->get('/products/:key', function($key) use($app, $db){
	$query = $db->products()->where("name LIKE ?", "%$key%")->order("created_at desc") ;
	foreach ($query as $value) {
		$result["status"] = true;
		$result["result"][] = array(
			"id" => $value["id"],
			"name" => $value["name"],
			"price" => $value["price"],
			"description" => $value["description"],
			"image" => $value["image"],
			"sku" => $value["sku"],
			"created_at" => $value["created_at"]
			);
	}
	if ($query->count("*") > 0) {
		echo json_encode($result);
	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "cannot show data with key $key"
			));
	}
	
});

/* search with post method */
$app->post('/products1', function() use($app, $db){
	$name = $app->request->post('name');

	$query = $db->products()->where("name LIKE ?", "%$name%");

	if ($query->count("*") > 0) {
		foreach ($query as $value) {
		$result["status"] = true;
		$result["result"][] = array(
			"id" => $value["id"],
			"name" => $value["name"],
			"price" => $value["price"],
			"description" => $value["description"],
			"image" => $value["image"],
			"sku" => $value["sku"],
			"created_at" => $value["created_at"]
			);
	}
	echo json_encode($result);

	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "cannot find $name"
			));
	}
});

/* add data */
$app->post('/products', function() use($app, $db){
	verifyRequiredParams(array('name', 'price', 'description', 'image', 'sku'));
	// $response = array();

	$name = $app->request->post('name');
	$price = $app->request->post('price');
	$description = $app->request->post('description');
	$image = $app->request->post('image');
	$sku = $app->request->post('sku');

	$query = $db->products()->where("name LIKE ?", $name);

	if ($query->count("*") < 1) {
		$add = $db->products->insert(array(
			"name" => $name,
			"price" => $price,
			"description" => $description,
			"image" => $image,
			"sku" => $sku,
			));

		if ($add != null) {
			foreach ($query as $value) {
				$result["status"] = true;	
				$result["result"][] = array(
					"id" => $value["id"],
					"name" => $value["name"],
					"price" => $value["price"],
					"description" => $value["description"],
					"image" => $value["image"],
					"sku" => $value["sku"],
					"created_at" => $value["created_at"]
					);
			}
			echo json_encode($result);
		} else {
			echo json_encode(array(
			"status" => false,
			"message" => "failed to added data"
			));
		}
	} else {
		echo json_encode(array(
				"status" => false,
				"message" => "data was existed"
				));
	}

});

/* update */
$app->put('/products/:key', function($key) use($app, $db){
	$query = $db->products()->where("id", $key);

	if ($query->fetch()) {
		$post = $app->request->put();
		$result = $query->update($post);
		echo json_encode(array(
			"status" => (bool)$result,
			"message" => "product with id $key was updated"
			));
	}

});

/* delete */
$app->delete('/products/:key', function($key) use($app, $db){
	$query = $db->products()->where("id", $key);

	if ($query->fetch()) {
		$result = $query->delete();
		echo json_encode(array(
			"status" => true, 
			"message" => "products with id $key was deleted"
			));
	} else {
		echo json_encode(array(
			"status" => true, 
			"message" => "products with id $key does not exist"
			));
	}
});

/*------------------------------------------ table anggota ---------------------------------------------------------------------------------------------*/

/* get anggota */
$app->get('/anggota', function() use($app, $db){
	$query = $db->anggota->order("id desc");
	foreach ($query as $value) {
		$result["status"] = true;
		$result["result"][] = array(
			"id" => $value["id"],
			"name" => $value["name"],
			"email" => $value["email"],
			"image" => $value["image"],
			"updated_at" => $value["updated_at"]
			);
	}

	if ($query->count("*") > 0) {
		echo json_encode($result);
	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "nothing data yet"
			));
	}
	
});

/* search anggota */
$app->get('/anggota/:key', function($key) use($app, $db){
		$query = $db->anggota->where("name LIKE ?", "%$key%");
		foreach ($query as $value) {
			$result["status"] = true;
			$result["result"][] = array(
				"id" => $value["id"],
				"name" => $value["name"],
				"email" => $value["email"],
				"image" => $value["image"],
				"updated_at" => $value["updated_at"]
				);
		}

		if ($query->count("*") > 0) {
			echo json_encode($result);
		} else {
		echo json_encode(array(
			"status" => false,
			"message" => "cannot find $key"
			));
	}
});

/* registarasi (post anggota) */
$app->post('/anggota', function() use($app, $db, $pdo){
	require_once 'libs/PassHash.php';

	verifyRequiredParams(array('name', 'email', 'password', 'image'));
	// $response = array();

	$name = $app->request->post("name");
	$email = $app->request->post("email");
	$password = $app->request->post("password");
	$password_hash = PassHash::hash($password);
	validateEmail($email);

	$uploadDir = 'E:/Project/www/slimframe/image/';
	$fileName = $_FILES['userfile']['name'];
	$tmpName = $_FILES['userfile']['tmp_name'];
	$fileSize = $_FILES['userfile']['size'];
	$fileType = $_FILES['userfile']['type'];

	$filePath = $uploadDir.$fileName;
	$result = move_uploaded_file($tmpName, $filePath);

	$query = $db->anggota->where("email LIKE ?", $email);

	if ($query->count("*") < 1) {
		$add = $db->anggota->insert(array(
			"name" => $name,
			"email" => $email,
			"password" => $password_hash,
			"image" => $filePath,
			));

		// http://camranger.com/wp-content/uploads/2014/10/Android-Icon.png
		// $query = $db->admin_restoran->select('admin_username')->where("admin_id", $id);
		// $getId = $db->anggota->select('id')->where("email", $email); 
		// $getId = $pdo->query("select * from anggota where email = $email");

		// $product = $getId->fetch_assoc();
		// $tes = $db->tes->insert(array(
		// 	"name" => $name,
		// 	"kota" => "lamongan",
		// 	"anggota_id" => $product["id"],
		// 	));

		if ($tes != null) {
			foreach ($query as $value) {
				$result["status"] = true;
				$result["result"] = array(
					"name" => $value["name"],
					"email" => $value["email"],
					"image" => $value["image"],
					"created_at" => $value["created_at"],
					"updated_at" => $value["updated_at"]
					);
			}
			echo json_encode($result);

		} else {
			echo json_encode(array(
			"status" => false,
			"message" => "failed to added data"
			));
		}

	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "data was exists"
			));
	}

});

/* login */
$app->post('/anggota1', function() use($app, $db){
	verifyRequiredParams(array('email', 'password'));

	$email = $app->request->post('email');
	$password = $app->request->post('password');

	$query = $db->anggota->where("email", $email);

	if ($query->count("*") > 0 ) {
		foreach ($query as $value) {
			$result["status"] = true;
			$result["result"] = array(
				"name" => $value["name"],
				"email" => $value["email"],
				"image" => $value["image"],
				"created_at" => $value["created_at"],
				"updated_at" => $value["updated_at"]
				);
		}
		echo json_encode($result);
	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "cannot find your email"
			));
	}

});

/* update anggota */
$app->put('/anggota/:key', function($key) use($app, $db){
	
	$query = $db->anggota->where("id", $key);

	if ($query->fetch()) {
		$post = $app->request->put();
		$result = $query->update($post);
		echo json_encode(array(
			"status" => (bool)$result,
			"message" => "data with id $key was updated"
			));
	}
});

/* delete anggota */
$app->delete('/anggota/:key', function($key) use($app, $db){
	$query = $db->anggota->where("id", $key);

	if ($query->fetch()) {
		$result = $query->delete();
		echo json_encode(array(
			"status" => true, 
			"message" => "cek with id $key was deleted"
			));

	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "tes id $key does not exist"
			));
	}
});

/*--------------------------------------------------- table restoran ----------------------------------------------------------------*/

/* get restoran */
$app->get('/restoran', function() use($app, $db){
	$query = $db->restoran()->order("created_at desc");
	foreach ($query as $value) {
		$result["status"] = true;
		$result["result"][] = array(
			"restoran_id" => $value["restoran_id"],
			"restoran_name" => $value["restoran_name"],
			"restoran_logo" => $value["restoran_logo"],
			"restoran_address" => $value["restoran_address"],
			"created_at" => $value["created_at"],
			"updated_at" => $value["updated_at"]
			);
	}
	if ($query->count("*") > 0) {
		echo json_encode($result);
	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "nothing data yet"
			));
	}
});

/* seacrh restoran */
$app->get('/restoran/:key', function($key) use($app, $db){
	$query = $db->restoran()->where("restoran_name LIKE ?", "%$key%")->order("created_at desc");
	foreach ($query as $value) {
		$result["status"] = true;
		$result["result"][] = array(
			"restoran_id" => $value["restoran_id"],
			"restoran_name" => $value["restoran_name"],
			"restoran_logo" => $value["restoran_logo"],
			"restoran_address" => $value["restoran_address"],
			"created_at" => $value["created_at"],
			"updated_at" => $value["updated_at"]
			);
	}
	if ($query->count("*") > 0) {
		echo json_encode($result);
	} else{
		echo json_encode(array(
			"status" => false,
			"message" => "cannot find keyword $key"
			));
	}
	
});

/* post restoran (add restoran )*/
$app->post('/restoran', function() use($app, $db){
	verifyRequiredParams(array('restoran_name', 'restoran_logo', 'restoran_address'));

	$restoran_name = $app->request->post('restoran_name');
	$restoran_logo = $app->request->post('restoran_logo');
	$restoran_address = $app->request->post('restoran_address');

	$query = $db->restoran()->where("restoran_name", $restoran_name);

	if ($query->count("*") < 1) {
		$add = $db->restoran->insert(array(
			"restoran_name" => $restoran_name,
			"restoran_logo" => $restoran_logo,
			"restoran_address" => $restoran_address,
			));

		if ($add != null) {
			foreach ($query as $value) {
				$result["status"] = true;
				$result["result"][] = array(
					"restoran_id" => $value["restoran_id"],
					"restoran_name" => $value["restoran_name"],
					"restoran_logo" => $value["restoran_logo"],
					"restoran_address" => $value["restoran_address"]
					);
			}
			echo json_encode($result);
		} else {
			echo json_encode(array(
				"status" => false,
				"message" => "failed to add new data"
				));
		}

	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "menu was existed"
			));
	}
});

/* edit anggota (put)*/
$app->put('/restoran/:key', function($key) use($app, $db){

	$query = $db->restoran()->where("restoran_id", $key);
	if ($query->fetch()) {
		$post = $app->request->put();
		$result = $query->update($post);
		echo json_encode(array(
			"status" => (bool)$result,
			"message" => "restoran with id $key was updated"
			));
	} 
});

/* delete anggota */
$app->delete('/restoran/:key', function($key) use($app, $db){
	$query = $db->restoran()->where("restoran_id", $key);

	if ($query->fetch()) {
		$result = $query->delete();
		echo json_encode(array(
			"status" => true,
			"message" => " restoran with id $key was deleted" 
			));

	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "restoran with id $key does not exist"
			));
	}
});

/*----------------------------------------------- table menu ------------------------------------------------------------------------*/

/* get menu */
$app->get('/menu', function() use($app, $db){
	$query = $db->menu()->order("created_at desc");
	foreach ($query as $value) {
		$result["status"] = true;
		$result["result"][] = array(
			"menu_id" => $value["menu_id"],
			"restoran_id" => $value["restoran_id"],
			"menu_name" => $value["menu_name"],
			"menu_price" => $value["menu_price"],
			"menu_kode" => $value["menu_kode"],
			"menu_description" => $value["menu_description"],
			"menu_image" => $value["menu_image"],
			"menu_sku" => $value["menu_sku"],
			"created_at" => $value["created_at"]
			);
	}
	if ($query->count("*") > 0) {
		echo json_encode($result);
	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "nothing data yet"
			));
	}
});

/* search menu */
$app->get('/menu/:key', function($key) use($app, $db){
	$query = $db->menu()->where("menu_name LIKE ?", "%$key%")->order("created_at desc");
	foreach ($query as $value) {
		$result["status"] = true;
		$result["result"][] = array(
			"menu_id" => $value["menu_id"],
			"restoran_id" => $value["restoran_id"],
			"menu_name" => $value["menu_name"],
			"menu_price" => $value["menu_price"],
			"menu_kode" => $value["menu_kode"],
			"menu_description" => $value["menu_description"],
			"menu_image" => $value["menu_image"],
			"menu_sku" => $value["menu_sku"],
			"created_at" => $value["created_at"]
			);
	}

	if ($query->count("*") > 0) {
		echo json_encode($result);
	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "cannot find your keyword $key"
			));
	}
	
});

/* post menu (add menu )*/
$app->post('/menu', function() use($app, $db){
	verifyRequiredParams(array('restoran_id', 'menu_name', 'menu_price', 
		'menu_kode', 'menu_description', 'menu_image', 'menu_sku'));

	$restoran_id = $app->request->post('restoran_id');
	$menu_name = $app->request->post('menu_name');
	$menu_price = $app->request->post('menu_price');
	$menu_kode = $app->request->post('menu_kode');
	$menu_description = $app->request->post('menu_description');
	$menu_image = $app->request->post('menu_image');
	$menu_sku = $app->request->post('menu_sku');

	$query = $db->menu->where("menu_name", $menu_name);

	if ($query->count("*") < 1) {
		$add = $db->menu->insert(array(
			"restoran_id" => $restoran_id,
			"menu_name" => $menu_name,
			"menu_price" => $menu_price,
			"menu_kode" => $menu_kode,
			"menu_description" => $menu_description,
			"menu_image" => $menu_image,
			"menu_sku" => $menu_sku,
			));

		if ($add != null) {
			foreach ($query as $value) {
			$result["status"] = true;
			$result["result"][] = array(
			"menu_id" => $value["menu_id"],
			"restoran_id" => $value["restoran_id"],
			"menu_name" => $value["menu_name"],
			"menu_price" => $value["menu_price"],
			"menu_kode" => $value["menu_kode"],
			"menu_description" => $value["menu_description"],
			"menu_image" => $value["menu_image"],
			"menu_sku" => $value["menu_sku"],
			"created_at" => $value["created_at"]
			);
		}
		echo json_encode($result);
		
		} else {
			echo json_encode(array(
			"status" => false,
			"message" => "failed to added data"
			));

		} 

	} else {
		echo json_encode(array(
				"status" => false,
				"message" => "data was existed"
				));
	}
});

/* edit menu (put)*/
$app->put('/menu/:key', function($key) use($app, $db){

	$query = $db->menu()->where("menu_id", $key);

	if ($query->fetch()) {
		$post = $app->request->put();
		$result = $query->update($post);
		echo json_encode(array(
			"status" => (bool)$result,
			"message" => "menu with id $key was updated"
			));
	}
});

/* delete menu */
$app->delete('menu/:key', function($key) use($app, $db){
	$query = $db->menu()->where("id", $key);

	if ($query->fetch()) {
		$result = $query->delete();
		echo json_encode(array(
			"status" => true, 
			"message" => "menu with id $key was deleted"
			));

	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "menu with id $key does not exist"
			));
	}
});

/*------------------------------------------------- admin_restoran ------------------------------------------------------------------*/
/* get data */
$app->get('/admin_restoran', function() use($app, $db){
	$query = $db->admin_restoran->order("admin_id desc");
	foreach ($query as $value) {
		$result["status"] = true;
		$result["result"][] = array(
			"admin_id" => $value["admin_id"],
			"restoran_id" => $value["restoran_id"],
			"admin_username" => $value["admin_username"],
			"admin_email" => $value["admin_email"],
			"admin_api" => $value["admin_api"],
			"created_at" => $value["created_at"],
			"updated_at" => $value["updated_at"]
			);
	}
	if ($query->count("*") > 0) {
		echo json_encode($result);
	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "nothing data yet"
			));
	}	

});

$app->get('/getid/:id', function($id) use($app, $db){
	$query = $db->admin_restoran->select('admin_username')->where("admin_id", $id);
	foreach ($query as $value) {
		$result["status"] = true;
		$result["result"][] = array("admin_username" => $value["admin_username"]);
	}
	echo json_encode($result);
});

$app->get('/admin_restoran/:key', function($key) use($app, $db){
	$query = $db->admin_restoran->where("admin_username LIKE ?", "%$key%")->order("admin_id desc");
	foreach ($query as $value) {
		$result["status"] = true;
		$result["result"][] = array(
			"admin_id" => $value["admin_id"],
			"restoran_id" => $value["restoran_id"],
			"admin_username" => $value["admin_username"],
			"admin_email" => $value["admin_email"],
			"admin_api" => $value["admin_username"],
			"created_at" => $value["created_at"],
			"updated_at" => $value["updated_at"]
			);
	}
	if ($query->count("*") > 0) {
		echo json_encode($result);
	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "cannot find your keyword $key"
			));
	}	

});

/* registation (admin restoran)*/
$app->post('/admin_restoran', function() use($app, $db){
	require_once 'libs/PassHash.php';
	verifyRequiredParams(array('restoran_id', 'admin_username', 'admin_email', 'admin_password'));

	$restoran_id = $app->request->post('restoran_id');
	$admin_username = $app->request->post('admin_username');
	$admin_email = $app->request->post('admin_email');
	$admin_password = $app->request->post('admin_password');
	$password_hash = PassHash::hash($admin_password);
	$admin_api = generateApiKey();
	validateEmail($admin_email);

	$query = $db->admin_restoran->where("admin_username LIKE ?", $admin_email);

	if ($query->count("*") < 1) {
		$add = $db->admin_restoran->insert(array(
			"restoran_id" => $restoran_id,
			"admin_username" => $admin_username,
			"admin_email" => $admin_email,
			"admin_password" => $password_hash,
			"admin_api" => $admin_api,
			));

		if ($add != null) {
			echo json_encode(array(
				"status" => true,
				"message" => "success add new admin"
				));
		} else {
			echo json_encode(array(
				"status" => false,
				"message" => "failed to add new admin"
				));
		}

	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "email is already exist"
			));
	}

});

/* login (admin restoran)*/
$app->post('/admin_restoran', function() use($app, $db){
	verifyRequiredParams(array('admin_email', 'admin_api'));

	$admin_email = $app->request->post('admin_email');
	$admin_api = $app->request->post('admin_api');

	$query = $db->admin_restoran->where("admin_username LIKE ?", $admin_email);

	if ($query->count("*") > 0) {
		foreach ($query as $value) {
			echo json_encode(array(
				"status" => true,
				"message" => "success login"
				));
		}

	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "email is not exist"
			));
	}

});

$app->put('/admin_restoran/:key', function($key) use($app, $db){
	$query = $db->admin_restoran->where("admin_id", $key);

	if ($query->fetch()) {
		$post = $app->request->put();
		$result = $query->update($post);
		echo json_encode(array(
			"status" => (bool)$result,
			"message" => "admin with id $key was updated"
			));
	} else{
		echo json_encode(array(
			"status" => false,
			"message" => "failed to update"
			));
	}
});

$app->delete('/admin_restoran/:key', function($key) use($app, $db){
	$query = $db->admin_restoran->where("admin_id", $key);

	if ($query->fetch()) {
		$result = $query->delete();
		echo json_encode(array(
			"status" => true,
			"message" => "admin with id $key was deleted"
			));
	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "admin with id $key not exists"
			));
	}

});

/*--------------------------------------------------- join table -----------------------------------------------------------------------------*/
$app->get('/listmenu', function() use($app, $pdo){
	$query = $pdo->query("select m.*, r.* from menu m inner join restoran r where m.restoran_id = r.restoran_id order by menu_id desc");

	while ($value = $query->fetch()) {
			$result["status"] = true;
			$result["result"][] = array(
			"menu_id" => $value["menu_id"],
			"menu_name" => $value["menu_name"],
			"menu_price" => $value["menu_price"],
			"menu_description" => $value["menu_description"],
			"menu_image" => $value["menu_image"],
			"restoran_name" => $value["restoran_name"],
			"restoran_logo" => $value["restoran_logo"]
			);
	}
	if ($query->rowCount("*") > 0) {
		echo json_encode($result);
	} else {
		echo json_encode(array(
			"status" => false,
			"response" => "nothing data yet"
			));
	}
	
});

$app->get('/listmakanan', function() use($app, $pdo){
	$query = $pdo->query("select m.*, r.* from menu m inner join restoran r where m.restoran_id = r.restoran_id and menu_kode = 'makanan' order by menu_id desc ");

	while ($value = $query->fetch()) {
			$result["status"] = true;
			$result["result"][] = array(
			"menu_id" => $value["menu_id"],
			"menu_name" => $value["menu_name"],
			"menu_price" => $value["menu_price"],
			"menu_description" => $value["menu_description"],
			"menu_image" => $value["menu_image"],
			"menu_sku" => $value["menu_sku"],
			"restoran_id" => $value["restoran_id"],
			"restoran_name" => $value["restoran_name"],
			"restoran_logo" => $value["restoran_logo"]
			);
	}
	if ($query->rowCount("*") > 0) {
		echo json_encode($result);
	} else {
		echo json_encode(array(
			"status" => false,
			"response" => "nothing data yet"
			));
	}
	
});

$app->get('/listminuman', function() use($app, $pdo){
	$query = $pdo->query("select m.*, r.* from menu m inner join restoran r where m.restoran_id = r.restoran_id and menu_kode = 'minuman' order by menu_id desc ");

	while ($value = $query->fetch()) {
			$result["status"] = true;
			$result["result"][] = array(
			"menu_id" => $value["menu_id"],
			"menu_name" => $value["menu_name"],
			"menu_price" => $value["menu_price"],
			"menu_description" => $value["menu_description"],
			"menu_image" => $value["menu_image"],
			"menu_sku" => $value["menu_sku"],
			"restoran_id" => $value["restoran_id"],
			"restoran_name" => $value["restoran_name"],
			"restoran_logo" => $value["restoran_logo"]
			);
	}
	if ($query->rowCount("*") > 0) {
		echo json_encode($result);
	} else {
		echo json_encode(array(
			"status" => false,
			"response" => "nothing data yet"
			));
	}
	
});


$app->get('/listdetail/:key', function($key) use($app, $pdo){
	$query = $pdo->query(" select m.*, r.* from menu m inner join restoran r where m.restoran_id = r.restoran_id and menu_id = $key");
	
	while ($value = $query->fetch()) {
			$result["status"] = true;
			$result["result"][] = array(
			"menu_id" => $value["menu_id"],
			"restoran_id" => $value["restoran_id"],
			"menu_name" => $value["menu_name"],
			"menu_price" => $value["menu_price"],
			"menu_kode" => $value["menu_kode"],
			"menu_description" => $value["menu_description"],
			"menu_image" => $value["menu_image"],
			"menu_sku" => $value["menu_sku"],
			"created_at" => $value["created_at"],
			"restoran_name" => $value["restoran_name"],
			"restoran_logo" => $value["restoran_logo"],
			"restoran_address" => $value["restoran_address"],
			"created_at" => $value["created_at"]
			
			);
	}
	if ($result->rowCount("*") > 0) {
		echo json_encode($result);
	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "cannot show data"
			));
	}
	
});


/* -------------------------------------------------- Payment_Configuration ----------------------------------------------------------------------*/

$app->post('/verifyPayment', function() use($app, $db) {

	$result["error"] = true;
	$result["message"] = "Payment Verify Success.";

	try {
		$paymentId = $app->request()->post('paymentId');
		$payment_client = json_decode($app->request->post('payment_client'), true);
		$menuId = $app->request()->post('menuId');
		$menuName = $app->request()->post('menuName');
		$menuPrice = $app->request()->post('menuPrice');
		$menuImage = $app->request()->post('menuImage');
		$menuSku = $app->request()->post('menuSku');
		$restoName = $app->request()->post('restoName');
		$restoLogo = $app->request()->post('restoLogo');
		$anggotaId = $app->request()->post('anggotaId');
		$anggotaName = $app->request()->post('anggotaName');
		$anggotaImage = $app->request()->post('anggotaImage');

		$apiContext = new \PayPal\Rest\ApiContext(
			new \PayPal\Auth\OAuthTokenCredential(
				$PayPal_Client_Id, $PayPal_Secret
				)
			);

		/* getting payment detail by making call paypal rest api */
		$payment = Payment::get($paymentId, $apiContext);

		/* verifiying the state approved */
		if ($payment->getState() != 'approved') {
			$response["error"] = true;
			$response["message"] = " Payment has not been verified";
			echoResponse(200, $response);
			// echo json_encode(array(
			// 	"status" => false,
			// 	"message" => "Payment not verified";
			// 	));
			return;
		}

		/* amount client side */
		$amount_client = $payment_client["amount"];
		/* currency on client side */
		$currency_client = $payment_client["currency_code"];
		
		/* PayPal Transaction */
		$transaction = $payment->getTransaction()[0];
		/* Amount on server side */
		$amount_server = $transaction->getAmount()->getTotal();
		 /* Currency on server side */
		$currency_server = $transaction->getAmount->getCurrency();
		$sale_state = $transaction->getRelatedResources()[0]->getSale()->getState();

		/*id, userId, paypalPaymentId, create_time, update_time, 
		state, amount, currency, created_at*/
		/* storing payment in payments table*/
		$query_insert_payment = $db->payments->insert(array(
			"userId" => $anggotaId,
			"paypalPaymentId" => $payment->getId(),
			"create_time" => $payment->getCreateTime(),
			"update_time" => $payment->getUpdateTime(),
			"state" => $payment->getState(),
			"amount" => $amount_server,
			"currency" => $amount_server,
			));

		/* Verifying the amount */
		if ($amount_server != $amount_client) {
			$response["error"] = true;
            $response["message"] = "Payment amount doesn't matched.";
            echoResponse(200, $response);
			// echo json_encode(array(
			// 	"status" => false,
			// 	"message" => " Payment amount doesn't matched.";
			// 	));
			return;
		}

		if ($currency_server != $currency_client) {
			 $response["error"] = true;
			 $response["message"] = "Payment currency doesn't matched.";
			 echoResponse(200, $response);
			// echo json_encode(array(
			// 	"status" => false,
			// 	"message" => " Payment Currency doesn't matched.";
			// 	));
			return;
		}

		if ($sale_state != 'complete') {
			$response["error"] = true;
            $response["message"] = "Sale not completed";
            echoResponse(200, $response);
			// echo json_encode(array(
			// 	"status" => false,
			// 	"message" => "Sale Not Completed";
			// 	));
			return;
		}

		$query_get_PaymentId = $db->payments->select('paymentId');

		/*id, paymentId(table), productId(table), state,
		 saleprice, quantity*/
		/* Insert to sales table */

		$quantity_buy =  1;

		$query_insert_sales = $db->sales->insert(array(
			"paymentId" => $query_get_PaymentId,
			"productId" => $menuId,
			"state" => $payment->getState(),
			"salePrice" => $amount_client,
			"quantity" => $quantity_buy,
			));


		echoResponse(200, $response);
	} catch (\PayPal\Exception\PayPalConnectionException $exc) {
		if ($exc->getCode == 404) {
			$response["error"] = true;
			$response["message"] = "payment not found";
		} else {
			$response["error"] = true;
            $response["message"] = "Unknown error occurred!" . $exc->getMessage();
            echoResponse(500, $response);
		}
	} catch (Exception $exc) {
		$response["error"] = true;
        $response["message"] = "Unknown error occurred!" . $exc->getMessage();
        echoResponse(500, $response);
	}

});

/**
 * method to store the saled items in sales table
 */
// function insertItemSales($paymentId, $transaction, $state) {

//     $item_list = $transaction->getItemList();

//     // $db = new DbHandler();
//     $server = 'localhost';
// 	$db_name = 'paypal';
// 	$db_user = 'root';
// 	$db_pass = '';
//     $pdo = new PDO("mysql:host=$server;dbname=$db_name", $db_user, $db_pass);

//     foreach ($item_list->items as $item) {
//         $sku = $item->sku;
//         $price = $item->price;
//         $quanity = $item->quantity;

//         $product = $db->getProductBySku($sku);

//         // inserting row into sales table
//         $db->storeSale($paymentId, $product["id"], $state, $price, $quanity);
//     }
// }


/*-------------------------------------------------- utils --------------------------------------------------------------------------*/

/* validation email format*/
function validateEmail($email) {
    $app = \Slim\Slim::getInstance();
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["error"] = true;
        $response["message"] = 'Email address is not valid';
        echo json_encode($response);
        $app->stop();
    }
}

/* verification requirement input data */
function verifyRequiredParams($required_fields) {
    $error = false;
    $error_fields = "";
    $request_params = array();
    $request_params = $_REQUEST;
    // Handling PUT request params
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $request_params);
    }
    foreach ($required_fields as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
        // Required field(s) are missing or empty
        $response = array();
        $app = \Slim\Slim::getInstance();
        $response["error"] = true;
        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echo json_encode($response);
        $app->stop();
    }
}

function generateApiKey() {
        return md5(uniqid(rand(), true));
    }

function authenticate(\Slim\Route $route){

	$header = apache_request_headers();
	$response = array();
	$app = \Slim\Slim::getInstance();

	if (isset($header['Authorization'])) {
		
		$api_key = $header['Authorization'];
		$query = $db->admin_restoran->select("admin_api")->where("admin_api", $api_key);

		if ($query->count("*") > 0) {
			$admin_id = $query;

		} else {
			echo json_encode(array(
				"status" => false,
				"message" => "Access Denied. Invalid Api Key"
				));
			$app->stop();
		}

	} else {
		echo json_encode(array(
			"status" => false,
			"message" => "Api Key is missing"
			));
		$app->stop();
	}

}

function echoResponse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);

    // setting response content type to json
    $app->contentType('application/json');

    echo json_encode($response);
}

$app->run();
