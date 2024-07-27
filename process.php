<?php
//validation 
$err_fields = array();
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

//open conn
$conn = mysqli_connect("localhost", "root", "", "blog" );
if (! $conn) {
    echo mysqli_connect_error();
    exit;
}

//escape any special chars to avoid sql inj
$name = mysqli_escape_string($conn, $_POST['name']);
$email = mysqli_escape_string($conn, $_POST['email']);
$password = mysqli_escape_string($conn, $_POST['password']);
//insesrt data
$query = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('.$name.', '.$email.', sha1('.$password.'))";
if (mysqli_query($conn, $query)){
    echo "thank you your info has been saved";
}else {
    echo $query; //for deugging not for real env
    echo mysqli_error($conn);
}


//free result from memory &  close conn
mysqli_close($conn);

?>
