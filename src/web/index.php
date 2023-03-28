<?php

/**
 * アプリケーションのエントリポイントです。
 * 必要なファイルを読み込み、アプリケーションを実行します。
 */

// ファイルの読み込み
require '../bootstrap.php';
require '../Application.php';
require '../vendor/autoload.php';

// アプリケーションの実行
$app = new Application();
$app->run();
