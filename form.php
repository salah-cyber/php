<?php
//check for errors
$err_arr = array();
if (isset($_GET['err_fields'])) { //err_fields came from redirect from process.php
    $err_arr = explode(",",$_GET['err_fields'] );
}
?>


<html>
    <body>
        <form method="post" action="process.php" >
        <label for="name">Name</label><input type="text" name="name" id="name"> 
            <?php if(in_array("name", $err_arr)){echo "please enter your name";}?><br>
        <label for="email">email</label><input type="email" name="email" id="email"> 
            <?php if(in_array("email", $err_arr)){echo "please enter your email";}?><br>
        <label for="email">password</label><input type="password" name="password" id="password"> 
            <?php if(in_array("password", $err_arr)){echo "please enter pass not less than 6 char";}?><br>
        <label for="gender">gender</label><br>
        <input type="radio" name="gender" value="male">male <br>
        <input type="radio" name="gender" value="femail">femmale <br>
        <input type="submit" name="submit" value="register"> <br>

        </form>
    </body>
</html>