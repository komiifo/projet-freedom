<?php 

    class MessageController{

        private $messageManager;

        public function __construct(){
            $this->messageManager = new MessageManager();
            $this->messageManager->chargementMessage();
        }

        public function index(){
            require("public/views/accueil.php");
        }

        public function affichage(){
            // $messages = $this->messageManager->getMessage();
            // var_dump($messages);
            require "public/views/message.php";
        }

        
    }