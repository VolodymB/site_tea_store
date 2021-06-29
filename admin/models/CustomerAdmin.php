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

}
?>