<?php

class CategoryModel extends Object {
        
    static function TableName() {
        return 'category';
    }
    
    protected function getCategories(){
        
        $result = $this->execQuery("SELECT * FROM ".self::TableName());
        return $result;
                
    }
    
    protected function setCategory($params = []) {
        
        return $this->saveRecord($params);
                
    }
        
}