<?php
    if($_POST) {
        if(isset($_POST['get_categories_by_good_id'])) {
            echo getCategories($_POST['get_categories_by_good_id']);
            unset($_POST);
            exit();
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <link rel="stylesheet" href="/backend/css/jquery.arcticmodal-0.3.css">
    <link rel="stylesheet" href="/backend/css/simple.css">
    <link rel="stylesheet" href="/backend/css/style.css">
    <script src="/backend/js/jquery-3.2.1.min.js"></script>
    <script src="/backend/js/jquery.arcticmodal-0.3.min.js"></script>
    <script src="/backend/js/myscript.js"></script>
    <title>Каталог товаров</title>
</head>
<body>
    <container class='wrapper grid'>
        <header class='header'>
            <a class='logo' href="/backend"><img src="/backend/images/logo.png" alt=""></a>
            <?foreach ($header as $item):?>
                <? $item->generate() ?>
            <?endforeach?>
        </header>
        <?foreach ($content as $item):?>
            <? $item->generate() ?>
        <?endforeach?>
        <footer class='footer grid'>
            <p>Copyright © 2018</p>
        </footer>
    </container>
</body>
</html>