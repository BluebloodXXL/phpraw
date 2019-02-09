<?php
/**
 * Created by PhpStorm.
 * User: duke90
 * Date: 1/3/2019
 * Time: 3:12 AM
 */

//---------------Must Not Use Any Space------------------
//$dsn = 'mysql:host=localhost;dbname=oophp';
//$dsn = 'mysql:host=localhost;dbname=oophp;port=3306';
$dsn = 'sqlite:C:/xampp/htdocs/phpraw/oophp/sqlite/oophp.db';

$db = new PDO($dsn, 'oophp', 'lynda');