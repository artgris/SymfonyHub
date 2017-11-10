# SymfonyHub
Testing Symfony Bundles and Components | Adding Services and Twig demos

Bundles list
------------

        "arkounay/image-bundle": "^2.0",
        "arkounay/block-bundle": "^1.2",
        "knplabs/knp-paginator-bundle": "^2.5",
        "knplabs/knp-snappy-bundle": "~1.4",
        "misd/phone-number-bundle": "^1.2",
        "gregwar/image-bundle": "dev-master",
        "knplabs/knp-menu-bundle": "^2.1",
        "artgris/version-checker-bundle": "^1.0",
        "artgris/interactive-svg-bundle": "^0.1.0",
        "friendsofsymfony/user-bundle": "~2.0@dev",
        "symfony/assetic-bundle": "^2.8",
        "whiteoctober/breadcrumbs-bundle": "^1.2",
        "stof/doctrine-extensions-bundle": "^1.2",
        "artgris/maintenance-bundle": "^1.0",
        "liuggio/excelbundle": "^2.1",

        # i18n
        "jms/translation-bundle": "dev-master",
        "jms/di-extra-bundle": "dev-master",
        "jms/i18n-routing-bundle": "dev-master",
        "a2lix/translation-form-bundle": "2.*",
        "knplabs/doctrine-behaviors": "~1.1",

Requirements
------------

  * PDO-SQLite PHP extension enabled
  
        sudo apt-get install php7.0-sqlite3
        sudo service apache2 restart
  
  * wkhtmltopdf and wkhtmltoimage
        wget https://downloads.wkhtmltopdf.org/0.12/0.12.4/**
        tar -xvf wkhtmltox-0.12.4_linux-generic-**       
        ln wkhtmltox/bin/wkhtmltopdf /usr/local/bin/wkhtmltopdf
        ln wkhtmltox/bin/wkhtmltoimage /usr/local/bin/wkhtmltoimage
        
Global Commands
---------------

  * Run the extraction process

        php bin/console translation:extract en --config=app
    
  * Loading Fixtures
  
        php bin/console doctrine:fixtures:load
