<?php

class GoodListModel implements iData
{   
    function getData()
    {   
        
        $catalog = new CatalogModel();
        $category = new CategoryModel();
        
        $recordsPerPage = $_SESSION['recordsPerPage'];
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $categoryId = (isset($_GET['category_id'])) ? $_GET['category_id'] : 1;
        
        $result['records'] = $catalog->execQuery("SELECT * FROM catalog  
                                                  JOIN good ON (catalog.good_id = good.good_id)
                                                  WHERE catalog.category_id=$categoryId AND good_activity=1 
                                                  LIMIT ".($currentPage - 1) * $recordsPerPage.", $recordsPerPage");
        
        $numOfRecords = (int) $catalog->execQuery("SELECT COUNT(*) FROM catalog  
                                                   JOIN good ON (catalog.good_id = good.good_id)
                                                   WHERE catalog.category_id=$categoryId AND good_activity=1")[0]['COUNT(*)'];
        
        
        $result['category'] = $category::findById($categoryId);
        
        $result['pagination'] = getPagesArray($numOfRecords, $currentPage, $recordsPerPage);
        $result['currentPage'] = $currentPage;
        
        return $result;
    }

}