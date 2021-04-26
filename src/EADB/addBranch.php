<?php

if (isset($_POST['submit'])){
  require "config.php";

  try{
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "INSERT INTO branch (branch_id, branch_name, branch_head_id, region_id)
            VALUES (:branch_id, :branch_name, :branch_head_id, region_id)
           ";
    $stmt = $connection->prepare($sql);
    $stmt ->bindParam(':branch_id', $_REQUEST['branch_id']);
    $stmt ->bindParam(':branch_name', $_REQUEST['brancht_name']);
    $stmt ->bindParam(':branch_head_id', $_REQUEST['branch_head_id']);
    $stmt ->bindParam(':region_id', $_REQUEST['region_id']);


    $stmt->execute();
    echo "New record created!";

  }catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php include "templates/header.php"; ?>
  <h2>Add a branch</h2>

  <form method="post">
      <label for="branch_id">Branch ID</label>
      <input type="number" name="branch_id" id="branch_id">
      <label for="branch_name">Branch Name</label>
      <input type="text" name="branch_name" id="branch_name">
      <label for="brancht_head_id">Branch Head ID</label>
      <input type="text" name="branch_head_id" id="branch_head_id">
      <label for="region_id">Region ID</label>
      <input type="number" name="region_id" id="region_id">
      <input type="submit" name="submit" value="Submit">
  </form>

  <a href="branchOperations.php">Back to Branch Operations</a>
  <hr>
  <a href="index.php">Back to Homepage</a>

  <?php include "templates/footer.php"; ?>
