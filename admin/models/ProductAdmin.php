<?php



class ProductAdmin extends Model{
    
    public $id;
    public $name;
    public $year;
    public $units;
    public $description;
    public $categories=array();


    public function getList(){
        $sql="SELECT `product`.`id`,`product`.`name`,`product`.`year`,`status_product`.`name` as 'status' FROM `product` LEFT JOIN `status_product` ON `product`.`status_id`=`status_product`.`id`";
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;
    }

    public function getItem($product_id){
        $sql="SELECT `product`.`id` as 'product_id',`product`.`name` as 'product_name',`product`.`year`,`product`.`description`,`status_product`.`name` as 'status',`product`.`status_id` FROM `product` LEFT JOIN `status_product` ON `product`.`status_id`=`status_product`.`id` WHERE `product`.`id`=:product_id";
        $data=array(
            'product_id'=>$product_id
        );
        $select=$this->db->prepare($sql);
        $select->execute($data);
        return $result=$select->fetchAll();
    }

    public function getUnitsById($product_id){
        $sql="SELECT `product_id`,`unit_id`,`price`,`quantity`,`unit`.`name` as 'unit_name' FROM `product_unit` LEFT JOIN `unit` ON `product_unit`.`unit_id`=`unit`.`id` WHERE `product_id`=:product_id";
        $data=array(
            'product_id'=>$product_id
        );
        $select=$this->db->prepare($sql);
        $select->execute($data);
        $result=$select->fetchAll();
            return $result;
        }

        public function getCategoriesById($product_id){
            $sql="SELECT `category`.`name`,`product_category`.`category_id` FROM `product_category`LEFT JOIN `category` ON `product_category`.`category_id`=`category`.`id` WHERE `product_id`=:product_id";
            $data=array(
              'product_id'=>$product_id
            );
            $select=$this->db->prepare($sql);
            $select->execute($data);
            return $result=$select->fetchAll();
          //   return $result=$select->fetchAll();
      
          }

          public function getCommetsByProductId($product_id){
            $sql="SELECT CONCAT(`user`.`name`,' ',`user`.`surname`) as 'name',`comment`.`user_id`,`comment`.`comment`,`comment`.`raiting` FROM `comment` LEFT JOIN `user` ON `comment`.`user_id`=`user`.`id` WHERE `comment`.`product_id`=:product_id";
            $data=array(
                'product_id'=>$product_id
            );
            $select=$this->db->prepare($sql);
            $select->execute($data);
            return $result=$select->fetchAll();
        }



    public function save(array $data,$product_id=false){
        if(!empty($data)){ 
            // echo '<pre>';
            // var_dump($data);
            // echo '</pre>';
            // die;           
            if($this->validation($data)){
                /**
                 * 1 запис таблиці product - повертаємо product_id 
                 * 2 запис таблиці product_unit (з параметром product_id) та даними з масиву units
                 * 3 запис таблиці product_category 
                 * повертається true
                 */
                $array=array(
                    'product_name'=>$this->name,
                    'product_year'=>$this->year,
                    'product_description'=>$this->description,
                    'status_id'=>$this->status
                );
                if(!$product_id){
                    $sql="INSERT INTO `product`(`name`, `year`, `description`, `status_id`) VALUES (:product_name,:product_year,:product_description,:status_id)";
                }else{
                    $array['product_id']=$product_id;
                    $sql="UPDATE `product` SET `name`=:product_name,`year`=:product_year,`description`=:product_description,`status_id`=:status_id WHERE `id`=:product_id";

                }                
                
                $select=$this->db->prepare($sql);
                if($select->execute($array)){
                    if(!$product_id){
                        $this->id=$this->db->lastInsertId(); 
                    }else{
                        $this->id=$product_id; 
                    }                  
                    
                    $sql="DELETE FROM `product_unit` WHERE `product_id`=:product_id";
                    $select=$this->db->prepare($sql);
                    $select->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                    $select->execute();

                    $sql="INSERT INTO `product_unit`(`product_id`, `unit_id`, `price`, `quantity`) VALUES (:product_id,:unit_id,:price,:quantity)";
                    foreach($this->units as $unit){
                       $array=array(
                        'product_id'=>$this->id,
                        'unit_id'=>$unit['id'],
                        'price'=>$unit['price'],
                        'quantity'=>$unit['quantity']
                    );
                        $select=$this->db->prepare($sql);
                        if($select->execute($array)){
                                                        
                        }
                    }   
                    $sql="DELETE FROM `product_category` WHERE `product_id`=:product_id";
                    $select=$this->db->prepare($sql);
                    $select->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                    $select->execute(); 
                        $sql="INSERT INTO `product_category`(`category_id`, `product_id`) VALUES (:category_id,:product_id)";
                            foreach($this->categories as $category){
                              $data=array(
                                'category_id'=>$category,
                                'product_id'=>$this->id
                            );
                                $select=$this->db->prepare($sql);
                                if($select->execute($data)){
                                    
                                } 
                            }
                    

                    
                            return true;
                }
                
            }
        }
        return false;
    }

    // array(6) {
    //     ["name"]=>
    //     string(5) "Apple"
    //     ["year"]=>
    //     string(4) "2019"
    //     ["status"]=>
    //     string(1) "1"
    //     ["description"]=>
    //     string(5) "apple"
    //     ["units"]=>
    //     array(1) {
    //       [0]=>
    //       array(3) {
    //         ["id"]=>
    //         string(1) "1"
    //         ["price"]=>
    //         string(0) ""
    //         ["quantity"]=>
    //         string(2) "12"
    //       }
    //     }
    //     ["categories"]=>
    //     array(1) {
    //       [0]=>
    //       string(1) "1" 
    public function validation(array $data){
        if(isset($data['name']) && !empty($data['name'])){
            $this->name=$data['name'];
        }else{
            return false;
        }
        if(isset($data['year']) && !empty($data['year'])){
            $this->year=$data['year'];
        }else{
            return false;
        }
        if(isset($data['status']) && !empty($data['status'])){
            $this->status=$data['status'];
        }else{
            return false;
        }
        if(isset($data['description']) && !empty($data['description'])){
            $this->description=$data['description'];
        }
        if(isset($data['units']) && !empty($data['units'])){
            $this->units=$data['units'];
        }else{
            return false;
        }
        if(isset($data['categories']) && !empty($data['categories'])){
            $this->categories=$data['categories'];
        }else{
            return false;
        }
        return true;

    }

    public function delete($data){
        
        //delete commets
        if(isset($data['comments']) && !empty($data['comments'])){
            $sql="DELETE FROM `comment` WHERE `product_id`=:product_id";
            $data=array(
                'product_id'=>$data['product_id']
            ); 
            $select=$this->db->prepare($sql);
            if(!$select->execute($data)){
                echo 'comments';
                return false;
            }            
            // var_dump($data['product_id']);
            // die;
        }

        //delete category
        if(isset($data['categories']) && !empty($data['categories'])){
            $sql="DELETE FROM `product_category` WHERE `product_id`=:product_id";
            $data=array(
                'product_id'=>$data['product_id']
            ); 
            $select=$this->db->prepare($sql);
            if(!$select->execute($data)){
                echo 'categories';
                return false;
            }            
        }

        //delete units
        if(isset($data['units']) && !empty($data['units'])){
            $sql="DELETE FROM `product_unit` WHERE `product_id`=:product_id";
            $data=array(
                'product_id'=>$data['product_id']
            ); 
            $select=$this->db->prepare($sql);
            if(!$select->execute($data)){
                echo 'categories';
                return false;
            }            
        }

        //delete product
        $sql="DELETE FROM `product` WHERE `id`=:product_id";
            $data=array(
                'product_id'=>$data['product_id']
            ); 
            $select=$this->db->prepare($sql);
            if(!$select->execute($data)){
                echo 'categories';
                return false;
            }
            return true;            


    //     echo '<pre>';
    //     var_dump($data['categories']);
    //    echo '</pre>';
    //    die;
        

        echo 'delete';
        }
        
    

    





}
?>