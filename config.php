<?php

require 'vendor/autoload.php';

// Configuration du serveur Redis
$redisConfig = [
    'scheme' => 'tcp',
    'host' => 'redis-18075.c302.asia-northeast1-1.gce.cloud.redislabs.com',
    'port' => 18075,
    'password' => 'X2y4ohpGu7wWMULifYfnk0uEFOORQaa9',
];

// Connexion à Redis
$redis = new Predis\Client([
    'scheme' => $redisConfig['scheme'],
    'host' => $redisConfig['host'],
    'port' => $redisConfig['port'],
    'password' => $redisConfig['password'],
]);

// Test de connexion à la base de données
try {
    // Tentative de connexion à Redis
    $redis->connect();

    // Authentification si un mot de passe est défini
    if (!empty($redisConfig['password'])) {
        $redis->auth($redisConfig['password']);
    }

    echo "Connexion à Redis réussie!";
} catch (Predis\Connection\ConnectionException $e) {
    // Gestion de l'erreur de connexion
    echo "Erreur de connexion à Redis : " . $e->getMessage();
} catch (Predis\Response\ServerException $e) {
    // Gestion de l'erreur d'authentification
    echo "Erreur d'authentification Redis : " . $e->getMessage();
} catch (Exception $e) {
    // Gestion d'autres exceptions
    echo "Une erreur s'est produite : " . $e->getMessage();
}

?>
