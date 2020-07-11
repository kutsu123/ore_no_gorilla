# My Snow Monkey

子テーマの `functions.php` にカスタマイズコードを追加するように、このプラグインの `my-snow-monkey.php` に書くと、同じようにカスタマイズが反映されます。

## SCSSのコンパイル方法
当プラグインディレクトリーまで移動したあと、
- yarn でpackegeをインストール（ npm i と同じ意味のコマンド）
- yarn watchでSCSSファイルの修正を常時監視（SCSSを修正したら即時CSSにコンパイルしてくれる）
- yarn cssでCSSにコンパイル（コマンド走ったときだけCSSをコンパイル）