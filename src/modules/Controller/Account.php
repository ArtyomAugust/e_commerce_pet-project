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
            $sql = "SELECT id, user FROM users";
            $connect->run($sql);
            $users = [...$connect];
            $param = $_SESSION['user_name'];
            foreach ($users as $value) {
                if ($param === $value) {
                    $param = $value;
                    break;
                }
            }

            if (empty($param)) {
                return $error;
            }

            $sql = "SELECT id, password, user FROM users WHERE user = $param";
            $hash = $connect->get_record($sql);


            $valid = Gaurd::password_verify($password, $hash['password']);
            $_SESSION['user_id'] = $hash['id'];
            if (!$valid) {
                return $error;
            }
            return header('Location: sellerpage');
        }

        session_destroy();
    }

    function show()
    {
        ob_start();
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
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

    function logout()
    {
        session_destroy();

        header("Location: home");
    }

    function edit()
    {
        ob_start();
        session_start();

        $connect = new DB();
        $id = $_GET["edit_id"];
        $date = "\"" . date("Y-m-d H:i:s") . "\"";
        $photo_name = '';
        $post = [];
        global $base_path;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $post = $_POST;

            if (isset($_FILES["photo_name"]) && $_FILES["photo_name"]["error"] === 0) {

                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                $filename = $_FILES["photo_name"]["name"];
                $filetype = $_FILES["photo_name"]["type"];

                // Validate file extension
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                if (!array_key_exists($ext, $allowed))
                    die("Error: Please select a valid file format.");
                // Validate type of the file
                if (in_array($filetype, $allowed)) {
                    // Check whether file exists before uploading it
                    if (file_exists($base_path . "src\pictures\\" . $filename)) {
                        $photo_name = $filename;
                        echo $filename . " is already exists.";
                    } else {
                        if (move_uploaded_file($_FILES["photo_name"]["tmp_name"], $base_path . "src\pictures\\" . $filename)) {
                            // $sql="INSERT INTO images(file,type,size) VALUES('$filename','$filetype')";

                            // mysqli_query($conn,$sql);

                            $photo_name = $filename;
                            echo "Your file was uploaded successfully.";
                        } else {
                            echo "File is not uploaded";
                        }
                    }

                } else {
                    echo "Error: There was a problem uploading your file. Please try again.";
                }
            } elseif (!empty($post['photo_name'])) {
                $photo_name = $post['photo_name'];
            } else {
                echo "Error: " . $_FILES["photo_name"]["error"];
            }


            $sql = "SELECT * FROM categories";
            $connect->run($sql);
            $result = [...$connect];


            $makesql = '';
            $postChecked = [];

            foreach ($post as $key => $value) {
                if (is_array($value)) {
                    $postChecked["name_category"] = $value[0];
                    continue;
                }
                $postChecked[$key] = Gaurd::checkText($value);
            }
            var_dump($postChecked);
            foreach ($postChecked as $key => $value) {
                foreach ($result as $key2 => $value2) {
                    if ($value === $value2['name_category']) {

                        $makesql .= "category_id = " . $value2['id'];
                    }
                }
                if ('name_category' === $key) {
                    continue;
                }

                if ('description' === $key) {
                    $makesql .= $key . ' = ' . "\"$value\"" . ',';
                    continue;
                }

                if ('photo_name' === $key) {
                    continue;
                }

                if ('discount' === $key and empty($value)) {
                    continue;
                }

                if ('label' === $key) {
                    $makesql .= $key . ' = ' . "\"$value\"" . ',';
                    continue;
                }

                $makesql .= " $key = $value, ";
            }

            $makesql .= (isset($photo_name)) ? " ,photo_name = \"$photo_name\"" : '';


            $sql = "UPDATE  products SET " . $makesql . " ,uploaded = $date WHERE id = $id";
            $connect->run($sql);
            header('Location: /pet_project/sellerpage');

        }



        $sql = "SELECT * FROM products WHERE id = $id";
        $result = $connect->get_record($sql);

        $category = '';
        $sqll = "SELECT * FROM categories";
        $connect->run($sqll);
        $category = [...$connect];
        return ['result' => $result, 'category' => $category];
    }

    function create()
    {
        global $base_path;
        ob_start();
        session_start();

        $connect = new DB();
        $values = [];
        $makesql = '';
        $values[':user_id'] = $_SESSION['user_id'];
        $photo_name = "";
        $postChecked = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = $_POST;

            foreach ($post as $key => $value) {
                if (is_array($value)) {
                    $postChecked["category_id"] = (int) $value[0];
                    continue;
                }
                $postChecked[$key] = Gaurd::checkText($value);
            }

            if (isset($_FILES["photo_name"]) && $_FILES["photo_name"]["error"] === 0) {

                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                $filename = $_FILES["photo_name"]["name"];
                $filetype = $_FILES["photo_name"]["type"];

                // Validate file extension
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                if (!array_key_exists($ext, $allowed))
                    die("Error: Please select a valid file format.");
                // Validate type of the file
                if (in_array($filetype, $allowed)) {
                    // Check whether file exists before uploading it
                    if (file_exists($base_path . "src\pictures\\" . $filename)) {
                        $photo_name = $filename;
                        echo $filename . " is already exists.";
                    } else {
                        if (move_uploaded_file($_FILES["photo_name"]["tmp_name"], $base_path . "src\pictures\\" . $filename)) {
                            // $sql="INSERT INTO images(file,type,size) VALUES('$filename','$filetype')";

                            // mysqli_query($conn,$sql);

                            $photo_name = $filename;
                            echo "Your file was uploaded successfully.";
                        } else {
                            echo "File is not uploaded";
                        }
                    }

                } else {
                    echo "Error: There was a problem uploading your file. Please try again.";
                }
            } else {
                echo "Error: " . $_FILES["photo_name"]["error"];
            }

            foreach ($postChecked as $key => $value) {
                if ($key === 'category_id') {
                    $values[":category_id"] = (integer) $value;
                    $makesql .= ":category_id";
                    continue;
                }
                if ($key === 'price') {
                    $values[':' . $key] = (double) $value;
                    $makesql .= ":$key, ";
                    continue;
                }

                if ($key === 'discount') {
                    $values[':' . $key] = (double) $value;
                    $makesql .= ":$key, ";
                    continue;
                }

                $makesql .= ":$key, ";
                $values[':' . $key] = $value;
            }

            $makesql .= ",:photo_name";
            $values[":photo_name"] = $photo_name;

            $sql = "INSERT INTO products (user_id, label, description, price, discount," .
                " category_id, photo_name) VALUES (:user_id, $makesql)";

            $connect->run($sql, $values);

            header('Location: /pet_project/sellerpage');
        }

        $sql = "SELECT * FROM categories";
        $connect->run($sql);
        $category = [...$connect];
        return ['category' => $category];


    }

    function delete()
    {
        // if (session_status() != PHP_SESSION_ACTIVE){session_start();}
        $connect = new DB();


        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            ob_start();
            session_start();
            $delete = $_GET['delete_id'];


            $sql = "DELETE FROM products where id = $delete";
            $connect->run($sql);

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


    }
}