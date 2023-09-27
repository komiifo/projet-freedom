<?php

    class Message{
        private $idMessage;
        private $labelMessage;
        private $dateMessage;
        private $id_commentaire;
        private $id_user;


        public function __construct($idMessage, $labelMessage, $dateMessage, $id_commentaire, $id_user){
            $this->idMessage = $idMessage;
            $this->labelMessage = $labelMessage;
            $this->dateMessage = $dateMessage;
            $this->id_commentaire = $id_commentaire;
            $this->id_user = $id_user;
        }

        /**
         * Get the value of idMessage
         */ 
        public function getIdMessage()
        {
                return $this->idMessage;
        }

        /**
         * Set the value of idMessage
         *
         * @return  self
         */ 
        public function setIdMessage($idMessage)
        {
                $this->idMessage = $idMessage;

                return $this;
        }

        /**
         * Get the value of labelMessage
         */ 
        public function getLabelMessage()
        {
                return $this->labelMessage;
        }

        /**
         * Set the value of labelMessage
         *
         * @return  self
         */ 
        public function setLabelMessage($labelMessage)
        {
                $this->labelMessage = $labelMessage;

                return $this;
        }

        /**
         * Get the value of dateMessage
         */ 
        public function getDateMessage()
        {
                return $this->dateMessage;
        }

        /**
         * Set the value of dateMessage
         *
         * @return  self
         */ 
        public function setDateMessage($dateMessage)
        {
                $this->dateMessage = $dateMessage;

                return $this;
        }

        /**
         * Get the value of id_commentaire
         */ 
        public function getId_commentaire()
        {
                return $this->id_commentaire;
        }

        /**
         * Set the value of id_commentaire
         *
         * @return  self
         */ 
        public function setId_commentaire($id_commentaire)
        {
                $this->id_commentaire = $id_commentaire;

                return $this;
        }

        /**
         * Get the value of id_user
         */ 
        public function getId_user()
        {
                return $this->id_user;
        }

        /**
         * Set the value of id_user
         *
         * @return  self
         */ 
        public function setId_user($id_user)
        {
                $this->id_user = $id_user;

                return $this;
        }
    }