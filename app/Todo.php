<?php
namespace App;

class Todo{
    public function index()
    {
        $object_session = new Session;
        $arr = $object_session->pop('array');
        foreach ($arr as $row) {
            echo '<html>
                    <body>
                        <div style="border:1px solid black;padding: 10px;width: 20%;margin: 1%;display: flex; justify-content: space-around;">
                            <form action="/todo/delete" method="post" style="display: flex;">
                                <input name="name_delete" value='.$row['name'].' style="border:none;" readonly>
                                <input type="submit" name="delete" style="margin: 2%;" value="delete"/>
                            </form>
                            <form action="/todo/toggle" method="post">
                                <input name="name_undo" value='.$row['name'].' style="border:none; display:none;">
                                <input type="submit" name="toggle" style="margin: 2%;" value='.$row['toggle'].'>
                            </form>
                        </div>
                    </body>';
        }
    }
    
    private function redirect($url)
    {
        if (!headers_sent()){
            header("Location: $url");
        }else{
            echo "<script type='text/javascript'>window.location.href='$url'</script>";
            echo "<noscript><meta http-equiv='refresh' content='0;url=$url'/></noscript>";
        }
        exit;
    }

    public function add()
    {
        $object_session = new Session;
        if(!empty($_POST['name'])){
            $value = array("name"=>$_POST['name'],"toggle"=>'Done');
            $object_session->push('array',$value);
        }
        $this->redirect('http://localhost:8000/');
    }

    public function delete()
    {
        $object_session = new Session;
        $object_session->del_obj('array',$_POST['name_delete']);
        $this->redirect('http://localhost:8000/');
    }

    public function toggle()
    {
        $object_session = new Session;
        $arr = $object_session->pop('array');
        foreach ($arr as $row) {
            if($row['name']==$_POST['name_undo']){
                if($row['toggle']=='Done'){
                    $test = array_search($row, $_SESSION['array']);
                    $_SESSION['array'][$test]['toggle']='Undo';
                }else{
                    $test = array_search($row, $_SESSION['array']);
                    $_SESSION['array'][$test]['toggle']='Done';
                }
            }
        }
        $this->redirect('http://localhost:8000/');
    }
}
