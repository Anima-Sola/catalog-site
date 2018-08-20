<?php


class GoodsController extends Controller
{
    
    function parseParams($params)
    {
        $sAction = 'actionGoodsList';
        
        if (isset($params[3]) && ($params[3] == 'goodcard')){
            $sAction = 'actionGoodCard';
        }

        if (method_exists($this, $sAction))
            $this->action = $sAction;
        else
            throw (new Exception('No such action'));
    }
  
    public function actionGoodsList()
    {
        $_SESSION['who'] = 'user';
        $this->header[] = new makeView(new TopMenuModel(),'top_menu_view.php');
        $this->content[] = new makeView(new GoodListModel(),'good_list_view.php');
    }
    
    
    public function actionGoodCard()
    {
        $_SESSION['who'] = 'user';
        $this->header[] = new makeView(new TopMenuModel(),'top_menu_view.php');
        $this->content[] = new makeView(new GoodCardModel(),'good_card_view.php');
    }

}