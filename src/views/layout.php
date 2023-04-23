<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($title)) : echo $title . ' - ';
        endif; ?>丸亀ガチャ</title>
</head>
<body>
    <header>
        <a href="/">丸亀ガチャ</a>
    </header>
    <?php echo $responseBody; ?>
    <footer>
        <a href="/about">このサイトについて</a>
    </footer>
</body>


</html>
