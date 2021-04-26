<?php

if (isset($_POST['submit'])){
  require "config.php";

  try{
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "INSERT INTO employee (employee_id, first_name, last_name, birth_date, sex, salary, super_id, department_id, branch_id)
            VALUES (:employee_id, :first_name, :last_name, :birth_date, :sex, :salary, :super_id, :department_id, :branch_id)
           ";
    $stmt = $connection->prepare($sql);
    $stmt ->bindParam(':employee_id', $_REQUEST['employee_id']);
    $stmt ->bindParam(':first_name', $_REQUEST['first_name']);
    $stmt ->bindParam(':last_name', $_REQUEST['last_name']);
    $stmt ->bindParam(':birth_date', $_REQUEST['birth_date']);
    $stmt ->bindParam(':sex', $_REQUEST['sex']);
    $stmt ->bindParam(':salary', $_REQUEST['salary']);
    $stmt ->bindParam(':super_id', $_REQUEST['super_id']);
    $stmt ->bindParam(':department_id', $_REQUEST['department_id']);
    $stmt ->bindParam(':branch_id', $_REQUEST['branch_id']);

    $stmt->execute();
    echo "New record created!";

  }catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php include "templates/header.php"; ?>
  <h2>Add a user</h2>

  <form method="post">
      <label for="employee_id">Employee ID</label>
      <input type="number" name="employee_id" id="employee_id">
      <label for="first_name">First Name</label>
      <input type="text" name="first_name" id="first_name">
      <label for="last_name">Last Name</label>
      <input type="text" name="last_name" id="last_name">
      <label for="birth_date">D.O.B.</label>
      <input type="date" name="birth_date" id="birth_date">
      <label for="sex">Sex</label>
      <input type="text" name="sex" id="sex">
      <label for="salary">Salary</label>
      <input type="number" name="salary" id="salary">
      <label for="super_id">Supervisor ID</label>
      <input type="number" name="super_id" id="super_id">
      <label for="department_id">Department ID</label>
      <input type="number" name="department_id" id="department_id">
      <label for="branch_id">Branch ID</label>
      <input type="number" name="branch_id" id="branch_id">
      <input type="submit" name="submit" value="Submit">
  </form>

  <a href="employeeOperations.php">Back to Employee Operations</a>
  <hr>
  <a href="index.php">Back to Homepage</a>

  <?php include "templates/footer.php"; ?>
