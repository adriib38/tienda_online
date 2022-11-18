<?php

    class User {
        public $usuario;
        public $contrasenya;
        public $email;
        public $rol;
        public $token;

        public function __construct($usuario, $contrasenya, $email, $rol, $token) {
            $this->usuario = $usuario;
            $this->contrasenya = $contrasenya;
            $this->email = $email;
            $this->rol = $rol;
            $this->token = $token;
        }
    }

?>