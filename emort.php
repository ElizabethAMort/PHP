<!DOCTYPE html>
<html>
<head>
<style> table, tr, td {
	border: 1px solid black;
	border-collapse: collapse;
}

th {
	color: red
}
</style>
</head>
<body>

<?php 

//paramters -- please fill in your own!
$servername = "";
$username = "";
$password = "";
$dbName = "";
$conn = mysqli_connect($servername, $username, $password, $dbName);


//check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Welcome to Sweetwater Reports!";

//mySQL statements
$candy = "SELECT comments FROM test2.sweetwater_test where comments like '%cinnamon%' or 
	comments like '%taffy%' or comments like '%smarties%' or comments like '%candy%' or comments like '%tootsie%' or comments like '%honey%';";   //with more knowledge of the candies sent, this could be improved
$referral = "SELECT comments FROM $dbName.sweetwater_test where comments like '%referr%';";
$sign = "SELECT comments FROM $dbName.sweetwater_test where comments like '%sign%';";
$calls = "SELECT comments FROM $dbName.sweetwater_test where comments like '%call%';";
$leftovers = "SELECT  comments FROM $dbName.sweetwater_test where comments not like '%call%' and comments not like '%sign%' and comments not like '%referr%' and comments not like '%candy%' and comments not like '%cinnamon%' and
	comments not like '%taffy%' and comments not like '%smarties%' and comments not like '%tootsie%' and comments not like '%honey%';";

//function to take the mySQL results and create an html table
function buildTable($result, $fname){
	if(mysqli_num_rows($result) > 0){
		echo "<table>";
			echo "<tr>";
				echo "<th>Comments That $fname</th>";
			echo "</tr>";	
			while($row = mysqli_fetch_array($result)){
				echo "<tr>";
				echo "<td>" . $row['comments'] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
			mysqli_free_result($result);
	}else{
		echo "No records found that $fname.";
	}
}

if($result = mysqli_query($conn, $candy)){
	buildTable($result, "Mention Candy");
}else{
		echo "ERROR: Could not execute $candy. " . mysqli_error($link);
	}
	
	if($result = mysqli_query($conn, $referral)){
	buildTable($result, "Mention Referral");
}else{
		echo "ERROR: Could not execute $referral. " . mysqli_error($link);
	}
	
		if($result = mysqli_query($conn, $sign)){
	buildTable($result, "Mention Signatures");
}else{
		echo "ERROR: Could not execute $sign. " . mysqli_error($link);
	}
	
			if($result = mysqli_query($conn, $calls)){
	buildTable($result, "Mention Calls");
}else{
		echo "ERROR: Could not execute $calls. " . mysqli_error($link);
	}
	
				if($result = mysqli_query($conn, $leftovers)){
	buildTable($result, "Don't Meet Other Requirements");
}else{
		echo "ERROR: Could not execute $leftovers. " . mysqli_error($link);
	}
	
//close the connection
mysqli_close($conn);

?>
</body>
</html>

