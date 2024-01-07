<?php
    
    // $uri = $_SERVER['REQUEST_URI'];

    // include_once ( '../config.php');
    // include_once ( '../'.CLASSES.'database.php');



    class Book extends Database {
        
        private $conn;

        private $tbl_book = 'book';
        private $tbl_genre = 'genre';

        public function __construct(){
            $instance = parent::getInstance(PDO_DSN, DATBASE_USER, DATBASE_PASSWORD);
            $this->conn = $instance->getConnection();  
        }

        public function getBooks(){
            $sqlQuery = "SELECT * FROM " .$this->tbl_book;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $results;
        }

        public function getTotalBooks(){
            $sqlQuery = "SELECT COUNT(book_id) FROM " . $this->tbl_book;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            
            $total = $stmt->rowCount();
            return $total;
        }

        public function getBooksBySearch($where, $where_val = array()){
            if($where_val){
                $to_merge[':book_id'] = 1;
                $where_val_merge = array_merge($to_merge,$where_val); 
            }else{
                $where_val_merge[':book_id'] = 1;
            }
            
            $sqlQuery = "SELECT book.*,genre.genre_name as 'genre' FROM " .$this->tbl_book. " book".
                " LEFT JOIN " .$this->tbl_genre. " genre ON book.f_genre_id=genre.genre_id".
                " WHERE `book_id` >= :book_id ". $where;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute($where_val_merge);

            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $results;
        }

        public function getBook($book_id){ 
            $sqlQuery = "SELECT book.*,genre.genre_name as 'genre' FROM " .$this->tbl_book. " book".
                " LEFT JOIN " .$this->tbl_genre. " genre ON book.f_genre_id=genre.genre_id".
                " WHERE `book_id` = :book_id ";
            $where[':book_id'] = $book_id;

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute($where);

            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result;
        }

        public function createBook($fields, $field_vals=array()){ 
            try{
                $sqlQuery = "INSERT INTO " .$this->tbl_book. " SET $fields ";
                $stmt = $this->conn->prepare($sqlQuery);
                $result = $stmt->execute($field_vals);

                return $result;
            }catch(e){
                echo 'Error: '.e;
            }    
        }

        public function updateBook($fields, $field_vals=array(), $book_id){ 
            try{
                $sqlQuery = "UPDATE " .$this->tbl_book. " SET $fields ".
                    " WHERE book_id = :book_id ";
                $field_vals[':book_id'] = $book_id;

                $stmt = $this->conn->prepare($sqlQuery);
                $result = $stmt->execute($field_vals);

                return $result;
            }catch(e){
                echo 'Error: '.e;
            }    
        }

        public function deleteBook($book_id){ 
            try{
                $sqlQuery = "DELETE FROM " .$this->tbl_book.
                    " WHERE book_id = :book_id ";
                $where[':book_id'] = $book_id;

                $stmt = $this->conn->prepare($sqlQuery);
                $result = $stmt->execute($where);

                return $result;
            }catch(e){
                echo 'Error: '.e;
            }    
        }


    }

    // $obj = new Book(); 
    // echo 'test';
    // $results = $obj->getBooks();
    // foreach($results as $row){
    //     echo 'row: '.$row->title;
    // }


    
?>