<?php

// on inclut la connexion à la base
require_once('connect.php');
// On vérifie que le contenu de la requête n'est pas vide
if(isset($_GET['s']) && !empty($_GET['s'])){

    // On le stocke dans une variable en évitant l'injection de html
    $recherche = strip_tags($_GET['s']);

    // On écrit la requête
    $sql = 'SELECT ex.id_etudiant, ex.note, et.prenom, et.nom 
    FROM examens ex LEFT JOIN etudiants et ON ex.id_etudiant = et.id_etudiant 
    WHERE `nom` LIKE "%'.$recherche.'%" OR `prenom` LIKE "%'.$recherche.'%" 
    ORDER BY id_etudiant DESC;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On exécute la requête
    $query->execute();

    // On stocke le résultat dans un tableau associatif
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($results);
    
    
    $total = [];
    foreach($results as $key => $result){
        $i = $key;
        var_dump($i);
        var_dump($result['id_etudiant']);
        

            if($i['id_etudiant'] === $result['id_etudiant']){
                array_push($results[$key], $result['note']);
                var_dump($total);
        }
    }
    var_dump($results);


require_once('close.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher des élèves</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" 
    crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <form action="" method="get">
                <input type="search" name="s" placeholder="Rechercher un client">
                <input type="submit" name="envoyer" value="envoyer">
            </form>
            <section class="col-12">
                <h1>Liste des clients élèves</h1>
                <table class="table">
                    <thead>
                        <th>Nom : </th>
                        <th>Prénom : </th>
                        <th>Note math : </th>
                        <th>Note géo : </th>
                    </thead>
                    <tbody>
                        <?php
                        if(!empty($results)){
                        foreach($results as $result){
                        ?>
                            <tr>
                                <td><?= $result['nom'] ?></td>
                                <td><?= $result['prenom'] ?></td>
                                <td><?= $result['note'] ?></td>
                                <td><?= $result['note'] ?></td>
                            </tr>
                        <?php
                        }}
                        ?>
                    </tbody>
                </table>
                <a href="index.php" class="btn btn-primary">Retour à la liste</a>
            </section>
        </div>
    </main>
</body>
</html>