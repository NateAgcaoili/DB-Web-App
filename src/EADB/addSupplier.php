<?php

if (isset($_POST['submit'])){
  require "config.php";

  try{
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "INSERT INTO supplier (supplier_id, company_name, contact_information, address)
            VALUES (:supplier_id, :company_name, :contact_information, :address)
           ";
    $stmt = $connection->prepare($sql);
    $stmt ->bindParam(':supplier_id', $_REQUEST['supplier_id']);
    $stmt ->bindParam(':company_name', $_REQUEST['company_name']);
    $stmt ->bindParam(':contact_information', $_REQUEST['contact_information']);
    $stmt ->bindParam(':address', $_REQUEST['address']);


    $stmt->execute();
    echo "New record created!";

  }catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php include "templates/header.php"; ?>
  <h2>Add a supplier</h2>

  <form method="post">
      <label for="supplier_id">Supplier ID</label>
      <input type="number" name="supplier_id" id="supplier_id">
      <label for="company_name">Company Name</label>
      <input type="text" name="company_name" id="company_name">
      <label for="contact_information">Contact Information</label>
      <input type="email" name="contact_information" id="contact_information">
      <label for="address">Address</label>
      <input type="text" name="address" id="address">
      <input type="submit" name="submit" value="Submit">
  </form>

  <a href="supplierOperations.php">Back to Supplier Operations</a>
  <hr>
  <a href="index.php">Back to Homepage</a>

  <?php include "templates/footer.php"; ?>
