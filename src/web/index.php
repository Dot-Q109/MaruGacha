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
// TODO:エラー処理の設計を考え、アプリケーション内で発生した汎用的な例外をすべてcatchする
$app = new Application();
$app->run();
