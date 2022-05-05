
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
    <h2>(READ Select) </h2>
    <?php
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
    <h2>(CREATE Insert) </h2>

</body>
</html>