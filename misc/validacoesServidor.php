<?php 

    function verificarnome($str) {
        if (strlen($str) < 5) {
            return false;
        }
            return true;
    
    }

    function verificarpreco($str) {
        if (is_numeric($str)) {
            return true;
        } else {
            return false;
        }
    }

    function verificarphoto() {
        if(!file_exists($_FILES['photo']['tmp_name']) || !is_uploaded_file($_FILES['photo']['tmp_name'])) {
            return false;
        } else{
            return true;
        }
}


    function verificaremail($str) {
        if (!$str) {
            return false;
        } else {
            return true;
        } 
    }

    function verificarsenha($str) {
        if (strlen($str) < 6) {
            return false;
        } else {
            return true;
        }
    }

?>


