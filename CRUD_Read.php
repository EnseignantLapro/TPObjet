
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
    <h2>(READ Select) </h2>
    <?php
        $Perso1 = new Personnage(null,null,null,null,$pdo,null,null);
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
    <h2>(CREATE Insert) </h2>

</body>
</html>