<div class="content grid">
    <div class='bread-crumbs'>
        <p>
           <a href='/frontend'>СПИСОК КАТЕГОРИЙ > </a>
           <a href='/frontend/goods/goods?category_id=<?=$Data['category']['category_id']?>'><?=mb_strtoupper($Data['category']['category_name'])?> </a>>
           <a href='/frontend/goods/goodcard?good_id=<?=$Data['good']['good_id']?>&category_id=<?=$Data['category']['category_id']?>'> <?=mb_strtoupper($Data['good']['good_name'])?></a>
        </p>
    </div>
    <content class='goodcard grid'>
        <div class="title">
            <p><?=$Data['good']['good_name']?></p>
        </div>
        <div class="good-description">
            <p><?=$Data['good']['good_description']?></p>
        </div>
        <div class="good-fool-description">
            <p><?=$Data['good']['good_full_description']?></p>
        </div>
        <div class="good-quantity-instock">
            <p>Количество на складе: <span><?=$Data['good']['good_quantity_instock']?></span></p>
        </div>
        <?php
            if($Data['good']['good_quantity_instock'] == 0) {
                if(($Data['good']['good_is_available_for_order'] == 1)) {
                    $goodId = $Data['good']['good_id'];
                    $uri = $_SERVER['REQUEST_URI'];
                    $form = "<form class='order-form' method='post' action='$uri'>".
                            "<input class='field' type='text' name='quantity' placeholder='Введите количество...' autofocus>".
                            "<input class='field-submit' type='submit' value='ЗАКАЗАТЬ'>".
                            "</form>";
                    echo $form;
                } else {
                    echo "Дозаказ товара невозможен.";
                }
            }
        ?>
        <p>Посмотреть этот товар в других категориях:</p>
        <?foreach ($Data['available_categories'] as $item):?>
            <p class='link'><a href="/frontend/goods?category_id=<?=$item['category_id']?>"><?=$item['category_name']?></a></p>
        <?endforeach?>
    </content>
</div>