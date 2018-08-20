<?php

class GoodModel extends Object {
    
    static function TableName() {
        return 'good';
    }
    
    protected function getGoods() {
                 
        $result = $this->execQuery("SELECT * FROM ".self::TableName());
        return $result;

    }
    
    protected function setGood($params = []) {
            
        return $this->saveRecord($params);
        
    }   
}