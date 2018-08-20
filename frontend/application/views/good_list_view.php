<div class="content grid">    
    <div class='bread-crumbs'>
        <p>
            <a href='/frontend'>СПИСОК КАТЕГОРИЙ </a>>
            <a href='/frontend/goods?category_id=<?=$Data['category']['category_id']?>'> <?=mb_strtoupper($Data['category']['category_name'])?></a>
        </p>
    </div>
    <content class='cards grid user-good-card-height'>   
        <?foreach ($Data['records'] as $item):?>
            <div class='card'>
                <div class="input-container">
                    <div class='name user-card-name-background'>
                        <p><?=$item['good_name']?></p>
                    </div>
                    <div class='description border-bottom'>
                        <p><?=$item['good_description']?></p>
                    </div>
                     <div class='full-description border-bottom'>
                        <p>Описание:</p>
                        <p><?=$item['good_full_description']?></p>
                    </div>
                    <div class='quantity border-bottom'>
                        <p>Количество на складе: <span><?=$item['good_quantity_instock']?></span></p>
                        <?php
                            if($item['good_quantity_instock'] == 0) {
                                if(($item['good_is_available_for_order'] == 1)) 
                                    echo "<p><span>Товар можно дозаказать</span></p>";
                                else 
                                    echo "<p><span>Дозаказ товара невозможен</span></p>";
                            } else
                                echo "<br>";
                        ?> 
                    </div>
                    <p class='link'><a href='/frontend/goods/goodcard?good_id=<?=$item['good_id']?>&category_id=<?=$item['category_id']?>'>Посмотреть описание</a></p>
                </div>
            </div>
        <?endforeach?>
    </content>
    <div class='pagination grid'>
        <div class='pages'>
            <?= showPagination($Data['pagination'], $Data['currentPage']); ?> 
        </div>
    </div>
</div>