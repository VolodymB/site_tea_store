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
        
        $sql="SELECT * FROM `order` LEFT JOIN `customer` ON `order`.`customer_id`=`customer`.`id` WHERE `customer`.`user_id`=:order_user_id";
        $data=array(
            'order_user_id'=>$user_id
        );
        $select=$this->db->prepare($sql);
        $select->execute($data);
        $result=array();
        foreach($select->fetch() as $order){
            $result[]=$order;
        }
        var_dump ($result);
        die;
        return $result;
        
    }
}
?>