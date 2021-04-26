<?php

if (isset($_POST['submit'])){
  require "config.php";

  try{
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "INSERT INTO products (product_id, product_name, price_per_unit, inventory)
            VALUES (:product_id, :product_name, :price_per_unit, :inventory)
           ";
    $stmt = $connection->prepare($sql);
    $stmt ->bindParam(':product_id', $_REQUEST['product_id']);
    $stmt ->bindParam(':product_name', $_REQUEST['product_name']);
    $stmt ->bindParam(':price_per_unit', $_REQUEST['price_per_unit']);
    $stmt ->bindParam(':inventory', $_REQUEST['inventory']);


    $stmt->execute();
    echo "New record created!";

  }catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php include "templates/header.php"; ?>
  <h2>Add a products</h2>

  <form method="post">
      <label for="product_id">Product ID</label>
      <input type="number" name="product_id" id="product_id">
      <label for="product_name">Product Name</label>
      <input type="text" name="product_name" id="product_name">
      <label for="price_per_unit">Price Per Unit</label>
      <input type="number" name="price_per_unit" id="price_per_unit">
      <label for="inventory">Inventory</label>
      <input type="number" name="inventory" id="inventory">
      <input type="submit" name="submit" value="Submit">
  </form>

  <a href="productOperations.php">Back to Product Operations</a>
  <hr>
  <a href="index.php">Back to Homepage</a>

  <?php include "templates/footer.php"; ?>
