<?php

    require "config.php";
    require "common.php";

    if (isset($_GET["employee_id"])) {
    try {
      $connection = new PDO($dsn, $username, $password, $options);

      $employee_id = $_GET["employee_id"];

      $sql = "DELETE FROM employee WHERE employee_id = :employee_id";

      $statement = $connection->prepare($sql);
      $statement->bindValue(':employee_id', $employee_id);
      $statement->execute();

      $success = "Employee successfully deleted";
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
  }
  try{
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM employee";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();

  }catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
  }
 ?>
 <?php include "templates/header.php"; ?>

 <h2>Delete Employee</h2>
 <table>
  <thead>
    <tr>
      <th>Employee Id</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>D.O.B.</th>
      <th>Sex</th>
      <th>Salary</th>
      <th>Supervisor Id</th>
      <th>Department Id</th>
      <th>Branch Id</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
  <?php
       foreach($result as $row) : ?>
         <tr>
           <td><?php echo escape($row["employee_id"]); ?></td>
           <td><?php echo escape($row["first_name"]); ?></td>
           <td><?php echo escape($row["last_name"]); ?></td>
           <td><?php echo escape($row["birth_date"]); ?></td>
           <td><?php echo escape($row["sex"]); ?></td>
           <td><?php echo escape($row["salary"]); ?></td>
           <td><?php echo escape($row["super_id"]); ?></td>
           <td><?php echo escape($row["department_id"]); ?></td>
           <td><?php echo escape($row["branch_id"]); ?></td>
           <td><a href="deleteEmployee.php?employee_id=<?php echo escape($row["employee_id"]); ?>">Delete</a></td>
         </tr>
       <?php endforeach; ?>
  </tbody>
</table>

<a href="employeeOperations.php">Back to Employee Operations</a>
<hr>
<a href="index.php">Back to Home Page</a>

<?php require "templates/footer.php"; ?>
