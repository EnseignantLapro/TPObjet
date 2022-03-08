<?php
echo "Chargement Class User";
class User{

    //Propriété (Private )
    //Membres
    private $login_;


    //Méthode ( Public )
    public function __construct($NewLogin){
        $this->login_ = $NewLogin;
    }

    public function getNom(){
        return $this->login_;
    }
}

?>