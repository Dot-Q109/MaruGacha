<?php

/**
 * アプリケーションのエントリポイントです。
 * 必要なファイルを読み込み、アプリケーションを実行します。
 */

require '../bootstrap.php';
require '../Application.php';
require '../vendor/autoload.php';
$app = new Application();
$app->run();
