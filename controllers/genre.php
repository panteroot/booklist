<?php


    class Genre extends Database {
        
        private $conn;

        private $tbl_genre = 'genre';

        public function __construct(){
            $instance = parent::getInstance(PDO_DSN, DATBASE_USER, DATBASE_PASSWORD);
            $this->conn = $instance->getConnection();  
        }

        public function getGenres(){
            $sqlQuery = "SELECT * FROM " .$this->tbl_genre;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $results;
        }

    }

    // $obj = new Genre(); 
    
    // $results = $obj->getGenres();
    
    // foreach($results as $row){
    //     echo 'row: '.$row->genre;
    // }

    // echo 'test';
    
?>