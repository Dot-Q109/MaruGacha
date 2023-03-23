<?php

/**
 * 指定されたディレクトリのクラスファイルを読み込むオートロードクラスです。
 */
class AutoLoader
{
    /**
     * クラスファイルを検索するディレクトリを格納する配列
     *
     * @var array<string>
     */
    private $dirs;

    /**
     * オートロードを設定します。
     *
     * @return void
     */
    public function register()
    {
        spl_autoload_register([$this, 'loadClass']);
    }


    /**
     * ディレクトリを追加します。
     *
     * @param string $dir 追加するディレクトリのパス
     *
     * @return void
     */
    public function registerDir($dir)
    {
        $this->dirs[] = $dir;
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
    private function loadClass($className)
    {
        foreach ($this->dirs as $dir) {
            $file = $dir . '/' . $className . '.php';
            if (is_readable($file)) {
                require $file;
                return;
            }
        }
    }
}
