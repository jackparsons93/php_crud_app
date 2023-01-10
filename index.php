<link rel="stylesheet" href="style.css">
<h1>List of Users id with names</h1>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sql="SELECT * FROM users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo '<div class="content">';
	while($row = $result->fetch_assoc()) {
		echo "<h4>";
		echo "id: " . $row["id"]. " - Name: " . $row["name"];
		$id=$row['id'];
		echo "</h4>";
		echo '<form method="post">';
		echo '<button type="submit" name="button1" class="button" value=' . $id . '> DELETE </button>';
		echo "</form>";
	}
	echo '</div>';
	} else {
	echo "0 results";
	}

if(array_key_exists('button1', $_POST)) {
	global $conn;
	$id= $_POST["button1"];
	$sql = "DELETE FROM users WHERE ID=$id";
	if ($conn->query($sql) === TRUE) {
		echo "Record deleted successfully";
		header("Refresh:0");
	  } else {
		echo "Error deleting record: " . $conn->error;
	  }
}
echo "<h2> Insert user into DB below </h2>";
if(array_key_exists('name', $_POST)) {
	global $conn;

	$name=$_POST['name'];
	$sql="INSERT INTO users (name) VALUES ('$name')";
	if ($conn->query($sql) === TRUE) {
		echo "Record inserted successfully";
		header("Refresh:0");
	  } else {
		echo "Error inserting record: " . $conn->error;
	  }
	 $conn->close();
}

?>

<form method="post">
<input type="text" name="name" value="name" />
<input type="submit" name="insert"
		class="button" value="insert data into DB" />
</form>


<h2> Update user from DB below </h2>
<form method="post">
<label for="id_select" class="id_select">SELECT ID TO UPDATE</label>

<select  name="id_select" id="id_select">
<?php
$sql="SELECT * FROM users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

  
  while($row = $result->fetch_assoc()) {
	$id=$row['id'];
	echo '<option value=' . $id . '>' . $id . '</option>';
	}
}
if(array_key_exists('update', $_POST)) {
	
	$id= $_POST['id_select'];
	$update=$_POST['updater'];
	
	$sql="UPDATE users SET name='$update' WHERE id=($id)";
	if ($conn->query($sql) === TRUE) {
		//echo "Record updated successfully";
		header("Refresh:0");
	  } else {
		echo "Error updating record: " . $conn->error;
	  }
	  
}
?>
</select>
<button type="submit" name="update" class="button2">UPDATE</button>
<input type="text" name="updater" value="NEW NAME" />
</form>

<?php 

