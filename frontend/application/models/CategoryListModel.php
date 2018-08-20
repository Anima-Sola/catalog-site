<?php

class CategoryListModel implements iData
{
        
    function getData()
    {   
        
        $category = new CategoryModel();
                         
        $recordsPerPage = $_SESSION['recordsPerPage'];
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : 1;
        
        $result['records'] = $category->execQuery("SELECT * FROM category WHERE category_activity=1 LIMIT ".($currentPage - 1) * $recordsPerPage.", $recordsPerPage");
        $numOfRecords = (int) $category->execQuery("SELECT COUNT(*) FROM category WHERE category_activity=1;")[0]['COUNT(*)'];

        $result['pagination'] = getPagesArray($numOfRecords, $currentPage, $recordsPerPage);
        $result['currentPage'] = $currentPage;
        
        return $result;
    }

}