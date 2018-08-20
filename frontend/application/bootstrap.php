<?php
class Bootstrap{

    private $aConfig;

    function __construct($aConfig)
    {
        $this->aConfig = $aConfig;
    }

    private function load($Dir){
        /** @var FilesystemIterator[] $oDirectory */
        $oDirectory = new FilesystemIterator($Dir);
        foreach ($oDirectory as $oElem){
            if ($oElem->isDir())
                $this->load($Dir.'/'.$oElem->getFilename());
            else
                require_once ($Dir.'/'.$oElem->getFilename());
        }
    }

    function start(){
        foreach ($this->aConfig as $sDir){
            $this->load(__DIR__.'/'.$sDir);
        }

        require_once '..\common\DBConnect.php';
    }
}

