<?php 
    require_once('connect.php');

    $sql = 'SELECT `etu`.`id_etudiant`, `etu`.`prenom`, `etu`.`nom`, `exa`.`note` 
    FROM `etudiants` as `etu` LEFT OUTER JOIN `examens` as `exa` 
    ON `exa`.`id_etudiant` = `etu`.`id_etudiant` where `exa`.`id_examen`=87 
    ORDER BY `etu`.`id_etudiant`';

    $query = $db->prepare($sql);

    $query->execute();

    $resultsMath = $query->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($resultsMath);
    
    $sql = 'SELECT `etu`.`id_etudiant`, `etu`.`prenom`, `etu`.`nom`, `exa`.`note` 
    FROM `etudiants` as `etu` LEFT OUTER JOIN `examens` as `exa` 
    ON `exa`.`id_etudiant` = `etu`.`id_etudiant` where `exa`.`id_examen`=45
    ORDER BY `etu`.`id_etudiant`';

    $query = $db->prepare($sql);

    $query->execute();

    $resultsGeo = $query->fetchAll(PDO::FETCH_ASSOC);


    foreach($resultsMath as $key => $value){

        foreach($resultsGeo as $value2){
            if($value['id_etudiant'] === $value2['id_etudiant']){
                array_push($resultsMath[$key], $value2['note']);
            }               
        }
    }
    



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" 
    crossorigin="anonymous">
</head>
<body>
<main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Liste des étudiants</h1>
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Note math</th>
                        <th>Note géo</th>
                    </thead>
                    <tbody>
                        
                        <?php
                        foreach($resultsMath as $mathe){
                        ?>
                            <tr>
                                <td><?= $mathe['id_etudiant'] ?></td>
                                <td><?= $mathe['prenom'] ?></td>
                                <td><?= $mathe['nom'] ?></td>
                                <td><?= $mathe['note'] ?></td>
                                <td><?= $mathe['0'] ?></td>
                                <td>
                                <a href="details.php?id=<?= $mathe['id_etudiant'] ?>">Voir</a>
                                <a href="edit.php?id=<?= $mathe['id_etudiant'] ?>">Modifier</a>
                                <a href="delete.php?id=<?= $mathe['id_etudiant'] ?>">Supprimer</a>
                            </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <a href="add.php" class="btn btn-primary">Ajouter un élève</a>
                <a href="search.php" class="btn btn-primary">Effectuer une recherche</a>
            </section>
        </div>
    </main>
</body>
</html>
