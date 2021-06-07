<?php
// підключчення файла 
include_once 'controllers/IndexController.php';

class Route{
    // функція для отримання мітки Uri
    private static function getUri(){
        return $_SERVER['REQUEST_URI'];
    }

    // функція для маршрутизації
    public static function start(){
        // глобальна змінна routes
        global $routes;
        // отримання мітки Uri
        $uri=self::getUri();
        /**http://teastore/
        http://teastore/products
        http://teastore/product/index
        http://teastore/product?product_id=5
        http://teastore/product?product_id=5&category_id=3 */
        // назва контролера
        $controller='IndexController';
        // назва дії
        $action='index';
        // обробка готової адресової стрічки
        // розділення на адресу і параметри
        $array_uri=explode('?',$uri);
        if(isset($routes[$array_uri[0]])){ 
                    //  розділення на контрольну частину і діючу  
            $exp=explode('/',$routes[$array_uri[0]]);
            // $exp[0] - контролер, $exp[1]->action
            $class_name= ucfirst($exp[0]).'Controller';//exp, ProductController
            $path='controllers/'.$class_name.'.php';
            // $class_controller=new IndexController();
            // $action='index';
            if(file_exists($path)){
                include_once($path);
                if(class_exists($class_name)){     
                    $controller = $class_name; 
                    if(isset($exp[1]) && method_exists($controller,$exp[1])){
                        $action=$exp[1];

                    }
                }                  
            }
        }
        // обробка параметрів
        // формування пустого масиву 
        $array_param=array();
        // $array_uri[1] параметри
        if(isset($array_uri[1]) && !empty($array_uri[1])){
            // розділення параметрів
            $params=explode('&',$array_uri[1]);  
                    //обробка через цикл результату   
            foreach($params as $param){
                // виділення ключа і значення
                $array=explode('=',$param);
                // надання масиву знначення по ключу
                $array_param[$array[0]]=$array[1];
            }
        }
        $object_controller=new $controller();
        // звернення до змінної 
        $object_controller->$action($array_param);    
        }
}
?>