<?php
require_once __DIR__ . '\\vendor\\autoload.php';
$base_path = __DIR__ . '\\';
global $base_path;
require_once $base_path . 'setting.php';


use Modules\Controller\Product;
use Modules\Controller\Account as Account;

$product = new Product();
$account = new Account();


$edit_id = '';
$delete_id = '';
$query = '';
$request = $_GET['route'];
if (strlen($request) === 0) {
    $request .= '';
}
// echo $request;
if (!empty($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $request .= '?edit_id=' . $edit_id;
}
if (!empty($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $request .= '?delete_id=' . $delete_id;
}
if (!empty($_GET['findproduct'])) {
    $query = $_GET['findproduct'];
    $request .= 'home?findproduct=' . $query;
}


switch ($request) {
    case '':
        $context = $product->show();
        require_once($base_path . 'src\modules\view\home.php');
        break;
    case (isset($edit_id)) ? 'home?findproduct=' . $query : '':
        $context = $product->takeFromInput();
        // echo $queryDB;
        require_once($base_path . 'src\modules\view\homeFindProduct.php');
        break;
    case 'about':
        require_once($base_path . 'src\modules\view\about.php');
        break;
    case 'login':
        $error = $account->login();
        require_once($base_path . 'src\modules\view\login.php');
        break;
    case 'logout':
        $account->logout();
        require_once($base_path . 'src\modules\view\home.php');
        break;
    case 'sellerpage':
        $context = $account->show();
        require_once($base_path . 'src\modules\view\sellerPage.php');
        break;
    case (isset($edit_id)) ? 'sellerpage' . '/edit?edit_id=' . $edit_id : '':
        $ready = $account->edit();
        extract($ready);
        require_once($base_path . 'src\modules\view\edit.php');
        break;
    case (isset($delete_id)) ? 'sellerpage' . '?delete_id=' . $delete_id : '':
        $context = $account->delete();
        require_once($base_path . 'src\modules\view\sellerPage.php');
        break;
    case 'sellerpage/crtnewprt':
        $ready = $account->create();
        extract($ready);
        require_once($base_path . 'src\modules\view\crtNewPrt.php');
        break;
    default:
        echo $request . "\r\n";
        // echo $_GET['delete_id'];
        // echo (isset($delete_id)) ? $delete_id . 'sellerpage' . '/delete_id=' : '';
        require_once($base_path . 'src\modules\view\404.php');
        break;
}