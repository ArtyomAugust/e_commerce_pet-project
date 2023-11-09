<?php
require_once __DIR__ . '\\vendor\\autoload.php';
$base_path = __DIR__ . '\\';
global $base_path;
require_once $base_path . 'setting.php';


use Modules\Controller\Product;


$product = new Product();
$request = '';
$request .= '/';
$request .= $_GET['route'];
// echo $request;


switch ($request) {
    case '/':
        $context = $product->show();
        require_once($base_path . 'src\modules\view\home.php');
        break;
    case '/about':
        require_once($base_path . 'src\modules\view\about.php');
        break;
    default:
        require_once($base_path . 'src\modules\view\404.php');
        break;
}