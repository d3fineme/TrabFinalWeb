<?php
    class usuario{
        private $email, $name, $sobrenome, $street, $city, $state, $zip;

        public function __construct($email, $name, $sobrenome, $street, $city, $state, $zip){
            $this->email = $email;
            $this->zip = $zip;
            $this->city = $city;
            $this->street = $street;
            $this->sobrenome = $sobrenome;
            $this->name = $name;
            $this->state = $state;
        }

        public function getCity()
        {
            return $this->city;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getSobrenome()
        {
            return $this->sobrenome;
        }

        public function getState()
        {
            return $this->state;
        }

        public function getStreet()
        {
            return $this->street;
        }

        public function getZip()
        {
            return $this->zip;
        }

    }
?>
