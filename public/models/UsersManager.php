<?php
    require_once "BDD.php";
    class UsersManager extends BDD{
        private $users;


        public function ajoutUsers($user){
            $this->users[] = $user;
        }

        public function getUsers(){
            return $this->users;
        }
        
        public function chargementUsers(){
            $bdd = new Db();
            $sql = ("SELECT * FROM utilisateur");
            $datas = $bdd->select($sql);
            foreach($datas as $data){
                $addUsers = new User($data['id'],$data['nom'],$data['prenom'],$data['email'],$data['telephone']);
                $this->ajoutUsers($addUsers);
            }
        }

        public function getUserById($id){
            for($i = 0; $i < count($this->users); $i++){
                if($this->users[$i]->getId() == $id){
                    return $this->users[$i];
                }
            }
        }

        public function editUser($nom, $prenom, $email, $tel, $id){
            $bdd = new Db();
            $sql = "UPDATE utilisateur SET nom = ?, prenom = ?, email = ?, telephone = ? WHERE id = ?";
            $array = array($nom, $prenom, $email, $tel, $id[0]);
            $datas = $bdd->modifier($sql, $array);
        }

        public function deleteUser($id){
            $bdd = new Db();
            $sql = "DELETE FROM utilisateur WHERE id = ?";
            $data = $bdd->supprimer($sql,$id);
        }

        public function ajoutUserBdd($nom, $prenom, $email, $tel){
            $req = " INSERT INTO utilisateur (nom, prenom, email, telephone) values (:nom, :prenom, :email, :telephone)";
            $stmt = $this->getBdd()->prepare($req);
            $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
            $stmt->bindValue(":prenom", $prenom, PDO::PARAM_STR);
            $stmt->bindValue(":email", $email, PDO::PARAM_STR);
            $stmt->bindValue(":telephone", $tel, PDO::PARAM_STR);
            $resultat = $stmt->execute();
            $stmt->closeCursor();
            if ($resultat > 0) {
                $user = new User($this->getBdd()->lastInsertId(), $nom, $prenom, $email, $tel);
                $this->ajoutUsers($user);
            }
            
        }
    }