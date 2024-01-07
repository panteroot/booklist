<?php

    class User extends Database {
        private $conn;

        private $tbl_user = 'users';

        public function __construct(){
            $instance = parent::getInstance(PDO_DSN, DATBASE_USER, DATBASE_PASSWORD);
            $this->conn = $instance->getConnection();
        }

        public function login($username, $password){
            $sqlQuery = "SELECT * FROM " .$this->tbl_user. " WHERE username = :username";
            $where['username'] = $username;

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute($where);
            $user = $stmt->fetch(PDO::FETCH_OBJ);

            // username not existing
            if(!$user) return null;

            $password_matched = password_verify($password, $user->password);

            // incorrect password
            if(!$password_matched) return null;

            return $user;
        }

        public function getUsers(){
            $sqlQuery = "SELECT users.*,rights FROM " .$this->tbl_user;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $results;
        }

    }

?>