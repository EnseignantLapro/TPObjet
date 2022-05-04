<?php include ("User.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    
<?php echo "<h1>Menu Exo</h1>"; ?>
<ul>    
    <li><a href="Exo1.php">Exo1</a></li>
    <li><a href="Exo2.php">Exo2</a></li>
    <li><a href="Exo3.php">Exo3</a></li>
    <li><a href="Exo4.php">Exo4</a></li>
    <li><a href="Exo5.php">Exo45 Alliance Personnage</a></li>
    <li><a href="ExoJS.php">ExoJS</a></li>
    <li><a href="testAPI.php">TestAPI</a></li>
    
    <li><a href="CRUD_Read.php">CRUD Objet Read</a></li>
    <li><a href="CRUD_Create.php">CRUD Objet Create</a></li>
    <li><a href="CRUD_Update.php">CRUD Objet Update</a></li>
    <li><a href="CRUD_Delete.php">CRUD Objet Delete</a></li>
    <li><a href="Connexion.php">Page De Connexion</a></li>
   
   



</ul>


        <?php echo "<h1>Test de la class USER</h1>"; ?>

        <form action="" method="Post">
            Login<input type="text" name="login">
            mdp<input type="text" name="mdp">
            <input type="submit" name="connexion" value="ok">
        </form>

        <?php
        $TableauUser = array();
        try {
        
            $bdd = new PDO('mysql:host=192.168.65.193;dbname=filmnotation', 'UserWeb', 'UserWeb');
            $req = "SELECT * from User";
            $reponses = $bdd->query($req);
            while ($donnees = $reponses->fetch())
            {
                //ORM je met les infos du tuple ( issu de la bdd)
                //dans un nouvel objet User que je stock dans un tableau de user
                array_push($TableauUser,new User($donnees['id'],$donnees['login'],$donnees['mdp']));
            } 

        } catch (Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
        
       
        if(isset($_POST["connexion"])){

           //1) rechercher le bon user dans $TableauUser
            $trouve = false;
            foreach ($TableauUser as  $TheUser) {
                //si le user du formulaire = le nom d'un user dans la liste alors on vérifi mdp
                if($TheUser->getNom()==$_POST['login']){
                    $trouve = true;
                    //2) Vérifier le mdp
                    //on va vérifier le mdp du formulaire avec celui de user trouvé
                    if($TheUser->seConnecter($_POST['mdp'])){
                        ?>
                        <h2>Vous etes connect</h2>
                        <?php
                    }else{
                        ?>
                        <h2>Mauvais Mot de passe</h2>
                        <?php
                    }
                }
            }
            if(!$trouve){
                echo "User Inconnu vérifier othographe";
            }
        }
        highlight_file(__FILE__);
        ?>
    </h1>
</body>
</html>

