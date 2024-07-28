<?php
//this file list all users in db

//connect to sql
$conn = mysqli_connect("localhost", "root", "", "blog" );
if (! $conn) {
    echo mysqli_connect_error();
    exit;
}
//select all users
$query = "select * from users";
$result = mysqli_query($conn, $query); //result contain tables raws u can loop on it
?>
<html>
    <head>
        <title>admin :: LIST Users</title>
    </head>
    <body>
        <h1>list users</h1>
        <!--dissplay a table containing all ussers -->
        <table>
            <thead> 
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>email</th>
                    <th>admin</th>
                    <th>actions</th>
                </tr>
            </thead>
<?php
// loop on raw set
while ($row = mysqli_fetch_assoc($result)) { // mysqli_fetch_assoc() >> return row set as assocative array (dictionary)
?> 
            <tbody>
                <tr>   
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= ($row['admin']) ? 'yes': 'no' ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']?>">edit</a>
                        <a href="delete.php?id=<?= $row['id']?>">delete</a>
                    </td>
                </tr>
            </tbody>
<?php
}
?>
            <tfoot>
                <tr>
                <td colspan="2" style="text-align: center"><?= mysqli_num_rows($result)?> users</td>
                <td colspan="3" style="text-align: center"><a href="add.php">add user</a></td>
                </tr>
            </tfoot>

        </table>
    </body>
</html



<?php
//free result from memory &  close opened conn
mysqli_free_result($result);
mysqli_close($conn);
?>