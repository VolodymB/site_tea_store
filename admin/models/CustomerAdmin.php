<?php
class CustomerAdmin extends Model{

    public function getCustomers(){
        $sql="SELECT * FROM `customer`";
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;
    }

    public function getCustomerByCustomId($id){
        $sql="SELECT * FROM `customer` WHERE `id`=:id";
        $data=array(
            'id'=>$id
        );
        $select=$this->db->prepare($sql);
        $select->execute($data);
        $result=$select->fetchAll();
        return $result[0];
    }

    public function getListDelivery(){
        $sql='SELECT * FROM `delivery`';
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;

    }


    public function getListPayment(){
        $sql='SELECT * FROM `payment`';
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result; 
    }

    public function getListCity(){
        $sql='SELECT * FROM `city`';
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result; 
    }

    public function save($data){
        if(isset($data['id'])){
            $array=array();            
            if($array=$this->validation($data)){
                $sql="UPDATE `customer` SET `user_id`=:c_user_id,`name`=:cus_name,`surname`=:surname,`email`=:email,`telephone`=:phone WHERE `id`=:id";
            $select=$this->db->prepare($sql);
                if($select->execute($array)){
                    header("Location:/customers");
                }
            }
            
        }
        
    }

    public function validation($data){
        
        if(isset($data['id']) && $data['id']>0){
            $array=array();
            $id=$data['id'];

            if(isset($data['user_id']) && is_numeric($data['user_id'])){
                $user_id=$data['user_id'];
            }else{
                $user_id=0;
            }
            if(isset($data['name']) && !empty($data['name'])){
                $name=$data['name'];
            }
            if(isset($data['surname']) && !empty($data['surname'])){
                $surname=$data['surname'];
            }
            if(isset($data['email']) && !empty($data['email'])){
                $email=$data['email'];
            }
            if(isset($data['phone']) && !empty($data['phone'])){
                $phone=$data['phone'];
            }

            $array=array(
                'id'=>$id,
                'c_user_id'=>$user_id,
                'cus_name'=>$name,
                'surname'=>$surname,
                'email'=>$email,
                'phone'=>$phone            
            );
            
            return $array;


        }
    }

    public function delete(int $id){
            $sql="DELETE FROM `customer` WHERE `id`=:id";
            $data=array(
                'id'=>$id
            );
            $select=$this->db->prepare($sql);
            if($select->execute($data)){
                return true;        
        }
    }

    public function getCustomer($customer_id){
        $sql="SELECT * FROM `customer` WHERE `id`=:id";
        $data=array(
            'id'=>$customer_id
        );
        $select=$this->db->prepare($sql);
        $select->execute($data);
        $result=$select->fetch();
        return $result;

    }

}
?>