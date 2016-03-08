# CakePHP based CMS

[![Build Status](https://api.travis-ci.org/cakephp/app.png)](https://travis-ci.org/cakephp/app)
[![License](https://poser.pugx.org/cakephp/app/license.svg)](https://packagist.org/packages/cakephp/app)

Content management system created with [CakePHP](http://cakephp.org) 3.2.

This is an unstable repository and should be treated as an alpha.

##Instruction for enabling application on WAMP

1. Install ODBC Driver for SQL Server, if not already installed(http://www.microsoft.com/en-us/download/details.aspx?id=36434)
2. Install Microsoft Drivers for PHP for SQL Server, if not already installed(http://www.microsoft.com/en-us/download/details.aspx?id=20098) and unpack
them in PHP extension folder
3. Add 

    ```
    extension=php_pdo_sqlsrv_55_ts.dll
    extension=php_sqlsrv_55_ts.dll
    ```
in php.ini file located in main PHP folder and php.ini file located in Apache bin folder

4. Enable these extensions in WAMP tray
5. Go to php folder (by default) C:\wamp\bin\php\php{version}, copy all the files that looks like icu*.dll and paste them into the apache bin directory C:\wamp\bin\apache\apache{version}\bin
6. Add this  line to the httpd.conf file

    ```
    LoadModule rewrite_module modules/mod_rewrite.so
    ```

7. Also, httpd.conf file should look something like this:

    ```
    <Directory />
        Options FollowSymLinks
        AllowOverride All
        #AllowOverride none
        #Require all denied
    </Directory>
    ```


