<?php

class OrderAdmin extends Model{
    /**необхідно дістати
     * id,
     * назва товару
     * Загальна сумма
     * ціна
     * кількість
     * дата замовлення
     * назва статуса
     * 
     * виконавець - імя 
     * оплата - назва 
     * 
     * місто - назва
     * адресса
     * 
     */
    public function getListOrders($user_id){
        
        $sql="SELECT CONCAT(`customer`.`name`, ' ',`customer`.`surname`) as 'custom_name',`customer`.`telephone`,`order`.`date_add`,`status_order`.`name` as 'status' ,`payment`.`name` as 'payment', `delivery`.`name` as 'delivery',`order`.`id` as 'order_id',SUM(`product_order`.`price`) as 'total_sum' FROM `order` LEFT JOIN `product_order` ON `order`.`id`=`product_order`.`order_id` LEFT JOIN `customer` ON `order`.`customer_id`=`customer`.`id`  LEFT JOIN `status_order` ON `order`.`status_id`=`status_order`.`id` LEFT JOIN `payment` ON `order`.`payment_id`=`payment`.`id` LEFT JOIN `delivery` ON `order`.`delivery_id`=`delivery`.`id` 
        GROUP BY `order`.`id`";
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        // $result=array();
        // foreach($select->fetch() as $order){
        //     $result[]=$order;
        // }
        
        return $result;
        
    }

    public function getOrder($order_id){
        $sql="SELECT * FROM `order` WHERE `id`=:id";
        $data=array(
            'id'=>$order_id
        );
        $select=$this->db->prepare($sql);
        $select->execute($data);
        $result=$select->fetch();
        return $result;
    }

    public function orderUpdate($data){
        $array=array(
            'status_id'=>$data['status_order'],
            'delivery_id'=>$data['delivery'],
            'payment_id'=>$data['payment'],
            'order_id'=>$data['order_id']
        );
        $sql="UPDATE `order` SET `status_id`=:status_id,`delivery_id`=:delivery_id,`payment_id`=:payment_id WHERE `id`=:order_id";
        $select=$this->db->prepare($sql);
        if($select->execute($array)){
            return true;
        }
        return false;
    }

    public function deleteProducts($data){
        $sql="DELETE FROM `product_order` WHERE `order_id`=:order_id AND `product_id`=:product_id";
        $array=array(
            'order_id'=>$data['order_id'],
            'product_id'=>$data['product_id']
        );
        $select=$this->db->prepare($sql);
        if($select->execute($array)){
            return true;
        }
        return false;
    }

    public function getOrderProduct($data){
        $sql="SELECT CONCAT(`product`.`name`,' ',`product`.`year`) as 'name', `product_order`.`product_id`,`product_order`.`quantity`,`product_order`.`price`,`product_order`.`unit_id`,`unit`.`name` as 'unit_name',`product_unit`.`quantity` as 'total_quantity'  FROM `product_order` LEFT JOIN `product`  ON `product_order`.`product_id`=`product`.`id` LEFT JOIN `unit`  ON `product_order`.`unit_id`=`unit`.`id` LEFT JOIN `product_unit` ON `product_order`.`unit_id`=`product_unit`.`unit_id`  WHERE `product_order`.`order_id`=:order_id AND `product_order`.`product_id`=:product_id";
        $array=array(
            'product_id'=>$data['product_id'],
            'order_id'=>$data['order_id']
        );
        $select=$this->db->prepare($sql);
        $select->execute($array);
        $result=$select->fetchAll();
        return $result[0];
        
    }



}
?>