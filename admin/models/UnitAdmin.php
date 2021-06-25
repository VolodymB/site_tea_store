<?php 
class UnitAdmin extends Model{
    public $unit_id;
    public $name;

    public function getListUnits(){
        $sql="SELECT `id`,`name` FROM `unit`";
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;
        
    }

    // public function getUnitById($product_id){
    //     $sql="SELECT `product_id`,`unit_id`,`price`,`quantity`,`unit`.`name` as 'unit_name' FROM `product_unit` LEFT JOIN `unit` ON `product_unit`.`unit_id`=`unit`.`id` WHERE `product_id`=:product_id";
    //     $data=array(
    //         'product_id'=>$product_id
    //     );
    //     $select=$this->db->prepare($sql);
    //     $select->execute($data);
    //     $result=$select->fetchAll();
    //         return $result;
    //     }

    public function save($data,$unit_id=false){
        if(!empty($data)){
            if($this->validation($data)){
                $array=array(
                    'unit_name'=>$this->name
                );
                if(!$unit_id){
                    $sql="INSERT INTO `unit`(`name`) VALUES (:unit_name)";
                }else{
                    $array['id']=$unit_id;
                    $sql="UPDATE `unit` SET `name`=:unit_name WHERE `id`=:id";
                }
                $select=$this->db->prepare($sql);
                if($select->execute($array)){
                    header("Location:/units");
                }
            }
            
        }
        
        
    }

    public function validation(array $data){
        if(isset($data['name']) && !empty($data['name'])){
            $this->name=$data['name'];
        }else{
            return false;
        }
        return true;
    }

    public function getUnitByUnitId($unit_id){
        $sql="SELECT * FROM `unit` WHERE `id`=:unit_id";
        $data=array(
            "unit_id"=>$unit_id
        );
        $select=$this->db->prepare($sql);
        $select->execute($data);
        return $result=$select->fetchAll();
    }

    public function getProductIdByUnitId($unit_id){
        $sql="SELECT * FROM `product_unit` WHERE `unit_id`=:unit_id";
        $data=array(
            'unit_id'=>$unit_id
        );
        $select=$this->db->prepare($sql);
        $select->execute($data);
        return $result=$select->fetchAll();
    }

    public function delete($data){        
        
        // array(2) { [0]=> array(2) { ["id"]=> int(17) ["name"]=> string(14) "одиниць" } ["products"]=> array(0) { } }
        if(empty($data['products'])){
            $sql="DELETE FROM `unit` WHERE `id`=:unit_id";
            $array=array(
                'unit_id'=>$data[0]['id']
            );            
            $select=$this->db->prepare($sql);
             if($select->execute($array)){
                 return true;
             }
        }else{
            echo 'Не можливо видалити ';
            header("Location:/units");
            
        }
    }

        

    

}


?>