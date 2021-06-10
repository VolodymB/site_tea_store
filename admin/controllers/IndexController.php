<?php
    require_once 'models/User.php';
    

 class IndexController extends Controller{

    public $user;


    public function __construct(){
        $this->view=new View();
        $this->model=new Model();
        $this->user=new User();
    }

    public function index(){
        if($this->user->admin()){            
            return $this->view->render('index');            
        }else{
            $this->login();
        }

        
    }

    public function login(){
        if(isset($_POST['email']) && !empty($_POST['email'])){
           if(isset($_POST['password']) && !empty($_POST['password'])){
                $email=$_POST['email'];
                $password=$_POST['password'];
                if($this->user->login($email,$password)){
                    header("Location:/index");
                }
           }
        }
        return $this->view->renderPart('login');
    }

    public function logout(){
        $this->user->logout();
        header("Location:/login");
    }
 }
?>