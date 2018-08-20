<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/frontend/css/style.css">
    <title>Каталог товаров</title>
</head>
<body>
    <container class='wrapper grid'>
        <header class='header'>
            <a class='logo' href="/frontend"><img src="/frontend/images/logo.png" alt=""></a>
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