<?php

if (isset($_POST['submit'])){
  require "config.php";

  try{
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "INSERT INTO customer (customer_id, first_name, last_name, customer_address, contact_information)
            VALUES (:customer_id, :first_name, :last_name, :customer_address, :contact_information)
           ";
    $stmt = $connection->prepare($sql);
    $stmt ->bindParam(':customer_id', $_REQUEST['customer_id']);
    $stmt ->bindParam(':first_name', $_REQUEST['first_name']);
    $stmt ->bindParam(':last_name', $_REQUEST['last_name']);
    $stmt ->bindParam(':customer_address', $_REQUEST['customer_address']);
    $stmt ->bindParam(':contact_information', $_REQUEST['contact_information']);


    $stmt->execute();
    echo "New record created!";

  }catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php include "templates/header.php"; ?>
  <h2>Add a customer profile</h2>

  <form method="post">
      <label for="customer_id">Customer ID</label>
      <input type="number" name="customer_id" id="customer_id">
      <label for="first_name">First Name</label>
      <input type="text" name="first_name" id="first_name">
      <label for="last_name">Last Name</label>
      <input type="text" name="last_name" id="last_name">
      <label for="customer_address">Customer Address</label>
      <input type="text" name="customer_address" id="customer_address">
      <label for="contact_information">Email</label>
      <input type="email" name="contact_information" id="contact_information">
      <input type="submit" name="submit" value="Submit">
  </form>

  <a href="customerOperations.php">Back to Customer Operations</a>
  <hr>
  <a href="index.php">Back to Homepage</a>

  <?php include "templates/footer.php"; ?>
