<?php

class makeView extends View
{
       
    public function __construct($data,$template) 
    {
        $this->addData('Data', $data->getData());
        parent::__construct($template);
    }


}