<?php

if (isset($_POST['submit'])){
  require "config.php";

  try{
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "INSERT INTO sales_relations (branch_id, customer_id, total_sales)
            VALUES (:branch_id, :customer_id, :total_sales)
           ";
    $stmt = $connection->prepare($sql);
    $stmt ->bindParam(':branch_id', $_REQUEST['branch_id']);
    $stmt ->bindParam(':customer_id', $_REQUEST['customer_id']);
    $stmt ->bindParam(':total_sales', $_REQUEST['total_sales']);


    $stmt->execute();
    echo "New record created!";

  }catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php include "templates/header.php"; ?>
  <h2>Add a sales relation</h2>

  <form method="post">
      <label for="branch_id">Branch ID</label>
      <input type="number" name="branch_id" id="branch_id">
      <label for="customer_id">Customer Id</label>
      <input type="number" name="customer_id" id="customer_id">
      <label for="total_sales">Total Sales</label>
      <input type="number" name="total_sales" id="total_sales">
      <input type="submit" name="submit" value="Submit">
  </form>

  <a href="salesRelationsOperations.php">Back to sales relations Operations</a>
  <hr>
  <a href="index.php">Back to Homepage</a>

  <?php include "templates/footer.php"; ?>
