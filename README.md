# マカルーデジタル PHPエンジニア 採用試験 人口データ管理システム


## インストール方法

Follow these steps to get your development environment set up:

### 前提条件

インストールする前に、以下のツールが必要です：

PHP >= 8.x

Composer

Laravel >= 11.x

MySQLのデータベース

### インストール手順

1. リポジトリをクローンします：
```
git clone https://github.com/Forzyr/marcareux-test.git
```

2. プロジェクトのディレクトリに移動します：
```
cd marcareux-test
```

3. Composerで依存関係をインストールします：
```
composer install
```

4. .envファイルを作成します：
```
cp .env.example .env
```

5. .env ファイル内でデータベースの設定を行います：
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
6. データベースのマイグレーションを実行します：
```
php artisan migrate
```

7. アプリケーションを起動します：
```
php artisan serve
```

アプリケーションに http://localhost:8000 でアクセスできます。

## 使用方法

### 人口データのアップロード:

1. https://www.e-stat.go.jp/stat-search/files?tclass=000001041653&cycle=7&year=20220 から「年次・都道府県・性別人口」の CSV データをダウンロードします。

2. http://localhost:8000/import でCSVのデータを取り込みます。

### 人口データ表示:

http://localhost:8000/ でデータを表示します。

### 検索:

年や都道府県でデータを検索できます。
