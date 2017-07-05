<html>
<head>
  <title>Browse</title>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css" type="text/css" >
  <link rel="stylesheet" href="main.css" type="text/css" >
</head>
<body>

  <div class="container">
    <div class="flex-outer">
      <h1>Browse</h1>
      <form action="index.php"><li><input type='submit' value='Home'/></li></form>
    </div>
  </div>

<?php

//establish connection to db
$con = mysqli_connect("127.0.0.1", "my_user", "my_password", "my_db";

// Check connection
if (mysqli_connect_errno()) {
	echo "Could not connect to MySQL for the following reason: " . mysqli_connect_error();
}

echo "<div class='container'>";
//create form
echo "<form method='post' action='searchResult.php?go' id='searchForm'>";
echo "<ul class='flex-outer'>";
echo "<li>";
echo "<label>Spatula name</label>";
echo "<input type='text' name='name'/>";
echo "</li>";

//get types of spatulas from db
$result = mysqli_query($con, "SELECT DISTINCT type FROM Spatula");

echo "<li>";
echo "<label>Spatula Type*</label>";
echo "<select required='required' name='type'>";
echo "<option value='' selected disabled>Select Type</option>";
//display spatula types as dropdown
while($row = mysqli_fetch_array($result)) {
	echo "<option value='" . $row['type'] . "'>";
	echo $row['type'];
	echo "</option>";
}
echo "</select>";
echo "</li>";

echo "<li>";
echo "<label>Size:</label>";
echo "<input type='text' name='size'/>";
echo "</li>";

echo "<li>";
echo "<label>Colour</label>";
echo "<input type='text' name='colour'/>";
echo "</li>";

echo "<li>";
echo "<label style='display:inline'>Price (\$AU)</label>";
echo "<input type='text' name='price'/>";
echo "</li>";

echo "<li>";
echo "<input type='submit' value='Search'/>";
echo "</li>";
echo "</ul>";
echo "</form>";
echo "</div>";

 ?>

</body>
</html>
