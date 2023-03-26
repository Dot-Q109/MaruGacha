<?php

/**
 * index.phpから自動的に読み込まれ、AutoLoaderを実行します。
 */

require 'core/AutoLoader.php';

$loader = new AutoLoader();
$loader->registerDir(__DIR__ . '/core');
$loader->registerDir(__DIR__ . '/controller');
$loader->registerDir(__DIR__ . '/models');
$loader->register();
