<?php
session_start();
include ("User.php");
highlight_file(__FILE__);
try {
    // ---------------Connexion à la BDD et récupération et traitement du formulaire
    $pdo = new PDO('mysql:host=192.168.65.193;dbname=Combat', 'UserWeb', 'UserWeb');
} catch (Exception  $error) {
    $error->getMessage();
}

//pour éviter les redirections vers cette page 
//je ferais un include là ou j'en ai besoin
$User1 = new User(null,$pdo);

if(isset($_POST["btnConnexion"])){
    $User1->seConnecter($_POST["login"],$_POST["mdp"]);
}
if(!$User1->isConnect()){
    ?>
    <form action="" method="post" >    
        <label for="login">login: </label>
        <input type="text" name="login" id="login" required value="Julien">

        <label for="vie">mdp: </label>
        <input type="password" name="mdp" id="mdp" required value="1234">

        <input type="submit" name="btnConnexion" value="Connect toi">
    </form>
<?php 
}else{
    $User1->getUserByID($_SESSION['idUser']);
    $User1->afficheUser();
    ?>
     <li><a href="CRUD_Create.php">Creer un Personnage</a></li>
    <?php
}
?>