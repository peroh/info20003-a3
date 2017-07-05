<html>
<head>
  <title>Item Details</title>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css" type="text/css" >
  <link rel="stylesheet" href="main.css" type="text/css" >
</head>
<body>
  <div class="container">
    <div class="flex-outer">
      <h1>Item Details</h1>
      <form><li><input type='button' value='Back' onClick='history.go(-1);return true;'/></li></form>
    </div>
  </div>
  </br>

<?php

//establish conection
$con = mysqli_connect("info20003db.eng.unimelb.edu.au","mperrott","mperrott_2016","mperrott");

//search for all details of particular spatula clicked. use GET to get idSpatula from URL
$sql_string = "SELECT * FROM Spatula WHERE idSpatula = " . $_GET['idSpatula'];
$result = mysqli_query($con, $sql_string);

//create table to display detailed results
echo "<div class='container'><div class='flex-outer'>";
echo "<table>";
echo "<tr><td><p>Spatula ID</p></td><td><p>Name</p></td><td><p>Type</p></td><td><p>Size</p></td><td><p>Colour</p></td><td><p>Price</p></td><td><p>Quantity</p></td></tr>";

while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td><p>" . $row['idSpatula'] . "</p></td>";
  echo "<td><p>" . $row['ProductName'] . "</p></td>";
  echo "<td><p>" . $row['Type'] . "</p></td>";
  echo "<td><p>" . $row['Size'] . "</p></td>";
  echo "<td><p>" . $row['Colour'] . "</p></td>";
  echo "<td><p>" . $row['Price'] . "</p></td>";
  echo "<td><p>" . $row['QuantityInStock'] . "</p></td>";
  echo "</tr>";
}
echo "</table></div></div>";

//close connection
mysqli_close($con);

 ?>

</body>
</html>
