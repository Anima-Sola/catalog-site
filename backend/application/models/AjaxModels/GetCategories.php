<?php
    function getCategories($goodId){
        
        $allCategories = [];
        $categoriesByGoodId = [];
        
        $category = new CategoryModel();
        $catalog = new CatalogModel();
        
        $allCategories = $category->execQuery("SELECT category_id, category_name FROM category");
        $categoriesByGoodId = $catalog->execQuery("SELECT category_id FROM catalog WHERE good_id=$goodId;");
        
        for($i = 0; $i < count($categoriesByGoodId); $i++) $categoriesByGoodId[$i] = $categoriesByGoodId[$i]['category_id'];
        
        for($i = 0; $i < count($allCategories); $i++)
            $allCategories[$i]['checked'] = (in_array($allCategories[$i]['category_id'], $categoriesByGoodId)) ? true : false;
        
        return json_encode($allCategories);
    }  
?>