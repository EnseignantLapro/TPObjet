<?php
//page pour associé une arme à un personnage
//Liaison N-N
include ("Connexion.php");

if(!is_null($User1)){
    //étape 1 récupéer la liste des Personnage 
    $Arme1 = new Arme(null,null,null,null,$pdo,null,null);
    $tabArme = $Arme1->getAllArme();
    //étape 2 récupérer la liste des Armes
    $Perso1 = new Personnage(null,null,null,null,$pdo,null,null);
    $tabPersonnage = $Perso1->getAllPersonnage();  
    //etape 3 faire un formulaire avevc 2 liste déroulante 
    //etape 4 faire le traitement du formulaire

    if(isset($_POST["btnAssocie"])){
        $Perso1->getPersonnageById($_POST["idCombatant"]);
        $Arme1->getArmeById($_POST["idArme"]);
        $Perso1->addArme($Arme1);
        //echo "coucou1";
    }


    ?>
    <form action="" method="post">
    <select id="idCombatant" name="idCombatant">
        <?php
        foreach ($tabPersonnage as  $ThePerso) {
            echo '<option value="'.$ThePerso->getId().'">'.$ThePerso->getPseudo().'</option>';
        }
        ?>
    </select>
    <select id="idArme" name="idArme">
            <?php
            foreach ($tabArme as  $TheArme) {
                echo '<option value="'.$TheArme->getId().'">'.$TheArme->getnom().'</option>';
            }
            ?>
    </select>
    <input type="submit" value="Associé une arme" name="btnAssocie">
    </form>
    <?php

    echo "<ul>";
    foreach ($tabPersonnage as $Perso) {
        echo "<li>";
        echo $Perso->getPseudo();
        echo '<img width="100px" src="'.$Perso->getImage().'" alt="'.$Perso->getPseudo().'">';
        //on doit avant charger les armes car elle ne sont pas récupérée dans le constructeur
        $Perso->loadArmes();
        $Perso->AfficheArmes();
        echo "</li>";
    }
    echo "</ul>";
}



?>