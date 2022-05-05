
<?php 
session_start();
include ("../../Classes/Arme.php");
include ("../../Classes/User.php");
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
    <h2>(CREATE Insert) </h2>
    <?php
        //vérification de la connexion
        $user1 = new User(null,$pdo);
        if(!$user1 -> isConnect()){
            ?>
            <li><a href="Connexion.php">Connect toi </a></li>
           <?php
        }else{
            $user1->afficheUser();
        }

        //Traitetement du formulaire
        if(isset($_POST['btnValider'])){
            //le nouveau Arme est créer avec sa relation 1N avec le User
            //en effet on rajoute id du User dans le Arme pour indiquer que c'est le Arme du user
            $Arme1 = new Arme(
                null, //id
                $_POST['nom'],
                $_POST['vie'],
                $_POST['forceAttaque'],
                $pdo,
                $_POST['image']
                );

            $Arme1->saveInBdd(); //voir la méthode saveInBdd dans l'objet Arme
        }
        
        //Formulaire HTML
        //je dois avoir $id,$nom,$vie,$forceAttaque,$pdo,$image
        // id sera null car il n'est pas encore en BDD
        ?>

        <form action="" method="post" >
      
            <label for="nom">nom: </label>
            <input type="text" name="nom" id="nom" required value="Arme1">

            <label for="vie">Vie: </label>
            <input type="text" name="vie" id="vie" required value="100">

            <label for="forceAttaque">Attaques: </label>
            <input type="text" name="forceAttaque" id="forceAttaque" value="15" required>
      
            <label for="image">Lien Image: </label>
            <input type="text" name="image" id="image" required value="https://resize-gulli.jnsmedia.fr/r/890,__ym__/img//var/jeunesse/storage/images/gulli/quoi-d-neuf/cine-dvd/les-minions/Armes/kevin/26343313-1-fre-FR/Kevin.jpg">
       
            <input type="submit" name="btnValider" value="Creer le Arme">
        
        </form>


        <?php
        
       //--------------------READ-------------
        $Arme1 = new Arme(null,null,null,null,$pdo,null,null);
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