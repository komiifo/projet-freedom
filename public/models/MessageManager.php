<?php 
    // require_once "Db.php";
    require_once "BDD.php";
    class MessageManager extends BDD{

        private $message;
        public function ajoutMessage($message){
            $this->message[] = $message;
        }

        public function getMessage(){
            return $this->message;
        }
        
        public function chargementMessage(){
            $bdd = new Db();
            $sql = ("SELECT * FROM message");
            $datas = $bdd->select($sql);
            foreach($datas as $data){
                $addMessage = new Message($data['idMessage'],$data['labelMessage'],$data['dateMessage'],$data['id_commentaire'],$data['id_user']);
                $this->ajoutMessage($addMessage);
            }
        }

        public function getMessageById($id){
            for($i = 0; $i < count($this->message); $i++){
                if($this->message[$i]->getId() == $id){
                    return $this->message[$i];
                }
            }
        }

        public function editMessage($label, $idComment, $idUser){
            $bdd = new Db();
            $sql = "UPDATE message SET label = ?, id_comment = ?, id_user = ? WHERE id = ?";
            $array = array($label, $idComment, $idUser);
            $datas = $bdd->modifier($sql, $array);
        }

        public function dislike($idComment, $reaction){
            $bdd = new Db();
            $sql = "UPDATE like set reaction = ? WHERE idLike = ?";
            $array = array($idComment, $reaction);
            $datas = $bdd->modifier($sql, $array);
        }

        public function deleteMessage($id){
            $bdd = new Db();
            $sql = "DELETE FROM user WHERE id = ?";
            $data = $bdd->supprimer($sql,$id);
        }

        public function ajoutMessageBdd($label, $date, $idComment, $idUser){
            $req = " INSERT INTO message (labelMessage, dateMessage, id_commentaire, id_user) values (:labelMessage, :dateMessage, :id_commentaire, :id_user)";
            $stmt = $this->getBdd()->prepare($req);
            $stmt->bindValue(":labelMessage", $label, PDO::PARAM_STR);
            $stmt->bindValue(":dateMessage", $date, PDO::PARAM_STR);
            $stmt->bindValue(":id_commentaire", $idComment, PDO::PARAM_STR);
            $stmt->bindValue(":id_user", $idUser, PDO::PARAM_STR);
            $resultat = $stmt->execute();
            $stmt->closeCursor();
            if ($resultat > 0) {
                $message = new User($this->getBdd()->lastInsertId(), $label, $date, $idComment, $idUser);
                $this->ajoutMessage($message);
            }
            
        }
    }