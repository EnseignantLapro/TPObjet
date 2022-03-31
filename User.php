<?php
echo "Chargement Class User";
class User{

    //Propriété (Private )
    //Membres
    private $id_;
    private $login_;
    private $mdp_;
    private $nom_;
    private $penom_;


    //Méthode ( Public )
    public function __construct($id_,$NewLogin,$pass){
        $this->login_ = $NewLogin;
        $this->mdp_ = $pass;
        $this->id_ = $id_;
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

    //methode de l'exo1 qui affiche un echo
    public function afficheUser(){
        echo "je Suis un User";
        ?>
        <table class="violet">
            <tr>
                <td>USER</td>
            </tr>    
            <tr>
                <td>-Nom : String
                    -Penom : String
                </td>
            </tr>
                
            <tr>
                <td>
                    AfficheUser() : Void 
                </td>
            </tr>
        </table>
        
        <?php
    }
}
highlight_file(__FILE__);
?>