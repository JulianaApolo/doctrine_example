<?php
require_once(realpath(sprintf("%s/../../vendor/autoload.php", __DIR__)));

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use \Doctrine\DBAL\DriverManager;

$paths = array("src/models");
$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'doctrine',
    'dbname'   => 'dev_doctrine',
    'host'     => 'doctrine_db_server',
    'port'     => '3306'
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
$entityManager = EntityManager::create($dbParams, $config);

$dotenv = new Dotenv\Dotenv(realpath(sprintf("%s/../../", __DIR__)));
$dotenv->load();
