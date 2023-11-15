<?php

namespace Modules\Controller;

use Modules\Gaurd\Check as Gaurd;
use Modules\Model\DB as DB;

class Account extends BaseController
{
    function login()
    {
        ob_start();
        session_start();


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = [
                'user_name' => 'User name is not right!',
                'password' => 'Your password is not right!'
            ];
            $username = Gaurd::checkStrictText($_POST['username']);
            $password = Gaurd::checkStrictText($_POST['password']);
            $_SESSION['user_name'] = $username;

            $connect = new DB();
            $params = $_SESSION['user_name'];
            $sql = "SELECT id, password, user FROM users WHERE user = $params";
            $hash = $connect->get_record($sql);





            $valid = Gaurd::password_verify($password, $hash['password']);
            return ($valid) ? header('Location: sellerpage/') : $error;

        }

        session_destroy();
    }

    function show()
    {
        ob_start();
        session_start();
        $connect = new DB();


        $params = $_SESSION['user_name'];
        $sql = "SELECT id, user FROM users WHERE user = $params";
        $user_name = $connect->get_record($sql);

        $params = $user_name['id'];
        $sql = "SELECT  products.id as id,
                        products.label as label, 
                        products.photo_name as photo_name, 
                        products.video_name as video_name, 
                        products.description as description, 
                        products.price as price,
                        products.discount as discount,
                        products.uploaded as uploaded,
                        categories.name_category as category
                        FROM products 
                        INNER JOIN categories ON categories.id=products.category_id
                        WHERE user_id = $params";


        $connect->run($sql);
        // $products = [...$connect];

        return $this->render([...$connect]);

    }

    function edit() {
        ob_start();
        session_start();

        $connect = new DB();
        $id = $_GET["edit_id"];
        $date = date("Y-m-d H:i:s");


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sql = "UPDATE products SET 
                            label=,
                            description=,
                            photo_name=,
                            category=,
                            price=,
                            discount=,
                            uploaded = $date,
                            WHERE id = $id";
            
        }

        

        $sql = "SELECT * FROM products WHERE id = $id";
        return $connect->get_record($sql);
    }

    function delete() {
        
    }
}