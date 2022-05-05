<?php include ("Classes/User.php"); ?>
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
   
    <li><a href="ExoJS.php">ExoJS</a></li>
    <li><a href="testAPI.php">TestAPI</a></li>
    
    <li><a href="CRUD/Personnage/CRUD_Read.php">CRUD Objet Read Personnage</a></li>
    <li><a href="CRUD/Personnage/CRUD_Create.php">CRUD Objet Create Personnage</a></li>
    <li><a href="CRUD/Personnage/CRUD_Update.php">CRUD Objet Update Personnage</a></li>
    <li><a href="CRUD/Personnage/CRUD_Delete.php">CRUD Objet Delete Personnage</a></li>
    <li><a href="Connexion.php">Page De Connexion</a></li>
   
</ul>


        <?php
        highlight_file(__FILE__);
        ?>
  
</body>
</html>

