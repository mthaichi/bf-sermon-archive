<?php

spl_autoload_register(function ($class) {

    // 名前空間に "_" がある場合は、"-" に変換してディレクトリ名にする
    $namespaceParts = explode('\\', $class);
    $transformedNamespaceParts = array_map(function ($part) {
        $part = preg_replace("/([a-z])([A-Z])/", "$1-$2", $part);
        return strtolower(str_replace('_', '-', $part));
    }, $namespaceParts);

    // ディレクトリ名はすべて小文字にする
    $filePath = implode('/', $transformedNamespaceParts);

    // ファイル名に "class-" プレフィックスを追加する
    $filePath_class = dirname($filePath) . '/class-' . basename($filePath) . '.php';
    $filePath_trait = dirname($filePath) . '/trait-' . basename($filePath) . '.php';

    // inc/ディレクトリをベースディレクトリに設定する
    $filePath_class = dirname(__FILE__) . '/inc/' . $filePath_class;
    $filePath_trait = dirname(__FILE__) . '/inc/' . $filePath_trait;

    if (file_exists($filePath_class)) {   
        require_once $filePath_class;
    } elseif (file_exists($filePath_trait)) {   
        require_once $filePath_trait;
     }
});
