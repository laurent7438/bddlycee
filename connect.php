<?php 
try{

    $db = new PDO('mysql:host=localhost;dbname=lycée', 'root', '');
    $db->exec('SET NAMES UTF8');

} catch (PDOException $e){
    echo 'Erreur :'. $e->getMessage();
    die();
}
?>