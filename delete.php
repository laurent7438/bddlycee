<?php

// on vérifie que l' id existe et n'est pas vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){

    // on vérifie si l'id existe
    require_once('connect.php');

    // On nettoie l'id envoyée par l'utilisateur
    $id = strip_tags($_GET['id']);

    // On crée la requête
    $sql = 'SELECT * FROM `etudiants` JOIN `examens` WHERE `id` = :id;';

    // On prépare le requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètres (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On execute la requête
    $query->execute();

    // On récupère le produit, truc, la data
    $truc = $query->fetch();
    // var_dump($truc);


    // On crée la requête             // ( ATTENTION un delete sans WHERE supprime tout)
    $sql = 'DELETE FROM `etudiants` JOIN `examens` WHERE `id` = :id;';

    // On prépare le requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètres (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On execute la requête
    $query->execute();
    header('location: index.php');
}

?>