<?php
require_once '../catalog/models/Product.php';

    class Basket{

        public function add($product_id,$unit_id=0,$quantity=1){
           session_start();
           $basket=$_SESSION['basket'];
           if(isset($basket[$product_id])){
                if(isset($basket[$product_id][$unit_id])){
                    $basket[$product_id][$unit_id]+=$quantity;
                }else{
                    $basket[$product_id][$unit_id]=$quantity;
                }
           }else{
            $basket[$product_id] = array($unit_id=>$quantity);
           }
           $_SESSION['basket']=$basket;
           return true;
        }

        public function remove($product_id,$unit_id){
            session_start();
            $basket=$_SESSION['basket'];
            if(isset($basket[$product_id][$unit_id])){
                unset($basket[$product_id][$unit_id]);
                if(empty($basket[$product_id])){
                    unset($basket[$product_id]);
                    if(empty($basket)){
                        $this->clear();
                    }
                }
            }
            $_SESSION['basket']=$basket;
        }

        public function clear(){
            session_start();
            unset($_SESSION['basket']);
            header('Location:products');
        }

        public function products(){
            session_start(); 
            $products=array();
            $images=array();
            
                //array(4) { [15]=> array(1) { [2]=> int(1) } [16]=> array(1) { [2]=> int(1) } [13]=> array(1) { [2]=> int(1) } [7]=> array(1) { [5]=> int(1) } }    
            if(isset($_SESSION['basket']) && !empty($_SESSION['basket'])){
                foreach($_SESSION['basket'] as $product_id=>$unit){
                    foreach($unit as $unit_id=>$quantity){
                        $image='./web/img/default_image.jpg';                       
                        $product=new Product();
                        $product_info=$product->getProductByIdByUnit($product_id,$unit_id);
                        if($product_images=$product->getProductImages($product_id)){                            
                            $image=$product_images[0];
                        }
                        //  [0]=> array(6) { ["product_id"]=> int(15) ["unit_id"]=> int(2) ["price"]=> float(250) ["quantity"]=> int(4) ["product_name"]=> string(22) "Білочунь, 2019" ["name"]=> string(8) "0,1 кг" 
                        if(!empty($product_info)){
                            $products[]=array(
                                'product_id'=>$product_id,
                                'unit_id'=>$unit_id,
                                'price'=>$product_info['price'],
                                'quantity'=>$quantity,
                                'product_name'=>$product_info['product_name'],
                                'unit_name'=>$product_info['name'],
                                'total_sum'=>$product_info['price']*$quantity,
                                'link'=>'product?id='.$product_id,
                                'link_remove'=>'remove_basket?product_id='.$product_id.'&unit_id='.$unit_id,
                                'image'=>$image
                            );
                        }                        
                    }                    
                }
                // echo '<pre>';
                // var_dump($products);
                // echo '</pre>';
                // die;
                return $products;
            }  
            return false;              
        }

        public static function totalCount(){
            session_start();
            $total_count=0;
            if(isset($_SESSION['basket']) && !empty($_SESSION['basket'])){
                $basket=$_SESSION['basket'];
                // array(2) { 
                //     [1]=> array(1) { 
                //         [2]=> int(10) 
                //     } 
                //     [2]=> array(1) { 
                //         [2]=> int(1) 
                //     } 
                // } int(0)
                foreach($basket as $item){
                    $total_count+=array_sum($item);
                    // foreach($item as $quantity){
                    //     $total_count+=$quantity;
                    // }
                }
            }
            return $total_count;
        }


    }

?>