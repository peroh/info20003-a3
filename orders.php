<html>
<head>
  <title>Orders</title>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css" type="text/css" >
  <link rel="stylesheet" href="main.css" type="text/css" >
</head>
<body>
  <div class="container">
    <div class="flex-outer">
      <h1>Orders</h1>
      <form action="index.php"><li><input type='submit' value='Home'/></li></form>
    </div>
  </div>

<?php

//establish connection
$con = mysqli_connect("127.0.0.1", "my_user", "my_password", "my_db";

echo "<div class='container'>";
echo "<div class='flex-outer'>";

// check connection
if (mysqli_connect_errno()) {
	echo "Could not connect to MySQL for the following reason: " . mysqli_connect_error();
}
echo "</div></div>";
echo "<div class='container'>";

//create form linking to placeOrder.php
echo "<form method='POST' action='placeOrder.php'>";
echo "<ul class='flex-outer'>";

//input for customer details
echo "<li>";
echo "<label for='customerDetails'>Customer Details</label>";
echo "<input type='text' name='CustomerDetails' id='customerDetails' required></input>";
echo "</li>";

//input for responsible staff member
echo "<li>";
echo "<label for='staff'>Responsible Staff Member</label>";
echo "<input type='text' id='staff' name='ResponsibleStaffMember' required/>";
echo "</li>";

//create table to display spatulas in stock
echo "<li>";
echo "<table id='orderTable'>";
echo "<tr><th>Spatula ID</th><th>Name</th><th>Type</th><th>Size</th><th>Colour</th><th>Price</th><th>Quantity Currently In Stock</th><th>Order Quantity</th></tr>";

//select all spatulas that are in stock
$result = mysqli_query($con,"SELECT * FROM Spatula WHERE QuantityInStock > 0");

//loop through each spatula in stock
while($row = mysqli_fetch_array($result)) {
  $count = $count + 1;
  //assign each amount ordered to a variable
  $OrderQuantity = "OrderQuantity" . $count;
	echo "<tr>";
	echo "<td>" . $row['idSpatula'] . "</td>";
	echo "<td>" . $row['ProductName'] . "</td>";
  echo "<td>" . $row['Type'] . "</td>";
  echo "<td>" . $row['Size'] . "</td>";
  echo "<td>" . $row['Colour'] . "</td>";
  echo "<td>" . $row['Price'] . "</td>";
  echo "<td>" . $row['QuantityInStock'] . "</td>";
  echo "<td><input type='number' min='0' name='" . $OrderQuantity . "' value='0'/></td>";
	echo "</tr>";
}
echo "</table>";
echo "</li>";
echo "<li>";
echo "<input class='button' type='submit' value='Place Order'/>";
echo "</li></ul></form></div>";

//close connection
mysqli_close($con);

 ?>

</body>
</html>
