<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>丸亀ガチャ</title>
</head>

<body>
    <header>
        <a href="/">丸亀ガチャ</a>
    </header>
    <form action="/" method="post">
        <div>
            <button type="submit" name="shuffle">ガチャを回す</button>
        </div>
        <div>
            <input type="radio" name="mode" value="1">天ぷらあり
            <input type="radio" name="mode" value="2" checked>うどんのみ
        </div>
    </form>
    <?php if(isset($_POST['shuffle'])):?>
        <?php foreach($results as $result):?>
            <?php echo $result['name'];?>
        <?php endforeach;?>
    <?php endif;?>
    <footer>
        <a href="/about">このサイトについて</a>
    </footer>
</body>

</html>
