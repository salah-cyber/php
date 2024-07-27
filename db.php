<?php

//open conn
$start_conn = mysqli_connect("localhost", "root", "", "blog" );
if (! $start_conn) {
    echo mysqli_connect_error();
    exit;
}
//do queries
$query = "select * from users";
$query_result_row_set = mysqli_query($start_conn, $query);
// mysqli_fetch_assoc() >> return row set as assocative array (dictionary)
while ($row = mysqli_fetch_assoc($query_result_row_set)) {
    echo "id: ".$row['id']."<br>";
    echo "name: ".$row['name']."<br>";
    echo "email: ".$row['email']."<br>";
    echo str_repeat("-", 50)."<br>";
}

//free result from memory &  close conn
mysqli_free_result($query_result_row_set);
mysqli_close($start_conn);
