# SymfonyHub
Testing Symfony Bundles and Components | Adding Services and Twig demos

Requirements
------------

  * PDO-SQLite PHP extension enabled
  
        sudo apt-get install php7.0-sqlite3
        sudo service apache2 restart
  
  * wkhtmltopdf and wkhtmltoimage

        wget http://download.gna.org/wkhtmltopdf/0.12/0.12.4/wkhtmltox-0.12.4_linux-generic-amd64.tar.xz
        tar -xvf wkhtmltox-0.12.4_linux-generic-amd64.tar.xz
        ln wkhtmltox/bin/wkhtmltopdf /usr/local/bin/wkhtmltopdf
        ln wkhtmltox/bin/wkhtmltoimage /usr/local/bin/wkhtmltoimage
        
Global Commands
---------------

  * Run the extraction process (transations)

        php bin/console translation:extract en --config=app
    
  * Loading Fixtures
  
        php bin/console doctrine:fixtures:load