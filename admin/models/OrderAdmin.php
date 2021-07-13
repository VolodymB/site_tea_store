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

    



}
?>