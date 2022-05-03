<?php
//---------------------------- CLASS PERSONNAGE---------------------------------------

highlight_file(__FILE__);

class Personnage{
    private $id_;
    private $image_;
    private $pseudo_;
    private $vie_;
    private $forceAttaque_;
    private $tabPersoAllies_ = array();
    private $PDO_ ;



    public function __construct($id,$pseudo,$vie,$forceAttaque,$pdo,$image){
        $this->id_=$id;
        $this->vie_=$vie;
        $this->pseudo_ = $pseudo;
        $this->forceAttaque_ = $forceAttaque;
        $this->PDO_ = $pdo;
        $this->image_ = $image;
    }

    public function getAllPersonnage(){
        
        $sql = "select * from Personnage";
        echo $sql ;
        $reponses = $this->PDO_->query($sql);
        $TableauPersonnage = array();
        while ($donnees = $reponses->fetch())
        {
            //ORM je met les infos du tuple ( issu de la bdd)
            //dans un nouvel objet Personnage que je stock dans un tableau de PErso
            $Perso = new Personnage($donnees['id'],$donnees['pseudo'],$donnees['vie'],$donnees['forceAttaque'],$this->PDO_,$donnees['image']);


            //ON Stock tous les personnages dans un tableau pour l'utiliser dans notre page
            array_push($TableauPersonnage,$Perso);
        } 

        return $TableauPersonnage;
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
    public function getImage(){
        return $this->image_;
    }


    public function attaque($UnAutrePerso){
        $UnAutrePerso->defendre($this->forceAttaque_);
    }

    public function defendre($ForcedAttaque){
        $this->vie_-= $ForcedAttaque;
    }

    public function afficherPersonnage(){
        echo "je suis ".$this->pseudo_." ";
        ?>
            <div id="divPerso<?php echo $this->id_;?>">
                Attaque moi !
            </div>
        <?php
    }

    public function saveInBdd(){
        //1 cas INSERT si id = null
        $sql = "INSERT INTO `Personnage` 
        (`id`, `image`, `pseudo`, `vie`, `forceAttaque`)
        VALUES 
        (NULL, '".$this->image_."', '".$this->pseudo_."', '".$this->vie_."', '".$this->forceAttaque_."');";
        //echo $sql ;
        $reponses = $this->PDO_->query($sql);
        //2 cas UDPATE si id > 0
    }
}
//----------------------------FIN CLASS PERSONNAGE---------------------------------------

?>