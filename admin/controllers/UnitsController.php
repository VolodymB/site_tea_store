<?php
require_once "./models/UnitAdmin.php";
class UnitsController extends Controller{

    public function index(){
        $data_page=array();

        $unit=new UnitAdmin();
        $data_page['units']=$unit->getListUnits();
        // var_dump( $data_page['units']);
        return $this->view->render('units',$data_page);
    }

    public function findOne($unit_id){
        $unit=new UnitAdmin();
        $unit_info=$unit->getUnitByUnitId($unit_id);
        $unit_info['products']=$unit->getProductIdByUnitId($unit_id);
        return $unit_info;
    }

    public function create(){
        if(isset($_POST)){
            $data=$_POST;
            $unit=new UnitAdmin();
            $unit->save($data);
        }
        
        return $this->view->render('unit_form');   
    }

    public function update($data){
        $unit=new UnitAdmin();
        $data_page=array();
        
        if(isset($data['id']) && !empty($data['id'])){
            $unit_id=$data['id'];
            $data_page['unit']=$this->findOne($data['id']);
        }
        if(isset($_POST['save'])){
            if($unit->save($_POST,$unit_id)){
                header("Location:/units");
            }
        }
        // echo '<pre>';
        // var_dump($data_page['unit']);
        // echo '</pre>';
        return $this->view->render('unit_form',$data_page);
    }

    public function delete($data){
        if(isset($data['id'])){
            $unit_id=$data['id'];
            $unit=new UnitAdmin();
            $unit_info=$this->findOne($unit_id);
            if(!empty($unit_info)){
                if($unit->delete($unit_info)){
                    header("Location:/units");
                }
                return false;
            }
          
        }
    }
    


}

?>