

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
    <title>TestAPI</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <h1>Test API</h1>
    <div id="API">SN1 GO </div> 
    <?php
    //constructeur atend : $id,$pseudo,$vie,$forceAttaque,$pdo
    $P1 = new Personnage(1,"julien",12,12,$pdo);
    $P1->afficherPersonnage();
    ?>

    
    
  
    <script type="text/javascript" src="testAPI.js"></script>
</body>
</html>