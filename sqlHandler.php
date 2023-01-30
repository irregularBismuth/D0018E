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
        
        function selectWhereQuery($table_name, $col_check, $condition)
        {
            $query_output = "SELECT * FROM ".$table_name." WHERE ".$col_check."=".$condition;
        }
     //   $sql="select * from peepo wher name=:u and password=:t"
      //  prepare($sql)
       // bindvalue(":u",$name);
        //execute(); 
        //:x :y :z :w
        //convention använd bara 4 st max för denna function
        function half_genericQuery($queryString,$var,$arr){
            require_once "function.php";
            $s=$this->db_connector->prepare($queryString);
            if($var==1) { $s->bindValue(':x',$arr[0])};

            if($var==2) { $s->bindValue(':x',$arr[0]);
                          $s->bindValue(':y',$arr[1])};
                                  
            if($var==3) { $s->bindValue(':x',$arr[0]);
                          $s->bindValue(':y',$arr[1])
                          $s->bindValue(':z',$arr[2])};

            if($var==4) { $s->bindValue(':x',$arr[0]);
                          $s->bindValue(':y',$arr[1]);
                          $s->bindValue(':z',$arr[2]) 
                          $s->bindValue(':w',$arr[3])};
            $s->execute();
           
//   {
  //      echo $res['animal_name']." "; 
            
            // $fetch_result = $this->db_connector->query($queryString);
           // $output = $fetch_result->fetchAll();
            return $s;
        }

        
        
        function updateQuery(){
            //
        }
        function alterQuery(){
            //
        }
        
    }
    $sqlHandler = new SQLHandler($dbc);
    
    
?>
    

