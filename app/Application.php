<?php
namespace App;

class Application
{

    protected $namespase = "App\\";

    
    public function __construct()
    {
        $request= trim($_SERVER['REQUEST_URI'],'/');
        $req = array_reverse(explode("/",$request));
        $ClassMethod = $req[0];
        $ClassName = ucfirst($req[1]);
        if(!empty($ClassName)){
            if(!empty($ClassMethod)){
                $ClassName = $this->namespase . $ClassName;
                $control = new $ClassName;
                $control->$ClassMethod();
            }
            
        }else{
            $class_index = new Todo;
            $class_index->index();
        }
    }
}
