<?php
//---------------------------- CLASS PERSONNAGE---------------------------------------

highlight_file(__FILE__);

class Personnage{
    private $id_;
    private $pseudo_;
    private $vie_;
    private $forceAttaque_;
    private $tabPersoAllies_ = array();
    private $PDO_ = array();



    public function __construct($id,$pseudo,$vie,$forceAttaque,$pdo){
        $this->id_=$id;
        $this->vie_=$vie;
        $this->pseudo_ = $pseudo;
        $this->forceAttaque_ = $forceAttaque;
        $this->PDO_ = $pdo;

   

    }

    public function setAllies(){
        //ici on va récupérer ses allies.
        $sql = "select Personnage.id,Personnage.pseudo,Personnage.vie,Personnage.forceAttaque
        from Personnage,Alliance
        WHERE
        (
            Personnage.id = Alliance.idPersonnage1
            AND
            Alliance.idPersonnage2 = ".$this->id_.")
        
        OR
        (   
            Personnage.id = Alliance.idPersonnage2
            AND
            Alliance.idPersonnage1 = ".$this->id_."
        );";

        $reponses =$this->PDO_->query( $sql);
        while ($donnees = $reponses->fetch())
        {
            //ORM je met les infos du tuple ( issu de la bdd)
            //dans un nouvel objet Personnage que je stock dans un tableau de PErso
            array_push($this->tabPersoAllies_,new Personnage($donnees['id'],$donnees['pseudo'],$donnees['vie'],$donnees['forceAttaque'],$this->PDO_));
        } 
    }

    public function getId(){
        return $this->id_;
    }
    public function getAllies(){
        return $this->tabPersoAllies_;
    }
    public function getVie(){
        return $this->vie_;
    }
    public function getPseudo(){
        return $this->pseudo_;
    }

    public function attaque($UnAutrePerso){
        $UnAutrePerso->defendre($this->forceAttaque_);
    }

    public function defendre($ForcedAttaque){
        $this->vie_-= $ForcedAttaque;
    }
}
//----------------------------FIN CLASS PERSONNAGE---------------------------------------
?>