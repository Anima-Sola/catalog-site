<?php

class GoodCardModel implements iData
{    
    function getData()
    {   
        $good = new GoodModel();
        $catalog = new CatalogModel();
        $category = new CategoryModel();
        $goodId = (isset($_GET['good_id'])) ? $_GET['good_id'] : 1;
        $categoryId = (isset($_GET['category_id'])) ? $_GET['category_id'] : 1;
        
        if(isset($_POST['quantity'])) {
            $quantity = $_POST['quantity'];
            $good->good = array('good_id' => $goodId, 'good_quantity_instock' => $quantity);
        }
        
        $result['available_categories'] = $catalog->execQuery("SELECT catalog.category_id, category_name FROM catalog
               		                                           JOIN category ON (category.category_id = catalog.category_id)
                                                               WHERE good_id=$goodId AND catalog.category_id <> $categoryId");  
        
        $result['category'] = $category::findById($categoryId);
        $result['good'] = $good::findById($goodId);
        
        return $result;
    }
}