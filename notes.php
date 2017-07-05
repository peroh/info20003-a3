<?php //orders.php

$con = mysqli_connect("127.0.0.1", "my_user", "my_password", "my_db";

if (mysqli_connect_errno()) {
	echo "Could not connect to MySQL for the following reason: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM Spatula WHERE QuantityInStock > 0");

echo "<table id='orderTable'>";

while($row = mysqli_fetch_array($result)) {
  	echo "<tr>";
  	echo "<td>" . $row['ProductName'] . "</td>";
    echo "</tr>";

echo "</table>";

mysqli_close($con);

?>

<?php



 ?>

<?php //browse.php

$con = mysqli_connect("info20003db.eng.unimelb.edu.au","mperrott","mperrott_2016","mperrott");

if (mysqli_connect_errno()) {
	echo "Could not connect to MySQL for the following reason: " . mysqli_connect_error();
}

echo "<form method='post' action='searchResult.php?go' id='searchForm'>";

echo "<input type='text' name='name'/>";

$result = mysqli_query($con, "SELECT DISTINCT type FROM Spatula");

echo "<select required='required' name='type'>";

while($row = mysqli_fetch_array($result)) {
	echo "<option value='" . $row['type'] . "'>";
	echo $row['type'];
}
echo "</select>";

echo "<input type='submit' value='Search'/>";

echo "</form>";

 ?>

 <?php //searchresult.php

$con = mysqli_connect("info20003db.eng.unimelb.edu.au","mperrott","mperrott_2016","mperrott");

$name = trim(stripslashes(htmlspecialchars($_POST['name'])));

$query = "SELECT * FROM Spatula WHERE Type = '" . $_POST['type'] . "'";

if(!empty($_POST['type'])) {
  $query .= "AND ProductName LIKE '" . $name . "%' ";
}

$result = mysqli_query($con, $query);

echo "<table>";

while($row = mysqli_fetch_array($result)) {
  echo "<tr><td>";
  echo "<a href='searchDetail.php?idSpatula=" . $row['idSpatula'] . "'>" . $row['ProductName'] . "</a></br>";
  echo "</td></tr>";
}

echo "</table>";

mysqli_close($con);

  ?>
