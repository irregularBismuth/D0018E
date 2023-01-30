<?php
    session_start();
    require_once "db/db.php";
    class SQLHandler {
        public $db_connector;
        public $query_array;
        public $animal_array;

        function __construct($db_connector)
        {
            $this->db_connector = $db_connector;
            $this->query_array = []; //initilize an empty array that should store unique users queries.
            $this->animal_array = array("name"=>[],"price"=>[],"image"=>[], "category"=>[]);
        }
    
        function get_product_data(){
            /*
            This metod should request query from our database that show product/item data on our site
            */
            $query = "SELECT * FROM animals";
            $queryUser = "SELECT * FROM animals WHERE item_id = animal_id";
        
            $fetch_result = $this->db_connector->query($query);
            //$row_count = $fetch_result->rowCount();
            $output = $fetch_result->fetchAll();

            foreach($output as $output){
                array_push($this->animal_array['image'],$output['animal_image']);
                array_push($this->animal_array['name'],$output['animal_name']);
                array_push($this->animal_array['price'],$output['animal_price']);
                array_push($this->animal_array['category'],$output['animal_category']);
            }
            return $this->animal_array;

        }
    }
    //$obj = new SQLHandler($dbc);
    //$animals = $obj->get_product_data();
    //$row_count = count($animals['image']);
    //echo $animals['name'][1];
    
?>
    

