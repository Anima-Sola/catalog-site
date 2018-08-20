<?php

abstract class Controller {

    protected $action;

    public $header = [];
    public $content = [];

	private $view;
    /**
     * @param array $params
     */
	abstract function parseParams($params);

	function __construct($params = [],$template = 'main_view.php')
	{
	    $this->parseParams($params);

		$this->view = new View($template);
	}

	function build(){

	    $sAction = $this->action;
	    $this->$sAction();

	    $this->view->addData('header',$this->header);
        $this->view->addData('content', $this->content);
	    $this->view->generate();
    }
}
