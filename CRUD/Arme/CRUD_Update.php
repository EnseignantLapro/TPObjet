
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
    <h2>(SQL Update) </h2>
    <h3>Choix du Arme à modifier</h3>

    <?php
    $Arme1 = new Arme(null,null,null,null,$pdo,null,null);
    //Traitetement du formulaire du choix du Arme
    if(isset($_GET['btnModifier'])){
        $Arme1->getArmeById($_GET['idArme']);
    }

    if(isset($_POST['btnConfirmerUpdate'])){
        $Arme1 = new Arme(
            $_POST['idArme'], //viens du champ input type hidden
            $_POST['nom'],
            $_POST['vie'],
            $_POST['forceAttaque'],
            $pdo,
            $_POST['image']
        );
        $Arme1->saveInBdd(); //voir la méthode saveInBdd dans l'objet Arme
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
        <input type="submit" value="Choix du Arme" name="btnModifier">
    </form>

    <?php
    //Formulaire HTML de modification -------------------------------------
    //je dois avoir $id,$nom,$vie,$forceAttaque,$pdo,$image
    // id sera caché car il est utilisé pour la condition where de l'update
    ?>

    <form action="" method="post" >
    
        <label for="nom">nom: </label>
        <input type="text" name="nom" id="nom" required value="<?php echo $Arme1->getnom(); ?>">

        <label for="vie">Vie: </label>
        <input type="text" name="vie" id="vie" required value="<?php echo $Arme1->getVie(); ?>">

        <label for="forceAttaque">Attaques: </label>
        <input type="text" name="forceAttaque" id="forceAttaque" value="<?php echo $Arme1->getForceAttaque(); ?>" required>
    
        <label for="image">Lien Image: </label>
        <input type="text" name="image" id="image" required value="<?php echo $Arme1->getImage(); ?>">

        <!-- le champ hidden permet de mettre un id dans un input caché-->
        <input type="Hidden" name="idArme" id="idArme" required value="<?php echo $Arme1->getId(); ?>">
       
        <input type="submit" name="btnConfirmerUpdate" value="Confirmer l'Update">
    
    </form>

    <?php 
    if(!is_null($Arme1->getId())){
        echo $Arme1->getnom();
        echo '<img width="100px" src="'.$Arme1->getImage().'" alt="'.$Arme1->getnom().'">';
    }      
    ?>
  
</body>
</html>