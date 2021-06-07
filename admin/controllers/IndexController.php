<?php

 class IndexController extends Controller{

    public function index(){
        return $this->view->render('index');
    }

    public function login(){
        return $this->view->renderPart('login');
    }
 }
?>