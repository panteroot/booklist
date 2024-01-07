<?php 
    // 2024-04-04
    /* This class uses singleton pattern in connecting to database to
    avoid creating new connection for each object accessing this
    class, saving resources.
    
    credit:
    https://phpenthusiast.com/blog/the-singleton-design-pattern-in-php
    */
    class Database {
        
        // Hold the class instance.
        private static $instance = null; 
        private $conn;


        // The db connection is established in the private constructor.
        public function __construct($dsn='', $user='', $password='')
        {
            try{
                $this->conn = new PDO($dsn, $user, $password);
                // echo "Database connected!";
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
        }

        public static function getInstance($dsn='', $user='', $password='')
        {
            
            if(!self::$instance)
            {
                // echo ' new instance';
                self::$instance = new Database($dsn, $user, $password);
            }else{
                // echo ' same instance';
            }
        
            return self::$instance;
        }
        
        public function getConnection()
        {
            // echo 'connection';
            return $this->conn;
        }
    }  

    
?>