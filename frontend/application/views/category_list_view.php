<div class="content grid">    
    <div class='bread-crumbs grid'>
        <p><a href='/frontend'>СПИСОК КАТЕГОРИЙ </a>> </p>
    </div>
    <div class='cards grid user-category-card-height'>   
        <?foreach ($Data['records'] as $item):?>
            <div class='card'>
                <div class="input-container">
                    <div class='name user-card-name-background'>
                        <p><?=$item['category_name']?></p>
                    </div>
                    <div class='description border-bottom'>
                        <p><?=$item['category_description']?></p>
                    </div>
                     <div class='full-description border-bottom'>
                        <p>Описание:</p>
                        <p><?=$item['category_full_description']?></p>
                    </div>
                    <p class='link'><a href='goods?category_id=<?=$item['category_id']?>&page=1'>Посмотреть товары</a></p>
                </div>
            </div>
        <?endforeach?>
    </div>
    <div class='pagination grid'>
        <div class='pages'>
            <?= showPagination($Data['pagination'], $Data['currentPage']); ?> 
        </div>
    </div>
</div>