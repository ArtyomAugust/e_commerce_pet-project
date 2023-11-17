<?php
require_once __DIR__ . '\\vendor\\autoload.php';
$base_path = __DIR__ . '\\';
global $base_path;
require_once $base_path . 'setting.php';


use Modules\Controller\Product;
use Modules\Controller\Account as Account;

$product = new Product();
$account = new Account();


$request = $_GET['route'];
if (strlen($request) === 0) {
    $request .= '';
}
// echo $request;
if (!empty($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $request .= '?edit_id=' . $edit_id;
}


switch ($request) {
    case '':
        $context = $product->show();
        require_once($base_path . 'src\modules\view\home.php');
        break;
    case 'about':
        require_once($base_path . 'src\modules\view\about.php');
        break;
    case 'login':
        $account->login();
        require_once($base_path . 'src\modules\view\login.php');
        break;
    case 'sellerpage/':
        $context = $account->show();
        require_once($base_path . 'src\modules\view\sellerPage.php');
        break;
    case 'sellerpage' . '/edit?edit_id=' . $edit_id:
        $ready = $account->edit();
        extract($ready);
        require_once($base_path . 'src\modules\view\edit.php');
        break;
    case 'sellerpage/crnewprt/':
        // $account->show();
        require_once($base_path . 'src\modules\view\.php');
        break;
    default:
        echo $request . "\r\n";
        // echo 'sellerpage' . '/edit?edit_id=' . $edit_id . '/';
        require_once($base_path . 'src\modules\view\404.php');
        break;
}