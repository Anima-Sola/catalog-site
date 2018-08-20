<?php

    abstract class Object {

    /** @var  PDO */
    static $db;
    protected $params =[];

    public function __construct( $params = [])
    {
        $className = get_called_class();
        foreach ($params as $param_name => $param_value){
            if (property_exists($className, $param_name ))
                $this->$param_name = $param_value;
            elseif(method_exists($this,'set'.ucfirst($param_name) )){
                $name = 'set'.ucfirst($param_name);
                $this->$name($param_value);
            }

        }
    }

    public function __get($name)
    {
        $sFuncName = 'get'.ucfirst($name);
        if (method_exists($this,$sFuncName ))
            return $this->$sFuncName();

        return null;
    }
    
    public function __set($name, $params = [])
    {
        $sFuncName = 'set'.ucfirst($name);
        if (method_exists($this,$sFuncName ))
            return $this->$sFuncName($params);

        return null;
    }

    abstract static function TableName();
    
    public function execQuery($query = "") {
        
        $qResult = [];
        
        try {
            $query = Object::$db->prepare($query);
            $query->execute();
            $qResult = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Операция не удалась: ' . $e->getMessage();
            var_dump($e->getMessage());
        }
        
        return $qResult;
        
    }
     
    protected function updateRecord($params = []) {

        $class = get_called_class();
        $table = $class::TableName();
        $id = array_shift($params);
        $query = "UPDATE $table SET ";
        foreach($params as $param => $value) $query.="$param='$value', ";
        $query = substr($query, 0, -2);        
        $query.=" WHERE ".$table."_id = ".$id;
        $this->execQuery($query);
        
    }
    
    protected function addRecord($params = []) {
        $class = get_called_class();
        $table = $class::TableName();
        $query = "INSERT INTO $table (";
        $columns = "";
        $values = "";
        foreach($params as $param => $value) {
            $columns.="$param, ";
            $values.="'$value', ";
        }
        $columns = substr($columns, 0, -2);  
        $values = substr($values, 0, -2);        
        $query.=$columns.") VALUES (".$values.")";
        $this->execQuery($query);
    }
    
    protected function saveRecord($params = []) {
        $class = get_called_class();
        $id = $class::TableName()."_id";
        $isIdExist = (isset($params[$id])) ? $class::findById($params[$id]) : false;
        ($isIdExist) ? $this->updateRecord($params) : $this->addRecord($params);
        return $this;
        
    }
    
    public static function findById($id){

        /** @var Object $class */
        $class = get_called_class();
        $table = $class::TableName();
        
        $oQuery = Object::$db->prepare("SELECT * FROM $table WHERE ".$table."_id=:need_id");
        $oQuery->execute(['need_id' => $id]);
        $aRes = $oQuery->fetch(PDO::FETCH_ASSOC);
        return $aRes/*? new $class($aRes):null*/;
    }
     
}
