<?php
namespace Modules\Controller;

use Modules\Model\DB as DB;

class Product extends BaseController
{
    function show()
    {   $post = '';
        
        if (isset($_POST['myInputForm'])) {
            $post = $_POST['myInputForm'];
        }
        
        $sql = "SELECT products.id as id, 
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

        $params = ['%' . $post . '%'];

        $connect = new DB();
        $connect->run($sql, $params);
        return $this->render([...$connect]);
    }

    function delete()
    {

    }

    function update()
    {

    }

    function add()
    {

    }
}