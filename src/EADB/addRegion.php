<?php

if (isset($_POST['submit'])){
  require "config.php";

  try{
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "INSERT INTO region (region_id, region_name, region_sales)
            VALUES (:region_id, :region_name, :region_sales)
           ";
    $stmt = $connection->prepare($sql);
    $stmt ->bindParam(':region_id', $_REQUEST['region_id']);
    $stmt ->bindParam(':region_name', $_REQUEST['region_name']);
    $stmt ->bindParam(':region_sales', $_REQUEST['region_sales']);


    $stmt->execute();
    echo "New record created!";

  }catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php include "templates/header.php"; ?>
  <h2>Add a region</h2>

  <form method="post">
      <label for="region_id">Region ID</label>
      <input type="number" name="region_id" id="region_id">
      <label for="region_name">Region Name</label>
      <input type="text" name="region_name" id="region_name">
      <label for="region_sales">Region Sales</label>
      <input type="text" name="region_sales" id="region_sales">
      <input type="submit" name="submit" value="Submit">
  </form>

  <a href="regionOperations.php">Back to Region Operations</a>
  <hr>
  <a href="index.php">Back to Homepage</a>

  <?php include "templates/footer.php"; ?>
