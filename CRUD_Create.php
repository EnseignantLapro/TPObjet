
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
    <title>Exo1</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <h1> CRUD De Personnage </h1>
    <h2>(CREATE Insert) </h2>
    <?php
        //Traitetement du formulaire
        if(isset($_POST['btnValider'])){
            $Perso1 = new Personnage(
                null, //id
                $_POST['pseudo'],
                $_POST['vie'],
                $_POST['forceAttaque'],
                $pdo,
                $_POST['image']);

            $Perso1->saveInBdd(); //voir la méthode saveInBdd dans l'objet Personnage
        }
        
        //Formulaire HTML
        //je dois avoir $id,$pseudo,$vie,$forceAttaque,$pdo,$image
        // id sera null car il n'est pas encore en BDD
        ?>

        <form action="" method="post" >
      
            <label for="pseudo">Pseudo: </label>
            <input type="text" name="pseudo" id="pseudo" required value="Perso1">

            <label for="vie">Vie: </label>
            <input type="text" name="vie" id="vie" required value="100">

            <label for="forceAttaque">Attaques: </label>
            <input type="text" name="forceAttaque" id="forceAttaque" value="15" required>
      
            <label for="image">Lien Image: </label>
            <input type="text" name="image" id="image" required value="https://resize-gulli.jnsmedia.fr/r/890,__ym__/img//var/jeunesse/storage/images/gulli/quoi-d-neuf/cine-dvd/les-minions/personnages/kevin/26343313-1-fre-FR/Kevin.jpg">
       
            <input type="submit" name="btnValider" value="Creer le Personnage">
        
        </form>


        <?php
        
       //--------------------READ-------------
        $Perso1 = new Personnage(null,null,null,null,$pdo,null);
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