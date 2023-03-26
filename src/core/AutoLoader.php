<?php

/**
 * 指定されたディレクトリのクラスファイルを読み込むオートロードクラスです。
 */
class AutoLoader
{
    /* @var array<string> */
    private array $classSearchDirs = [];

    /**
     * クラスをオートロードします。
     *
     * @return void
     */
    public function register()
    {
        spl_autoload_register([$this, 'loadClass']);
    }

    /**
     * クラスファイル検索ディレクトリを追加します。
     *
     * @param string $classSearchDir
     *
     * @return void
     */
    public function registerDir(string $classSearchDir)
    {
        $this->classSearchDirs[] = $classSearchDir;
    }

    /**
     * ディレクトリを順番に検索し、引数で指定されたクラスファイルを読み込みます。
     * この関数はregisterメソッドで呼び出しています。
     *
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     *
     * @param string $className 読み込むクラスファイル
     *
     * @return void
     */
    private function loadClass(string $className)
    {
        foreach ($this->classSearchDirs as $classSearchDir) {
            $file = $classSearchDir . '/' . $className . '.php';
            if (is_readable($file)) {
                require $file;
                return;
            }
        }
    }
}
