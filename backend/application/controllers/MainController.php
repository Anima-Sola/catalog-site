<?php


class MainController extends Controller
{
    
    function parseParams($params)
    {
        $this->action='actionIndex';
    }

    public function actionIndex()
    {
        $_SESSION['who'] = 'user';
        $this->header[] = new makeView(new TopMenuModel(),'top_menu_view.php');
        $this->content[] = new makeView(new CategoryAdminListModel(),'admin_category_list_view.php');
    }
}