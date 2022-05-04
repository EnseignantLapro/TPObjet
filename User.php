
<?php
echo "Chargement Class User";
class User{

    //Propriété (Private )
    //Membres
    private $id_;
    private $login_;
    private $pdo_;

    //Méthode ( Public )
    public function __construct($id,$pdo){
        $this->id_ = $id;
        $this->pdo_ = $pdo;

    }
    public function getNom(){
        return $this->login_;
    }
       public function getId(){
        return $this->id_;
    }
    public function seConnecter($Login,$pass){
        
        $sql = "SELECT * FROM `User` 
        WHERE `login` = '".$Login."' 
        AND `mdp` ='".$pass."'
        ";
        $resultat = $this->pdo_->query($sql);
        if ($tab = $resultat->fetch()){
            $this->login_ = $tab['login'];
            $this->id_ = $tab['id'];
            // si j'ai un resultat je suis connecté
            // je sauvegarde cela en session
            $_SESSION['idUser']=$tab['id'];
            return true;
        }else{
            session_unset();
            session_destroy();
            return false;
        }

    }
    public function getUserById($id){
        $sql = "SELECT * FROM `User` 
        WHERE `id` = '".$id."'";
        $resultat = $this->pdo_->query($sql);
        if ($tab = $resultat->fetch()){
            $this->login_ = $tab['login'];
            $this->id_ = $tab['id'];
        }
    }
    public function isConnect(){
        if( isset( $_SESSION['idUser'])){
            $sql = "SELECT * FROM `User` 
            WHERE `id` = '".$_SESSION['idUser']."'";
            $resultat = $this->pdo_->query($sql);
            if ($tab = $resultat->fetch()){
                $this->login_ = $tab['login'];
                $this->id_ = $tab['id'];
                return true;
            }
        }else{
            return false;
        }
    }


    //methode de l'exo1 qui affiche un echo
    public function afficheUser(){
        echo "je Suis le User ".$this->login_;
        ?>
        <?php
    }
}
highlight_file(__FILE__);
?>