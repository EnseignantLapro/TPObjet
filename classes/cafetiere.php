<?php
class JeuxVideo{
    private $idJeuxVideo_;
    private $titre_;
    private $Note_;
    private $LienImage_;
    private $Astuces_ = array();
}

class GameClub{

    private $adresse_;
    private $jeuxVideo_ = array();

    public function addJeuxVideo($JeuxVideo){
        array_push($this->JeuxVideos_,$JeuxVideo);
    }
}
$monLibrairie = new GameClub();
$unJeuxVideo = new JeuxVideo();
$maLibrairie->addJeuxVideo($unJeuxVideo);

class User{
    private $idUser_;
    private $login_;
    private $pass_;
    private $isAdmin_;
}

class Astuce{
    private $idAstuce_;
    private $JeuxVideo_;
    private $user_;
    protected $Astuce_;
    private $Commentaire_ = array();

    //$rep est un string
    public function addCommentaire($txt){
        array_push($this->Commentaire,new Commentaire($txt));
    }
}

class Commentaire extends Astuce{
    private $idCommentaire_;

    public function construct__($idAstuce,$txt){
        Parent::__construct($idAstuce);
        $this->Astuce_ = $txt;
        $this->idCommentaire_ = newid();
    }
}



?>