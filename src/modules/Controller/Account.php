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

        return $this->render([...$connect]);

    }

    function edit()
    {
        ob_start();
        session_start();

        $connect = new DB();
        $id = $_GET["edit_id"];
        $date = "\"" . date("Y-m-d H:i:s") . "\"";


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $sql = "SELECT * FROM categories";
            $connect->run($sql);
            $result = [...$connect];


            $post = $_POST;
            var_dump($post);
            // foreach ($post as $key => $value) {
            //     $post[$key] = Gaurd::checkStrictText($value);
            // }
            $makesql = '';
            foreach ($post as $key => $value) {
                foreach ($result as $key2 => $value2) {
                    if ($value[0] === $value2['name_category']) {
                        $value[0] = $value2['id'];
                    }
                }
                if (is_array($value)) {
                    $makesql .= 'category_id = ' .  $value[0] . ',';
                    continue;
                }

                if ('description' === $key) {
                    $makesql .= $key . ' = ' . "\"$value\"" . ',';
                    continue;
                }

                if ('label' === $key) {
                    $makesql .= $key . ' = ' . "\"$value\"" . ',';
                    continue;
                }

                $makesql .= " $key = $value, ";
            }

            $sql = "UPDATE  products SET " . $makesql .
                "uploaded = $date WHERE id = $id";
            $connect->run($sql);

        }



        $sql = "SELECT * FROM products WHERE id = $id";
        $result = $connect->get_record($sql);

        $category = '';
        $sqll = "SELECT * FROM categories";
        $connect->run($sqll);
        $category = [...$connect];
        return ['result' => $result, 'category' => $category];
    }

    function delete()
    {

    }
}