<?php
// add user 
// 1- drawing from
// 2- connect to dba_close
// 3- data validation 
// 4- user checked admin or not
// 5- insert statement
// 6- executing and redirect
?>



<?php
$err_fields = array();
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    //validation 
    if (! (isset($_POST['name']) && !empty($_POST['name'])) ) {
        $err_fields[] = "name"; // append field name to array
    }
    if (! (isset($_POST['email']) && filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) ) {
        $err_fields[] = "email";
    }
    if (! (isset($_POST['password']) && strlen($_POST['password']) > 5) ) {
        $err_fields[] = "password";
    }
    if ($err_fields) {
        //redrect
        header("Location: form.php?err_fields=".implode(",", $err_fields));
        exit;
    }
    
    if (!$err_fields) {
        
        //open conn
        $conn = mysqli_connect("localhost", "root", "", "blog" );
        if (! $conn) {
            echo mysqli_connect_error();
            exit;
        }
 
    
//escape any special chars to avoid sql inj
$name = mysqli_escape_string($conn, $_POST['name']);
$email = mysqli_escape_string($conn, $_POST['email']);
$password = sha1($_POST["password"]);
$admin = (isset($_POST['admin'])) ? 1 : 0;
//insesrt data
$query = "INSERT INTO `users` (`name`, `email`, `password`, `admin`) VALUES ('.$name.', '.$email.', '.$password.', '.$admin.')";
if (mysqli_query($conn, $query)){
    header("LOCATION: list.php");
    exit; // best practice to exit after header redirect
}else {
    //echo $query; //for deugging not for real env
    echo mysqli_error($conn);
}


//free result from memory &  close conn
mysqli_close($conn);
}
}
?>
<html>
    <head>
        <title>admin :: LIST Users</title>
    </head>
    <body>
    <form method="post" >
        <label for="name">Name</label><input type="text" name="name" id="name" value="<?= (isset($_POST['name'])) ? $_POST['name']:''?>"> <?php if(in_array("name", $err_fields)){echo "please enter your name";}?><br>
        <label for="email">email</label><input type="email" name="email" id="email" value="<?= (isset($_POST['email'])) ? $_POST['name']:''?>"> <?php if(in_array("email", $err_fields)){echo "please enter your email";}?><br>
        <label for="email">password</label><input type="password" name="password" id="password"> <?php if(in_array("password", $err_fields)){echo "please enter pass not less than 6 char";}?><br>
        <input type="checkbox" name="admin" <?= (isset($_POST['admin'])) ? 'checked':''?>/> admin <br>        
        <input type="submit" name="submit" value="register"> <br>
    </body>
</html