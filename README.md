# vk-sample-blocks-plugin
社内勉強会用。複数のブロックを持つプラグインの設計について考える

# 環境構築
```
$ npm install
$ npm run build
```

# ディレクトリ構成
+ /build  ... ビルドで生成
+ /inc ... 実装するPHPコード
+ /lib ... 汎用的に使えるクラス群
+ /src ... ブロック毎のJS

# コーディングの時に気をつけること。
- コンストラクタに Wordpress関数をかかない。インスタンス化してもWordPressとは接続しない。
- `add_filter` や `add_action` などのフックは `register()` というメソッドから呼び出す。
- グローバル関数は極力使わない。たとえばBlock内からプラグインのバージョンを調べるには、`$this->plugin->get_version();` でいける。
