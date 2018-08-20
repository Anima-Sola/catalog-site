<?php

class Page404Controller extends Controller
{
    function parseParams($params)
    {
        $this->action = "actionPage404";
    }
    
    public function actionPage404()
    {
        $this->header[] = new makeView(new TopMenuModel(),'top_menu_view.php');
        $this->content[] = new makeView(new Page404Model(),'404_view.php');
    }
}