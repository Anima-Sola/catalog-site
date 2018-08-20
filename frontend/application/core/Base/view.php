<?php

class View
{
	
	private $siteSections = [];

    public function __construct($template)
    {
        $this->template = $template;
    }

    function addData( $siteSection, $data ){
	    $this->siteSections[$siteSection] = $data;
    }

	function generate()
	{
        foreach ( $this->siteSections as $siteSection => $value) 
            $$siteSection = $value;
        
		include 'application/views/'.$this->template;
	}
}
