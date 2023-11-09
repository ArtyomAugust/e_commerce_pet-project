<?php
function connect_to_db ()
{
    try {
        $conn_str = \Settings\DB_HOST . 
                \Settings\DB_NAME . 'charset=utf8';
            return new \PDO($conn_str, \Settings\DB_USERNAME,
                \Settings\DB_PASSWORD);

        //$conn_str -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    } catch (\PDOException $e) {
        exit("Connection failed " . $e->getMessage());
    }   
}

    function upload_video() {
        //move_uploaded_file()
    }
    function upload_photo() {
        //move_uploaded_file()
    }

    function redirect(string $url, int $status = 302 ){
        header('Location: ' . $url, true, $status);
    }