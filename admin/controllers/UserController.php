<?php
require_once "models/UserAdmin.php";

class UserController extends Controller{

    public function index(){
        $data_page=array();

        $user=new UserAdmin();
        $data_page['users']=$user->getList();       

        // var_dump($data_page['users']);

        $this->view->render('users',$data_page);

    }

    

}
?>