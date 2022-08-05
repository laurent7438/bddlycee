<?php

// on vérifie que l' id existe et n'est pas vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){

    // on vérifie si l'id existe
    require_once('connect.php');

    // On nettoie l'id envoyée par l'utilisateur
    $id = strip_tags($_GET['id']);

    // On crée la requête
    $sql = 'SELECT ex.id_etudiant, ex.note, et.prenom, et.nom FROM examens ex LEFT JOIN etudiants et ON ex.id_etudiant = et.id_etudiant WHERE ex.id_etudiant=:id;';
    // $sql = 'SELECT * FROM `mytable` WHERE `id` = :id;';

    // On prépare le requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètres (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On execute la requête
    $query->execute();

    // On récupère le produit, truc, la data
    $truc = $query->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elève</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" 
    crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Elève</h1>
                <p>ID :  <?= $truc[0]['id_etudiant'] ?></p>
                <p>Prénom :  <?= $truc[0]['prenom'] ?></p>
                <p>Nom :  <?= $truc[0]['nom'] ?></p>
                <p>Note math :  <?= $truc[0]['note'] ?></p>
                <p>Note geo :  <?= $truc[1]['note'] ?></p>
                <p><a href="index.php">Retour</a> <a href="edit.php?id=<?= $truc['id'] ?>">Modifier</a></p>   
            </section>
        </div>
    </main>
</body>
</html>