<?php
    if(isset($_POST['good_id']) || isset($_POST['edit_catalog'])) { 
        echo "<script>alert('Изменения внесены успешно')</script>";
        if($_POST['good_id'] == '-1') {
            $lastPage = end($Data['pagination']);
            $categoryId = $Data['category']['category_id'];
            echo "<script> window.location.replace('?category_id=$categoryId&page=$lastPage'); </script>";
        }
    }
?>
<!--https://arcticlab.ru/arcticmodal/#docs-->
<div style="display: none;">
    <div class="box-modal" id="modalWindow">
    </div>
</div>
<div class="content grid">
    <div class='bread-crumbs'>
        <p>
            <a href='/backend'>СПИСОК КАТЕГОРИЙ </a>>
            <?php
                if(!(isset($_GET['is_search']))) {
            ?>
            <a href='/backend/goods?category_id=<?=$Data['category']['category_id']?>'> <?=mb_strtoupper($Data['category']['category_name'])?></a>
            <?php
                } else {
                    echo "РЕЗУЛЬТАТ ПОИСКА";
                }
            ?>
        </p>
    </div>
    <?php
        if($Data['not_found']) {
            echo "<p class='not-found'>Упс! Ничего не найдено</p>";
        } else {
    ?>
    <content class='cards grid admin-good-card-height'>
        <?php 
            $currentPage = (isset($_GET['page'])) ? $_GET['page'] : 1; 
            if($currentPage == 1  && !(isset($_GET['is_search']))) { 
        ?>
        <form class='card admin-add-card-background' method='post' action='<?= $_SERVER['REQUEST_URI'] ?>'>
            <div class="input-container">
                <input type="hidden" name="good_id" value="-1">
                <p>Добавить товар</p>
                <div class="name">
                    <input type="text" id="good_name_id_-1" name="good_name" placeholder="Название товара..." value="" onfocus="showSubmit(-1);" onblur="hideSubmit(-1);" autofocus>
                </div>
                <div class="description">
                    <input type="text" name="good_description" placeholder="Описание товара..." value="" onfocus="showSubmit(-1);" onblur="hideSubmit(-1);">
                </div>
                <div class="full-description">
                    <textarea name="good_full_description" placeholder="Введите подробное описание..." onfocus="showSubmit(-1);" onblur="hideSubmit(-1);"></textarea>
                </div>
                <div class="activity">
                    <input type="checkbox" name="good_activity" value='1' onfocus="showSubmit(-1);" onblur="hideSubmit(-1);" checked>Товар активен
                </div>
                <div class="available-for-order">
                    <input type='checkbox' name='good_is_available_for_order' value='1' onfocus="showSubmit(-1);" onblur="hideSubmit(-1);" checked>Товар доступен для дозаказа
                </div>
                <div class="quantity-instock">
                    <p>Количество на складе:</p>
                    <input type="text" name="good_quantity_instock" placeholder="Количество на складе..." value="0" onfocus="showSubmit(-1);" onblur="hideSubmit(-1);">
                </div>
                <div id="submit_btn_-1" class="submit hidden-element" >
                    <input type="submit" value="СОХРАНИТЬ ИЗМЕНЕНИЯ">
                </div>
            </div>
        </form>
        <?php
            };
        ?>
        <?foreach ($Data['records'] as $item):?>
            <form class='card admin-card-background' method='post' action='<?= $_SERVER['REQUEST_URI'] ?>'>
                <div class="input-container">
                    <input type="hidden" name="good_id" value="<?= $item['good_id'] ?>">
                    <p>Редактировать товар</p>
                    <div class="name">
                        <input type="text" id="good_name_id_<?= $item['good_id'] ?>" name="good_name" placeholder="Название категории..." value="<?= $item['good_name'] ?>" onfocus="showSubmit(<?= $item['good_id'] ?>);" onblur="hideSubmit(<?= $item['good_id'] ?>);" autofocus>
                    </div>
                    <div class="description">
                        <input type="text" name="good_description" placeholder="Описание категории..." value="<?=$item['good_description']?>" onfocus="showSubmit(<?= $item['good_id'] ?>);" onblur="hideSubmit(<?= $item['good_id'] ?>);">
                    </div>
                    <div class="full-description">
                        <textarea name="good_full_description" placeholder="Введите подробное описание..." onfocus="showSubmit(<?= $item['good_id'] ?>);" onblur="hideSubmit(<?= $item['good_id'] ?>);"><?=$item['good_full_description']?></textarea>
                    </div>
                    <div class="activity">
                        <?php
                            $checked = '';
                            $goodId = $item['good_id'];
                            $goodActivity = $item['good_activity'];
                            if($goodActivity == 1) $checked = 'checked';
                            echo "<input type='checkbox' name='good_activity' value='$goodActivity' onfocus='showSubmit($goodId);' onblur='hideSubmit($goodId);' $checked>Товар активен";
                        ?>
                    </div>
                    <div class="available-for-order">
                        <?php
                            $checked = '';
                            $goodId = $item['good_id'];
                            $goodAvailability = $item['good_is_available_for_order'];
                            if($goodAvailability == 1) $checked = 'checked';
                            echo "<input type='checkbox' name='good_is_available_for_order' value='$goodAvailability' onfocus='showSubmit($goodId);' onblur='hideSubmit($goodId);' $checked>Товар доступен для дозаказа";
                        ?>
                    </div>
                    <div class="quantity-instock">
                        <p>Количество на складе:</p>
                        <input type="text" name="good_quantity_instock" placeholder="Количество на складе..." value="<?= $item['good_quantity_instock'] ?>" onfocus="showSubmit(<?= $item['good_id'] ?>);" onblur="hideSubmit(<?= $item['good_id'] ?>);">
                    </div>
                    <div id="submit_btn_<?= $item['good_id'] ?>" class="submit hidden-element">
                        <input type="submit" value="СОХРАНИТЬ ИЗМЕНЕНИЯ">
                    </div>
                    <p id="edit_link_<?= $item['good_id'] ?>" class='link hidden-element'><a href='' onclick="return distributeGood(<?= $item['good_id'] ?>);">Распределить товар по категориям</a></p>
                </div>
            </form>    
        <?endforeach?>
    </content>
    <div class='pagination grid'>
        <div class='pages'>
            <?= showPagination($Data['pagination'], $Data['currentPage']); ?> 
        </div>
    </div>
    <?php
        }
    ?>
</div>