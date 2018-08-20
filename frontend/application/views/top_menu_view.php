<?
/**
 * @var $aData
 */
?>
<ul class='top-menu'>
    <?foreach ($Data as $item):?>
        <li class='item'><a href="<?= $item['href'] ?>"><?= $item['title'] ?></a></li>
    <?endforeach?>
</ul>