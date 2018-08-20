<?php

class CategoryAdminListModel implements iData
{
    
    private function editCategory(){
        
        $category = new CategoryModel();
        $categoryId = $_POST['category_id'];
            
        $categoryActivity = (isset($_POST['category_activity'])) ? 1 : 0;
        if($categoryId != "-1") {
            $category->category = array('category_id' => $_POST['category_id'], 
                                        'category_name' => $_POST['category_name'],
                                        'category_description' => $_POST['category_description'], 
                                        'category_full_description' => $_POST['category_full_description'],
                                        'category_activity' => $categoryActivity);
        }
        else {
            $category->category = array('category_name' => $_POST['category_name'], 
                                        'category_description' => $_POST['category_description'], 
                                        'category_full_description' => $_POST['category_full_description'],
                                        'category_activity' => $categoryActivity);
        }
        
    }
    
    function getData()
    {   
        
        $category = new CategoryModel();
        
        if(isset($_POST['category_id'])) $this->editCategory();
                        
        $recordsPerPage = $_SESSION['recordsPerPage'];
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : 1;
        
        $result['records'] = $category->execQuery("SELECT * FROM category LIMIT ".($currentPage - 1) * $recordsPerPage.", $recordsPerPage");
        $numOfRecords = $category->execQuery("SELECT COUNT(*) FROM category")[0]['COUNT(*)'];

        $result['pagination'] = getPagesArray($numOfRecords, $currentPage, $recordsPerPage);
        $result['currentPage'] = $currentPage;
        
        return $result;
    }

}