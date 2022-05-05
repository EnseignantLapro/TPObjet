
<?php include ("../../Classes/Arme.php");
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
    <h1> CRUD De Arme </h1>
    <h2>(SQL Delete) </h2>
    <h3>Choix du Arme à supprimer</h3>

    <?php
    $Arme1 = new Arme(null,null,null,null,$pdo,null,null);
    //Traitetement du formulaire du choix du Arme
    if(isset($_GET['btnSupprimer'])){
        $Arme1->getArmeById($_GET['idArme']);
        $Arme1->delete();
    }

    //--------------------Choix Arme-------------
    $tabArme = $Arme1->getAllArme();
    ?>
    <form action="" method="get">
        <select id="idArme" name="idArme">
            <?php
            foreach ($tabArme as  $TheArme) {
                echo '<option value="'.$TheArme->getId().'">'.$TheArme->getnom().'</option>';
            }
            ?>
        </select>
        <input type="submit" value="Supprimer ce Arme" name="btnSupprimer">
    </form>

    <?php
    //Formulaire HTML de modification -------------------------------------
    //je dois avoir $id,$nom,$vie,$forceAttaque,$pdo,$image
    // id sera caché car il est utilisé pour la condition where de l'update
    ?>
 

    <?php 
    $tabArme = $Arme1->getAllArme();
    echo "<ul>";
    foreach ($tabArme as $Arme) {
        echo "<li>";
        echo $Arme->getnom();
        echo '<img width="100px" src="'.$Arme->getImage().'" alt="'.$Arme->getnom().'">';
        echo "</li>";
    }
    echo "</ul>";     
    ?>
  
</body>
</html>