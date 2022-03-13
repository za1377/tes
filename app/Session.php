<?php
namespace App;

class Session{

    public function __construct(){
        if(!isset($_SESSION) ){
            $this->init_session();
        }
    }
    
    public function init_session(){
        session_start();
    }
    
    public function push($key, $value)
    {
        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = array();
        }
        array_push($_SESSION[$key],$value);
        
    }

    public function pop($key)
    {
        if(!empty($_SESSION[$key]) ){
            return $_SESSION[$key];
        }
    }

    public function del_obj($key,$value)
    {
        foreach ($_SESSION[$key] as $row) {
            if($row['name']==$value){
                $test = array_search($row, $_SESSION[$key]);
                unset($_SESSION[$key][$test]);
            }
        }
    }

    public function del_all()
    {
        session_unset();
        session_destroy();
    }

}