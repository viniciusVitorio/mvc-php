<?php
require __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\Tools\SchemaTool;
use src\Infra\EntityManagerFactory; 

$entityManager = EntityManagerFactory::create();

$classes = $entityManager->getMetadataFactory()->getAllMetadata();

$tool = new SchemaTool($entityManager);

$tool->updateSchema($classes, true);

echo "Schema atualizado.\n";
