<html>
<head>
  <title>Search Result</title>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css" type="text/css" >
  <link rel="stylesheet" href="main.css" type="text/css" >
</head>
<body>

  <div class="container">
    <div class="flex-outer">
      <h1>Search Results</h1>
      <form><li><input type='submit' value='Back' onClick='history.go(-1);return true;'/></li></form>
    </div>
  </div>

<?php

$con = mysqli_connect("info20003db.eng.unimelb.edu.au","mperrott","mperrott_2016","mperrott");

//validate form input to prevent sql injections
$name = trim(stripslashes(htmlspecialchars($_POST['name'])));
$price = trim(stripslashes(htmlspecialchars($_POST['price'])));
$size = trim(stripslashes(htmlspecialchars($_POST['size'])));
$colour = trim(stripslashes(htmlspecialchars($_POST['colour'])));

//query requires a spatula type
$query = "SELECT * FROM Spatula WHERE Type = '" . $_POST['type'] . "'";

//also search by name if input exists
if(!empty($_POST['type'])) {
  $query .= "AND ProductName LIKE '" . $name . "%' ";
}

//also search by price if input exists
if(!empty($_POST['price'])) {
  $query .= "AND Price = '" . $price . "%' ";
  echo "<p>Test</p>";
}

//also search by size if input exists
if(!empty($_POST['size'])) {
  $query .= "AND Size = '" . $size . "'";
}

//also search by colour if input exists
if(!empty($_POST['colour'])) {
  $query .= "AND Colour = '" . $colour . "'";
}

$result = mysqli_query($con, $query);

echo "<div class='container'><div class='flex-outer'>";
echo "<table>";
//loop through each spatula in stock
while($row = mysqli_fetch_array($result)) {
  echo "<tr><td>";
  echo "<a href='searchDetail.php?idSpatula=" . $row['idSpatula'] . "'>" . $row['ProductName'] . "</a></br>";
  echo "</td></tr>";
}

echo "</table>";
echo "</div></div>";

mysqli_close($con);

 ?>

</body>
</html>
