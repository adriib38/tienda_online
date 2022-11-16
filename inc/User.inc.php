<?php

    class User {
        public $usuario;
        public $contrasenya;
        public $email;
        public $rol;

        public function __construct($usuario, $contrasenya, $email, $rol) {
            $this->usuario = $usuario;
            $this->contrasenya = $contrasenya;
            $this->email = $email;
            $this->rol = $rol;
        }
    }

?>