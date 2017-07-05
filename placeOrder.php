<html>
<head>
  <title>placeOrder</title>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css" type="text/css" >
  <link rel="stylesheet" href="main.css" type="text/css" >
</head>
<body>

  <?php

  $con = mysqli_connect("127.0.0.1", "my_user", "my_password", "my_db";

  //get distinct number of items in stock
  $result = mysqli_query($con, "SELECT COUNT(DISTINCT idSpatula)  FROM Spatula WHERE QuantityInStock>0");
  //save number of distinct items to a variable
  $items = mysqli_fetch_row($result);

  //select all spatulas that are in stock
  $result = mysqli_query($con, "SELECT idSpatula, QuantityInStock, ProductName FROM Spatula WHERE QuantityInStock>0");

  //create array to store spatula id's, item names and original quantities in stock
  $idArray = [];
  $nameArray = [];
  $oldQuantityArray = [];

  //store each orders id and original quantities in seperate arrays
  while($row = mysqli_fetch_array($result)) {
    array_push($idArray, $row['idSpatula']);
    array_push($oldQuantityArray, $row['QuantityInStock']);
    array_push($nameArray, $row['ProductName']);
  }

  //create array to store new quantities
  $newQuantityArray = [];

  //for each item store new quantity in an array
  for ($i = 1; $i <= $items[0]; $i++) {
    $orderQuantity = trim(stripslashes(htmlspecialchars($_POST['OrderQuantity' . $i])));
    array_push($newQuantityArray, $orderQuantity);
  }

  //create array to store errors and item order
  $error = [];
  $orderItem = [];

  //don't commit any queries until error checks have been made
  mysqli_autocommit($con, FALSE);

  //flag to check for first item in order
  $firstCheck = FALSE;

  //loop through each item in stock
  for ($i = 0; $i < $items[0]; $i++) {
    //check if quantity ordered is greater than what is in stock
    if ($oldQuantityArray[$i] < $newQuantityArray[$i]) {
      //if so, store an error outlining which item is out of stock and by how much
      array_push($error, "<p>Sorry! Not enough stock of ItemID = " . $idArray[$i] .
      ".</br>You have tried to order " . $newQuantityArray[$i] .
      " but there are only " . $oldQuantityArray[$i] . " left in stock.</p>");
      //break loop as transaction shouldn't complete
      break;
    }
    //check if an item has been ordered
    if ($newQuantityArray[$i] > 0) {
      //check if it is the first item ordered
      if($firstCheck==FALSE) {
        $firstCheck = TRUE;
        //create a new order
        $responsibleStaffMember = trim(stripslashes(htmlspecialchars($_POST['ResponsibleStaffMember'])));
        $customerDetails = trim(stripslashes(htmlspecialchars($_POST['CustomerDetails'])));
        $insertOrder = mysqli_query($con, "INSERT INTO `Order` VALUES (DEFAULT, CURRENT_TIMESTAMP(),'" . $responsibleStaffMember . "','" . $customerDetails . "')");
        //if order insertion isn't successful, store an error
        if ($insertOrder == FALSE) {
          array_push($error, 'Something went wrong inserting the order. Please check all fields entered are correct.');
        }
        //store the order id to variable to use in each order line item
        $id = mysqli_insert_id($con);
      }
      //reduce stock by amount ordered
      $updateStock = mysqli_query($con, "UPDATE Spatula SET QuantityInStock=(QuantityInStock-" . $newQuantityArray[$i] . ") WHERE idSpatula=" . $idArray[$i]);
      if ($updateStock == FALSE) {
        array_push($error, 'Something went wrong with updating the stock. Please check stock and order again.');
      }
      //insert line item for the order
      $insertLine = mysqli_query($con, "INSERT INTO OrderLineItem VALUES($idArray[$i], $id, $newQuantityArray[$i])");
      if ($insertLine == FALSE) {
        array_push($error, 'Something went wrong with one of the spatulas. Please check all fields entered are correct.');
      }
      //print what was ordered
      array_push($orderItem, "<p> - " . $newQuantityArray[$i] . " x " . $nameArray[$i] . "</br></p>");
    }
  }

  echo "<div class='container'><div class='flex-outer'>";

  //if no errors, commit complete the order
  if (empty($error)&&empty($orderItem)) {
    echo "<p>Nothing ordered! Please enter a quantity.</br></p>";
    echo "<form><li><input type='button' value='Try again' onClick='history.go(-1);return true;'/></li></form>";
  }
  else if (empty($error)) {
    mysqli_commit($con);
    echo "<p>Receipt:</br></p>";
    foreach($orderItem as $o) {
      echo $o;
    }
    echo "<form action='orders.php'><li><input type='submit' value='Back to orders'/></li></form>";
  }
  //if there are errors, rollback queries and print error messages
  else {
    mysqli_rollback($con);
    foreach($error as $e) {
      echo "<p>Error: " . $e . "</br></p>";
    }
    echo "<form><li><input type='button' value='Try again' onClick='history.go(-1);return true;'/></li></form>";
  }

  echo "</div></div>";

  //reset autocommit
  mysqli_autocommit($con, TRUE);

  //close db connection
  mysqli_close($con);

  ?>

  <!-- <a href='orders.php'>back to Orders</a> -->

</body>
</html>
