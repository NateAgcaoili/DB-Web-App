<?php

if (isset($_POST['submit'])){
  require "config.php";

  try{
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "INSERT INTO department (department_id, department_name, department_head_id)
            VALUES (:department_id, :department_name, :department_head_id)
           ";
    $stmt = $connection->prepare($sql);
    $stmt ->bindParam(':department_id', $_REQUEST['department_id']);
    $stmt ->bindParam(':department_name', $_REQUEST['department_name']);
    $stmt ->bindParam(':department_head_id', $_REQUEST['department_head_id']);
  

    $stmt->execute();
    echo "New record created!";

  }catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php include "templates/header.php"; ?>
  <h2>Add a department</h2>

  <form method="post">
      <label for="department_id">Department ID</label>
      <input type="number" name="department_id" id="department_id">
      <label for="department_name">Department Name</label>
      <input type="text" name="department_name" id="department_name">
      <label for="department_head_id">Department Head ID</label>
      <input type="text" name="department_head_id" id="department_head_id">
      <input type="submit" name="submit" value="Submit">
  </form>

  <a href="departmentOperations.php">Back to Department Operations</a>
  <hr>
  <a href="index.php">Back to Homepage</a>

  <?php include "templates/footer.php"; ?>
