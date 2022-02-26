<?php

    class App{

        protected $controller="Home";
        protected $action="Default";
        protected $params = [];

        function __construct()
        {
            $arr = $this->UrlProcess();

            //Controller
            if( file_exists("./mvc/controllers/".$arr[0].".php")){
                $this->controller=$arr[0];
                unset($arr[0]);
            }
            require_once "./mvc/controllers/".$this->controller.".php";
            $this->controller = new $this->controller;

            //Action
            if(isset($arr[1])){
                if( method_exists($this->controller, $arr[1])){
                    $this->action = $arr[1];
                }
                unset($arr[1]);
            }

            //params
            $this->params = $arr? array_values($arr) : [];

            //Gọi class và method mặc định khi trang web chạy
            call_user_func_array([$this->controller, $this->action], $this->params );
            
        }

        //hàm lấy url về loại bỏ ký tự lạ và cắt ra thành mảng
        function UrlProcess(){
            if( isset($_GET["url"]) ){
                return explode("/", filter_var( trim( $_GET["url"], "/" ) ) );
            }
        }



    }

?>