<?php 

class CategoryAdmin extends Model{

    public $category_id;
    public $name;
    public $parent_name;
    public $sort_order;

    public function getListCategories(){
        $sql="SELECT * FROM `category`";
        $select=$this->db->query($sql);
        $result=$select->fetchAll();
        return $result;
        
    }
    // доробити! 
    // public function getListCategoriesMain($category_id){
    //   $sql="SELECT `id`, `name`, `parent_id`, `sort_order` FROM `category` WHERE `id`=:category_id";
    //   $data=array(
    //     'category_id'=>$category_id=1
    //   );
    //   $select=$this->db->query($sql);
    //   $result=$select->fetchAll();
    //   return $result;
    // }

    public function getCategoryByCategoryId($category_id){
        $sql="SELECT * FROM `category` WHERE `id`=:category_id";
        $data=array(
            "category_id"=>$category_id
        );
        $select=$this->db->prepare($sql);
        $select->execute($data);
        return $result=$select->fetchAll();

    }

    public function save($data){
        if(!empty($data)){
            if($this->validation($data)){
                    $array=array(
                        'category_name'=>$this->name,
                        'parent_name'=>$this->parent_name,
                        'sort_order'=>$this->sort_order
                    );
                
                if(!$category_id){
                    $sql="INSERT INTO `category`(`name`, `parent_id`, `sort_order`) VALUES (:category_name,:parent_name,:sort_order)";
                }else{
                    var_dump($category_id);
                    die;
                    $array['id']=$category_id;
                    $sql="UPDATE `category` SET `name`=:category_name,`parent_id`=parent_name,`sort_order`=:sort_order WHERE `id`=:id";
                }
                $select=$this->db->prepare($sql);
                if($select->execute($array)){
                    header("Location:/categories");
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
        if(isset($data['parent_name']) && !empty($data['parent_name'])){
            $this->parent_name=$data['parent_name'];
        }else{
            return false;
        }
        if(isset($data['sort_order']) && !empty($data['sort_order'])){
            $this->sort_order=$data['sort_order'];
        }else{
            return false;
        }
        return true;
    }


}


?>