    <form action="/" method="post">
        <div>
            <button type="submit" name="shuffle">ガチャを回す</button>
        </div>
        <div>
            <input type="radio" name="mode" value="1">天ぷらあり
            <input type="radio" name="mode" value="2" checked>うどんのみ
        </div>
    </form>
    <?php if (isset($_POST['shuffle'])) :?>
        <?php foreach ($results as $result) :?>
            <?php echo $result['name'];?>
        <?php endforeach;?>
    <?php endif;?>
