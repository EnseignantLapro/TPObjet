<?php
//---------------------------- CLASS Arme---------------------------------------

highlight_file(__FILE__);

class Arme{
    private $id_;
    private $image_;
    private $nom_;
    private $vie_;
    private $forceAttaque_;
    private $tabPersoAllies_ = array();
    private $PDO_ ;
    //permet de faire la relation 1-N
    //entre un User qui peut avoir N Arme


    public function __construct($id,$nom,$vie,$forceAttaque,$pdo,$image){
        $this->id_=$id;
        $this->vie_=$vie;
        $this->nom_ = $nom;
        $this->forceAttaque_ = $forceAttaque;
        $this->PDO_ = $pdo;
        $this->image_ = $image;
       
    }
    public function getAllArme(){
        
        $sql = "select * from Arme";
        $reponses = $this->PDO_->query($sql);
        $TableauArme = array();
        while ($donnees = $reponses->fetch())
        {
            //ORM je met les infos du tuple ( issu de la bdd)
            //dans un nouvel objet Arme que je stock dans un tableau de PErso
            $Perso = new Arme($donnees['id'],$donnees['nom'],$donnees['vie'],$donnees['forceAttaque'],$this->PDO_,$donnees['image']);

            //ON Stock tous les Armes dans un tableau pour l'utiliser dans notre page
            array_push($TableauArme,$Perso);
        } 

        return $TableauArme;
    }
    
    public function getId(){
        return $this->id_;
    }
    
    public function getVie(){
        return $this->vie_;
    }
    public function getForceAttaque(){
        return $this->forceAttaque_;
    }
    public function getnom(){
        return $this->nom_;
    }
    public function getImage(){
        return $this->image_;
    }
    public function getArmeById($id){
        $sql = "select * from Arme where id ='".$id."'";
        //echo $sql ;
        $reponses = $this->PDO_->query($sql);
        $donnees = $reponses->fetch();
        $this->id_ =  $donnees['id'];
        $this->image_ = $donnees['image'];
        $this->nom_ = $donnees['nom'];
        $this->vie_= $donnees['vie'];
        $this->forceAttaque_ = $donnees['forceAttaque'];

    }
    public function attaque($UnAutrePerso){
        $UnAutrePerso->defendre($this->forceAttaque_);
    }
    public function defendre($ForcedAttaque){
        $this->vie_-= $ForcedAttaque;
    }
    public function afficherArme(){
        echo "je suis ".$this->nom_." ";
        ?>
            <div id="divPerso<?php echo $this->id_;?>">
                Attaque moi !
            </div>
        <?php
    }
    public function saveInBdd(){
        //1 cas INSERT si id = null
        if(is_null($this->id_) ){
            $sql = "INSERT INTO `Arme` 
            (`id`, `image`, `nom`, `vie`, `forceAttaque`)
            VALUES 
            (NULL, '".$this->image_."', '".$this->nom_."', '".$this->vie_."', '".$this->forceAttaque_."');";
            //echo $sql ;
            $reponses = $this->PDO_->query($sql);
            //attention il faut protéger son code dans un transaction pour ne pas récupére l'id dans autre visiteur
            $this->id_ = $this->PDO_->lastInsertId();
        }else{
            $sql = "UPDATE `Arme` SET 
            `image`='".$this->image_."',
            `nom`='".$this->nom_."',
            `vie`='".$this->vie_."',
            `forceAttaque`='".$this->forceAttaque_."',
            WHERE
            `id` = '".$this->id_."'";
            //echo $sql ;
            $reponses = $this->PDO_->query($sql);
        }
        
       

        //2 cas UDPATE si id > 0

    }
    public function delete(){
        //1 cas INSERT si id = null
        if(!is_null($this->id_) ){
            $sql = "DELETE FROM `Arme` 
            WHERE
            `id` = '". $this->id_."'
            ";
            //echo $sql ;
            $reponses = $this->PDO_->query($sql);
            $this->id_ = null;
        }
    }
}
//----------------------------FIN CLASS Arme---------------------------------------

?>