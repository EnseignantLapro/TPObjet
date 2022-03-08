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
    
        <?php echo "<h1>Test de la class USER</h1>"; ?>

        <form action="" method="Post">
            Login<input type="text" name="login">
            mdp<input type="text" name="mdp">
            <input type="submit" name="connexion" value="ok">
        </form>


        <?php
        
        //ici on creer plein de faux User 
        //mais en vrai ils sont en BDD
        $U1 = new User("toto","1234");
        $U2 = new User("titi","abcd");
        $U3 = new User("tata","2345");
        $U4 = new User("tutu","34567");
        $U5 = new User("tete","abcd");

        $TableauUser = array();

        array_push($TableauUser,$U1);
        array_push($TableauUser,$U2);
        array_push($TableauUser,$U3);
        array_push($TableauUser,$U4);
        array_push($TableauUser,$U5);
       
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

