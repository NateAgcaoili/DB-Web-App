<?php

    require "config.php";
    require "common.php";

    if (isset($_GET["department_id"])) {
    try {
      $connection = new PDO($dsn, $username, $password, $options);

      $department_id = $_GET["department_id"];

      $sql = "DELETE FROM department WHERE department_id = :department_id";

      $statement = $connection->prepare($sql);
      $statement->bindValue(':department_id', $department_id);
      $statement->execute();

      $success = "department deleted succesfully";
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
  }
  try{
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM department";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();

  }catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
  }
 ?>
 <?php include "templates/header.php"; ?>

 <h2>Delete department</h2>
 <table>
  <thead>
    <tr>
      <th>Department Id</th>
      <th>Department Name</th>
      <th>Department Head Id</th>
    </tr>
  </thead>
  <tbody>
  <?php
       foreach($result as $row) : ?>
         <tr>
           <td><?php echo escape($row["department_id"]); ?></td>
           <td><?php echo escape($row["department_name"]); ?></td>
           <td><?php echo escape($row["department_head_id"]); ?></td>
           <td><a href="deleteDepartment.php?department_id=<?php echo escape($row["department_id"]); ?>">Delete</a></td>
         </tr>
       <?php endforeach; ?>
  </tbody>
</table>

<a href="departmentOperations.php">Back to Department Operations</a>
<hr>
<a href="index.php">Back to Home Page</a>

<?php require "templates/footer.php"; ?>