<?php
echo "Chargement Class User";
class User{

    //Propriété (Private )
    //Membres
    private $login_;
    private $mdp_;


    //Méthode ( Public )
    public function __construct($NewLogin,$pass){
        $this->login_ = $NewLogin;
        $this->mdp_ = $pass;
    }

    public function getNom(){
        return $this->login_;
    }

    public function seConnecter($UnMotDePass){
        
        if($UnMotDePass==$this->mdp_){
            return true;
        }else{
            return false;
        }

    }
}
highlight_file(__FILE__);
?>