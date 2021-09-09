<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__) . "/services/ProductService.class.php";
require_once dirname(__FILE__) . "/routes/Route.class.php";
require_once dirname(__FILE__) . "/Utils.class.php";
require_once dirname(__FILE__) . "/config.php";

header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');


// var_dump(parse_url($_SERVER['REQUEST_URI']));
$productsService = new ProductService();

// var_dump($_SERVER['SCRIPT_NAME']);
// var_dump($_SERVER['SERVER_NAME']);
// echo Config::PROTOCOL();


// gets all products
Route::add('/products', function () {
  global $productsService;
  echo json_encode($productsService->getAll(), JSON_PRETTY_PRINT);
});

//add new product
Route::add('/products', function () {
  global $productsService;
  echo json_encode($productsService->add(Utils::postRequest())); // get the data from body
}, 'post');


Route::add('/products/([A-Z]+[0-9]+)', function ($SKU) {
  echo $SKU;
}, 'delete');

$path = '/';

if (Config::SERVER_NAME() == 'localhost') {
  $path = '/products-app-api';
}

Route::run($path);
?>