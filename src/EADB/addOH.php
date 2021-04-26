<?php

if (isset($_POST['submit'])){
  require "config.php";

  try{
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "INSERT INTO order_history (customer_id, order_id, product_id, order_date, delivery_date)
            VALUES (:customer_id, :order_id, :product_id, :order_date, :delivery_date)
           ";
    $stmt = $connection->prepare($sql);
    $stmt ->bindParam(':customer_id', $_REQUEST['customer_id']);
    $stmt ->bindParam(':order_id', $_REQUEST['order_id']);
    $stmt ->bindParam(':product_id', $_REQUEST['product_id']);
    $stmt ->bindParam(':order_date', $_REQUEST['delivery_date']);
    $stmt ->bindParam(':delivery_date', $_REQUEST['delivery_date']);


    $stmt->execute();
    echo "New record created!";

  }catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php include "templates/header.php"; ?>
  <h2>Add an order history entry</h2>

  <form method="post">
      <label for="customer_id">Customer ID</label>
      <input type="number" name="customer_id" id="customer_id">
      <label for="order_id">Order ID</label>
      <input type="number" name="order_id" id="order_id">
      <label for="product_id">Product ID</label>
      <input type="number" name="product_id" id="product_id">
      <label for="order_date">Ordre Date</label>
      <input type="date" name="order_date" id="order_date">
      <label for="delivery_date">Delivery Date</label>
      <input type="date" name="delivery_date" id="delivery_date">
      <input type="submit" name="submit" value="Submit">
  </form>

  <a href="orderHistoryOperations.php">Back to Order History Operations</a>
  <hr>
  <a href="index.php">Back to Homepage</a>

  <?php include "templates/footer.php"; ?>
