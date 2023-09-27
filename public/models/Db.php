<?php
    class Db
{
    private $pdo;
        private $stmt;

        public function __construct(){
            try{
                $this->pdo = new PDO("mysql:host=localhost;dbname=freedom","root","",[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
            }
            catch (Exception $e){ 
                exit($e->getMessage());
            }
        }

        public function __destruct(){
            if ($this->pdo != null){
                $this->pdo = null;
            }
        }

        public function select($sql, $param=null){
            try{
                $this->stmt = $this->pdo->prepare($sql);
                $this->stmt->execute($param);
                return $this->stmt->fetchAll();
            }
            catch(Exception $e) {
                return false;
            }
        }

        public function insert($sql, $param=null){
            try{
                $this->stmt = $this->pdo->prepare($sql);
                $this->stmt->execute($param);
                return true;
            }
            catch(Exception $e) {
                "ERREUR LORS DE LA TENTATIVE D'INSCRIPTION ";
                return false;
            }
        }

        public function modifier($sql, $param=null){
            try{
                $this->stmt = $this->pdo->prepare($sql);
                $this->stmt->execute($param);
                return true;
            }
            catch(Exception $e) {
                "ERREUR";
                return false;
            }
        }

        public function supprimer($sql, $param=null){
            try{
                $this->stmt = $this->pdo->prepare($sql);
                $this->stmt->execute($param);
                return true;
            }
            catch(Exception $e){
                "ERREUR";
                return false;
            }
        }
}