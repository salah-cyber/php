<?php
    // check first if user enter name and email
    if(isset($_POST["name"]) && !empty($_POST["name"])){
        echo $_POST["name"];
    }else{
        echo "من فضلك ادخل الاسم";
        echo "<br>";
    }
    if(isset($_POST["email"]) && !empty($_POST["email"])){
        echo $_POST["email"];
    }else{
        echo "من فضلك ادخل الايمل";
    }
?>
