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
    <h1>
        <?php echo "Test de la class USER";
        
        
        $U1 = new User("Toto");
        $U2 = new User("Titi");

        echo "<p>je suis ".$U2->getNom()."</p>";
        echo "<p>je suis ".$U1->getNom()."</p>";

        
        ?>
    </h1>
</body>
</html>

