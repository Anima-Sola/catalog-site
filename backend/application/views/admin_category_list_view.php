<div class="admin-content grid">
    <?php
        if(isset($_POST['category_id'])) { 
            echo "<script>alert('Изменения внесены успешно')</script>";
            if($_POST['category_id'] == '-1') {
                $href = end($Data['pagination']);
                echo "<script> window.location.replace('?page=$href'); </script>";
            }
        }
    ?>
    <div class='bread-crumbs grid grid'>
        <p><a href='/backend'>СПИСОК КАТЕГОРИЙ </a>> </p>
    </div>
    <form class="search grid" method='get' action='<?= $_SERVER['REQUEST_URI'].'goods' ?>' onsubmit="return checkInputFields(this);">
        <input type="hidden" name="is_search" value="true">
        <div><input type="text" name="s_good_name" placeholder="Название товара..."></div>  
        <div><input type="text" name="s_good_description" placeholder="Описание товара..."></div>
        <div><input type="text" name="s_good_full_description" placeholder="Полное описание товара..."></div>
        <div><input type="text" name="s_good_quantity_instock_from" placeholder="Количество на складе от..."></div>
        <div><input type="text" name="s_good_quantity_instock_to" placeholder="Количество на складе до..."></div>
        <div><input type="checkbox" name="s_good_activity" checked>Товар активен</div> 
        <div><input type="checkbox" name="s_good_is_available_for_order" checked>Товар доступен для дозаказа</div> 
        <div><input type="submit" value="ИСКАТЬ"></div>
    </form>
    <content class='cards grid admin-category-card-height'>   
        <?php 
            $currentPage = (isset($_GET['page'])) ? $_GET['page'] : 1; 
            if($currentPage == 1) { 
        ?>
        <form class='card admin-add-card-background' method='post' action='<?= $_SERVER['REQUEST_URI'] ?>'>
            <div class="input-container">
                <input type="hidden" name="category_id" value="-1">
                <p>Создать категорию:</p>
                <div class="name">
                    <input type="text" name="category_name" placeholder="Название категории..." value="" onfocus="showSubmit(-1);" onblur="hideSubmit(-1);" autofocus>
                </div>
                <div class="description">
                    <input type="text" name="category_description" placeholder="Описание категории..." value="" onfocus="showSubmit(-1);" onblur="hideSubmit(-1);">
                </div>
                <div class="full-description">
                    <textarea name="category_full_description" placeholder="Введите подробное описание..." onfocus="showSubmit(-1);" onblur="hideSubmit(-1);"></textarea>
                </div>
                <div class="activity">
                    <input type="checkbox" name="category_activity" value='1' onfocus="showSubmit(-1);" onblur="hideSubmit(-1);" checked>Категория активна
                </div>
                <div id="submit_btn_-1" class="submit hidden-element">
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
                    <input type="hidden" name="category_id" value="<?= $item['category_id'] ?>">
                    <p>Редактировать категорию:</p>
                    <div class="name">
                        <input type="text" name="category_name" placeholder="Название категории..." value="<?= $item['category_name'] ?>"  onfocus="showSubmit(<?= $item['category_id'] ?>);" onblur="hideSubmit(<?= $item['category_id'] ?>);" autofocus>
                    </div>
                    <div class="description">
                        <input type="text" name="category_description" placeholder="Описание категории..." value="<?=$item['category_description']?>" onfocus="showSubmit(<?= $item['category_id'] ?>);" onblur="hideSubmit(<?= $item['category_id'] ?>);">
                    </div>
                    <div class="full-description">
                        <textarea name="category_full_description" placeholder="Введите подробное описание..." onfocus="showSubmit(<?= $item['category_id'] ?>);" onblur="hideSubmit(<?= $item['category_id'] ?>);"><?=$item['category_full_description']?></textarea>
                    </div>
                    <div class="activity">
                        <?php
                            $checked = '';
                            $categoryId = $item['category_id'];
                            $categoryActivity = $item['category_activity'];
                            if($categoryActivity == 1) $checked = 'checked';
                            echo "<input type='checkbox' name='category_activity' value='$categoryActivity' onfocus='showSubmit($categoryId);' onblur='hideSubmit($categoryId);' $checked>Категория активна";
                        ?>
                    </div>
                    <div id="submit_btn_<?= $item['category_id'] ?>" class="submit hidden-element">
                        <input type="submit" value="СОХРАНИТЬ ИЗМЕНЕНИЯ">
                    </div>
                    <p class='link'><a href='/backend/goods?category_id=<?=$item['category_id']?>&page=1'>Редактировать товары категории</a></p>
                </div>
            </form>
        <?endforeach?>
    </content>
    <div class='pagination grid'>
        <div class='pages'>
            <?= showPagination($Data['pagination'], $Data['currentPage']); ?> 
        </div>
    </div>
</div>