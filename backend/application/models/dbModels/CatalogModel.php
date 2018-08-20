<?php

class CatalogModel extends Object {

    static function TableName() {
        return 'catalog';
    }
    
    protected function getCatalog() {
         
        $result = $this->execQuery("SELECT * FROM ".self::TableName()." WHERE master_id=$master_id AND service_id=$service_id");
        return $result;

    }
    
    protected function setCatalogItem($params = []) {
            
        return $this->saveRecord($params);
        
    }   
}