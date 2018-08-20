<?php

class GoodAdminListModel implements iData
{    
    private function editAddGood($categoryId) {
        
        $good = new GoodModel();
        $catalog = new CatalogModel();
        $goodActivity = (isset($_POST['good_activity'])) ? 1 : 0;
        $goodAvailability = (isset($_POST['good_is_available_for_order'])) ? 1 : 0;
        if($_POST['good_id'] != "-1") {
            $good->good = array('good_id' => $_POST['good_id'], 
                                'good_name' => $_POST['good_name'],
                                'good_description' => $_POST['good_description'], 
                                'good_full_description' => $_POST['good_full_description'],
                                'good_activity' => $goodActivity,
                                'good_is_available_for_order' => $goodAvailability,
                                'good_quantity_instock' =>$_POST['good_quantity_instock']);
        }
        else {
            $good->good = array('good_name' => $_POST['good_name'],
                                'good_description' => $_POST['good_description'], 
                                'good_full_description' => $_POST['good_full_description'],
                                'good_activity' => $goodActivity,
                                'good_is_available_for_order' => $goodAvailability,
                                'good_quantity_instock' =>$_POST['good_quantity_instock']);

            $lastGoodId = $good->execQuery("SELECT MAX(good_id) FROM good")[0]["MAX(good_id)"];

            $catalog->catalogItem = array('category_id' => $categoryId,
                                          'good_id' => $lastGoodId);
        }
        
    }
    
    private function editCatalog() {
        
        $catalog = new CatalogModel();
        
        $goodId = $_POST['edit_catalog'];
        $oldSelectedCategories = $catalog->execQuery("SELECT category_id FROM catalog WHERE good_id=$goodId;");
        $newSelectedCategories = [];
        foreach($_POST as $value) {

            $temp = explode('=', $value);
            if($temp[0] == 'cat_id') {
                $newSelectedCategories[] = array('category_id' => $temp[1]);
            }

        }

        foreach($oldSelectedCategories as $value) {
            $categoryId = $value['category_id'];
            if(!in_array($value, $newSelectedCategories)) $catalog->execQuery("DELETE FROM catalog WHERE good_id=$goodId AND category_id=$categoryId;");
        }

        foreach($newSelectedCategories as $value) {
            $categoryId = $value['category_id'];
            if(!in_array($value, $oldSelectedCategories)) $catalog->execQuery("INSERT INTO catalog (category_id, good_id) VALUES ($categoryId,$goodId);");
        }
        
    }
    
    function getData()
    {   
        $good = new GoodModel();
        $catalog = new CatalogModel();
        $category = new CategoryModel();
        
        $recordsPerPage = $_SESSION['recordsPerPage'];
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $categoryId = (isset($_GET['category_id'])) ? $_GET['category_id'] : 1;
        
        if(isset($_POST['good_id'])) $this->editAddGood($categoryId);
        if(isset($_POST['edit_catalog'])) $this->editCatalog();
        if(isset($_GET['is_search']) && ($_GET['is_search'] == "true")) {
            
            $sGoodName = ($_GET['s_good_name'] == "") ? "" : "good.good_name LIKE '%".$_GET['s_good_name']."%' AND";
            $sGoodDescription = ($_GET['s_good_description'] == "") ? "" : "good.good_description LIKE '%".$_GET['s_good_description']."%' AND";
            $sGoodFullDescription = ($_GET['s_good_full_description'] == "") ? "" : "good.good_full_description LIKE '%".$_GET['s_good_full_description']."%' AND";
            $sGoodQuantityInstockFrom = ($_GET['s_good_quantity_instock_from'] == "") ? "" : "good.good_quantity_instock >= '".$_GET['s_good_quantity_instock_from']."' AND";
            $sGoodQuantityInstockTo = ($_GET['s_good_quantity_instock_to'] == "") ? "" : "good.good_quantity_instock <= '".$_GET['s_good_quantity_instock_to']."' AND";
            $sGoodActivity = (isset($_GET['s_good_activity'])) ? "good.good_activity = 1 AND " : "good.good_activity = 0 AND";
            $sGoodAvailableForOrder = (isset($_GET['s_good_is_available_for_order'])) ? "good.good_is_available_for_order = 1" : "good.good_is_available_for_order = 0";
                                       
            $result['records'] = $good->execQuery("SELECT * FROM good 
                                                   WHERE $sGoodName $sGoodDescription
                                                   $sGoodFullDescription $sGoodQuantityInstockFrom $sGoodQuantityInstockTo
                                                   $sGoodActivity $sGoodAvailableForOrder
                                                   LIMIT ".($currentPage - 1) * $recordsPerPage.", $recordsPerPage");
                               
            $numOfRecords = (int) $good->execQuery("SELECT COUNT(*) FROM good 
                                                    WHERE $sGoodName $sGoodDescription
                                                    $sGoodFullDescription $sGoodQuantityInstockFrom $sGoodQuantityInstockTo
                                                    $sGoodActivity $sGoodAvailableForOrder")[0]['COUNT(*)'];
            
            $result['not_found'] = ($numOfRecords == 0) ? true : false;
            
        } else {
        
            $result['records'] = $catalog->execQuery("SELECT * FROM catalog  
                                                      JOIN good ON (catalog.good_id = good.good_id)
                                                      WHERE catalog.category_id=$categoryId
                                                      LIMIT ".($currentPage - 1) * $recordsPerPage.", $recordsPerPage");

            $numOfRecords = (int) $catalog->execQuery("SELECT COUNT(*) FROM catalog  
                                                       JOIN good ON (catalog.good_id = good.good_id)
                                                       WHERE catalog.category_id=$categoryId")[0]['COUNT(*)'];
        }
        
        $result['category'] = $category::findById($categoryId);
        
        $result['pagination'] = getPagesArray($numOfRecords, $currentPage, $recordsPerPage);
        $result['currentPage'] = $currentPage;
        
        return $result;
    }    
}