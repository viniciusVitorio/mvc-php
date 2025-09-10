<?php
namespace src\Infra;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

class EntityManagerFactory {
    public static function create(): \Doctrine\ORM\EntityManagerInterface {
        $root = dirname(__DIR__, 2);
        if (is_file($root.'/.env')) {
            Dotenv::createImmutable($root)->load();
        }

        $isDev = (($_ENV['APP_ENV'] ?? 'dev') === 'dev');

        $config = ORMSetup::createAttributeMetadataConfiguration(
            [__DIR__.'/../Domain/Entity'],
            $isDev
        );

        $conn = [
            'driver'   => $_ENV['DB_DRIVER'] ?? 'pdo_pgsql',
            'host'     => $_ENV['DB_HOST'] ?? 'db',
            'port'     => (int)($_ENV['DB_PORT'] ?? 5432),
            'dbname'   => $_ENV['DB_NAME'] ?? 'app_db',
            'user'     => $_ENV['DB_USER'] ?? 'app_user',
            'password' => $_ENV['DB_PASS'] ?? 'app_pass',
        ];

        return EntityManager::create($conn, $config);
    }
}
