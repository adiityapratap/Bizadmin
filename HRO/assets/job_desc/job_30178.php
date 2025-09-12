
<?php
use Zend\Http\Response;

public function testArgumentDetails2Action(){

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") { 


    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        exit();
} else { 


  header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        exit();
}

}