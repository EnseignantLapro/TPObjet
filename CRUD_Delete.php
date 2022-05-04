
<?php include ("Personnage.php");
highlight_file(__FILE__);

try {
    // ---------------Connexion à la BDD et récupération et traitement du formulaire
    $pdo = new PDO('mysql:host=192.168.65.193;dbname=Combat', 'UserWeb', 'UserWeb');
} catch (Exception  $error) {
    $error->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>CRUD</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <h1> CRUD De Personnage </h1>
    <h2>(SQL Delete) </h2>
    <h3>Choix du perso à supprimer</h3>

    <?php
    $Perso1 = new Personnage(null,null,null,null,$pdo,null,null);
    //Traitetement du formulaire du choix du perso
    if(isset($_GET['btnSupprimer'])){
        $Perso1->getPersonnageById($_GET['idCombatant']);
        $Perso1->delete();
    }

    //--------------------Choix Perso-------------
    $tabPersonnage = $Perso1->getAllPersonnage();
    ?>
    <form action="" method="get">
        <select id="idCombatant" name="idCombatant">
            <?php
            foreach ($tabPersonnage as  $ThePerso) {
                echo '<option value="'.$ThePerso->getId().'">'.$ThePerso->getPseudo().'</option>';
            }
            ?>
        </select>
        <input type="submit" value="Supprimer ce perso" name="btnSupprimer">
    </form>

    <?php
    //Formulaire HTML de modification -------------------------------------
    //je dois avoir $id,$pseudo,$vie,$forceAttaque,$pdo,$image
    // id sera caché car il est utilisé pour la condition where de l'update
    ?>
 

    <?php 
    $tabPersonnage = $Perso1->getAllPersonnage();
    echo "<ul>";
    foreach ($tabPersonnage as $Perso) {
        echo "<li>";
        echo $Perso->getPseudo();
        echo '<img width="100px" src="'.$Perso->getImage().'" alt="'.$Perso->getPseudo().'">';
        echo "</li>";
    }
    echo "</ul>";     
    ?>
  
</body>
</html>