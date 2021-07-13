<?php
class CustomerAdmin extends Model{

    public function getCustomers(){
        $sql="SELECT `customer`.`id`,`delivery`.`name` as 'delivery',`payment`.`name` as 'payment',`customer`.`name`,`customer`.`surname`,`customer`.`email`,`customer`.`telefone`,`city`.name as 'city',`customer`.`adress` FROM `customer` LEFT JOIN `delivery` ON `customer`.`delivery_id`=`delivery`.`id` LEFT JOIN `payment` ON `customer`.`payment _id`=`payment`.`id` LEFT JOIN `city` ON `customer`.`city_id`=`city`.`id`";
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;
    }

    public function getCustomerByCustomId($id){
        $sql="SELECT
        customer.`id`,
        customer.`delivery_id`,
        customer.`payment _id`,
        customer.`name`,
        customer.`surname`,
        customer.`email`,
        customer.`telefone`,
        customer.`city_id`,
        customer.`adress`,
        delivery.name AS 'delivery',
        payment.name AS 'payment',
        city.name as 'city'
    FROM
        `customer`
    LEFT JOIN `delivery` ON `customer`.`delivery_id` = `delivery`.`id`
    LEFT JOIN `payment` ON customer.`payment _id` = payment.id
    LEFT JOIN `city` ON customer.city_id=city.id
    WHERE
        customer.`id` = :id";
        $data=array(
            'id'=>$id
        );
        $select=$this->db->prepare($sql);
        $select->execute($data);
        $result=$select->fetchAll();
        return $result;
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
            $array=$this->validation($data);
            $sql="UPDATE `customer` SET `delivery_id`=:delivery,`payment _id`=:payment,`name`=:cus_name,`surname`=:surname,`email`=:email,`telefone`=:phone,`city_id`=:city,`adress`=:addres WHERE `id`=:id";
            $select=$this->db->prepare($sql);
            if($select->execute($array)){
                header("Location:/customers");
            }
        }
        
    }

    public function validation($data){
        if(isset($data['id'])){
            $array=array();
            $array['id']=$data['id'];

            if(isset($data['delivery']) && !empty($data['delivery'])){
                $array['delivery']=$data['delivery'];
            }
            if(isset($data['payment']) && !empty($data['payment'])){
                $array['payment']=$data['payment'];
            }
            if(isset($data['name']) && !empty($data['name'])){
                $array['cus_name']=$data['name'];
            }
            if(isset($data['surname']) && !empty($data['surname'])){
                $array['surname']=$data['surname'];
            }
            if(isset($data['email']) && !empty($data['email'])){
                $array['email']=$data['email'];
            }
            if(isset($data['phone']) && !empty($data['phone'])){
                $array['phone']=$data['phone'];
            }
            if(isset($data['city']) && !empty($data['city'])){
                $array['city']=$data['city'];
            }
            if(isset($data['addres']) && !empty($data['addres'])){
                $array['addres']=$data['addres'];
            }else{
                $array['addres']='';
            }

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