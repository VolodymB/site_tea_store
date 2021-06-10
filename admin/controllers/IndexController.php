<?php
    require_once 'models/User.php';

 class IndexController extends Controller{
    
    public function index(){
        $user=new User();
        if($user->admin()){            
            return $this->view->render('index');            
        }else{
            $this->login();
        }
        
    }

    public function login(){
        if(isset($_POST['email']) && !empty($_POST['email'])){
           if(isset($_POST['password']) && !empty($_POST['password'])){
                $user=new User();
                $email=$_POST['email'];
                $password=$_POST['password'];
                if($user->login($email,$password)){
                    header("Location:/index");
                }
           }
        }
        return $this->view->renderPart('login');
    }

    public function logout(){
        $user=new User();
        $user->logout();
        header("Location:/login");
    }
 }
?>