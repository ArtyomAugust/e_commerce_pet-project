<?php
namespace Modules\Controller;

use Modules\Model\DB as DB;
use Modules\Gaurd\Check as GaurdStrict;


class Product extends BaseController
{
    function show()
    {

        $sql = "SELECT  products.id as id, 
                        products.label as label, 
                        products.photo_name as photo_name, 
                        products.description as description, 
                        products.price as price,
                        products.discount as discount,
                        products.hot as hot,
                        categories.name_category as category 
                        FROM products 
                        INNER JOIN categories ON products.category_id=categories.id 
                        ";

        $connect = new DB();
        $connect->run($sql);
        return $this->render([...$connect]);
    }

    function takeFromInput()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $query = $_GET['findproduct'];
            $sql = "SELECT  products.id as id, 
                        products.label as label, 
                        products.photo_name as photo_name, 
                        products.description as description, 
                        products.price as price,
                        products.discount as discount,
                        products.hot as hot,
                        categories.name_category as category 
                        FROM products 
                        INNER JOIN categories ON products.category_id=categories.id 
                        WHERE label LIKE ? ";

            $params = ['%' . $query . '%'];

            $connect = new DB();
            $connect->run($sql, $params);
            return $this->render([...$connect]);
        }
    }
}