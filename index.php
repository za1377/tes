<?php
require_once('vendor/autoload.php');

echo "<html>  
        <body>

            <form action='/todo/add' method='Post'>
            Name: <input type='text' name='name' placeholder='write here' style='padding:5px;margin: 20px 5px;'><br>
            <input type='submit' style='margin: 0px 19%;'>
            </form>

        </body>";




use App\Application;
$obj = new Application();

