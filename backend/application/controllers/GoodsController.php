<?php


class GoodsController extends Controller
{
    
    function parseParams($params)
    {
        $sAction='actionAdmin';
        
        if (isset($params[2]) && ($params[2] == 'goods')){
            $sAction = 'actionAdminEditGoods';
        }

        if (method_exists($this, $sAction))
            $this->action = $sAction;
        else
            throw (new Exception('No such action'));
    }

    public function actionAdmin()
    {
        $_SESSION['who'] = 'admin';
        $this->header[] = new makeView(new TopMenuModel(),'top_menu_view.php');
        $this->content[] = new makeView(new CategoryAdminListModel(),'admin_category_list_view.php');
    }
    
    public function actionAdminEditGoods()
    {
        $_SESSION['who'] = 'admin';
        $this->header[] = new makeView(new TopMenuModel(),'top_menu_view.php');
        $this->content[] = new makeView(new GoodAdminListModel(),'admin_good_list_view.php');
    }
}