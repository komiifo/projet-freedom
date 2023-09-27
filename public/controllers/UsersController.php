<?php
    class UsersController{
        
        private $userManager;

        public function __construct(){
            $this->userManager = new UsersManager();
            $this->userManager->chargementUsers();
        }

        public function getUser(){
            $users = $this->userManager->getUsers();
            
            if(isset($_POST['submitAddUser'])){
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $tel = $_POST['tel'];
                $this->userManager->ajoutUserBdd($nom, $prenom, $email, $tel);
                header('Location: /user');
            }

            require "public/views/allUser.php";
        }

        public function edit($id){
            $user = $this->userManager->getUserById($id[0]);

            if(isset($_POST['submitEditUser'])){
                $nomEdit = $_POST['editNom'];
                $prenomEdit = $_POST['editPrenom'];
                $mailEdit = $_POST['editEmail'];
                $telEdit = $_POST['editTel'];
                $this->userManager->editUser($nomEdit, $prenomEdit, $mailEdit, $telEdit, $id);
                header('Location: /user');
            }
            
            require "public/views/editUser.php";
            
            
        }

        public function delete($id){
            $user = $this->userManager->getUserById($id);

            if(isset($_POST['submitDeleteUser'])){
                $this->userManager->deleteUser($id);
                header('Location: /user');
            }
            require "public/views/deleteUser.php";
        }
    }