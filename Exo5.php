
<?php 


include ("Personnage.php"); 
highlight_file(__FILE__);
try {
    // ---------------Connexion à la BDD et récupération et traitement du formulaire
    $pdo = new PDO('mysql:host=192.168.65.193;dbname=Combat', 'UserWeb', 'UserWeb');

    if(isset($_GET["valideAlliance"])){
        $idCombatant1 =  $_GET["Combatant1"];
        $idCombatant2 =  $_GET["Combatant2"];
        $sql = "INSERT INTO `Alliance` (`id`, `idPersonnage1`, `idPersonnage2`, `nom`) VALUES (NULL, '".$idCombatant1."', '".$idCombatant2."', '');";
        $pdo->query($sql);
    }


} catch (Exception  $error) {
    $error->getMessage();
}
 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Exo1</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <h1>Exo 5 alliance</h1>
    <?php 

     //---------------------RECURATION DE TOUS LES PERSONNAGES EN BDD -------------------------------
     $req = "SELECT * from Personnage";
     $TableauPersonnage = array();
     $reponses = $pdo->query($req);
     while ($donnees = $reponses->fetch())
     {
         //ORM je met les infos du tuple ( issu de la bdd)
         //dans un nouvel objet Personnage que je stock dans un tableau de PErso
         $Perso = new Personnage($donnees['id'],$donnees['pseudo'],$donnees['vie'],$donnees['forceAttaque'],$pdo);
         $Perso->setAllies();

         //ON Stock tous les personnages dans un tableau pour l'utiliser dans notre page
         array_push($TableauPersonnage,$Perso);
     } 

    ?>
    <!---------------------------FORMULAIRE d'ALIANCE-------------------------->
    <form action="" method="get">
        <select id="monselect" name="Combatant1">
            <?php
            foreach ($TableauPersonnage as  $ThePerso) {
                echo '<option value="'.$ThePerso->getId().'">'.$ThePerso->getPseudo().'</option>';
                //echo "perso :".."</br>";
            }
            ?>
        </select>
        Alliance avec
        <select id="monselect" name="Combatant2">
            <?php
            foreach ($TableauPersonnage as  $ThePerso) {
                echo '<option value="'.$ThePerso->getId().'">'.$ThePerso->getPseudo().'</option>';
                //echo "perso :".."</br>";
            }
            ?>
        </select>
        <input type="submit" value="ok" name="valideAlliance">
    </form>
    <!---------------------------AFFICHAGE DES d'ALIANCE-------------------------->
 
    <h2>Voici les alliances</h2>
    <?php
    //On parcours le tableau des pesonnages de la bdd
    foreach ($TableauPersonnage as  $ThePerso) {
        echo "</br> ".$ThePerso->getPseudo()." est en alliance avec : ";
        //on va chercher les allies de chaque personnage et on les affiches 1 par 1
        foreach ($ThePerso->getAllies() as  $TheAllie) {

            echo "".$TheAllie->getPseudo().",";           
        }        
    }
    ?>

</body>
</html>