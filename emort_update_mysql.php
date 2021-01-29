<?php
//parameters -- please fill in your own!
$servername = "";
$username = "";
$password = "";
$dbName = "";
$conn = mysqli_connect($servername, $username, $password, $dbName);


//check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "update test2.sweetwater_test st1, test2.sweetwater_test st2 
set st2.shipdate_expected = str_to_date(substring(substring_index(st1.comments, 'Date:', -1), 1, 9), '%d/%m/%y') 
 where st1.comments like '%expected ship date%' and st1.orderid = st2.orderid;";

if(mysqli_query($conn, $sql)){
    echo "Query completed successfully.";
}else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($conn); 
}


//close the connection
mysqli_close($conn);

?>
