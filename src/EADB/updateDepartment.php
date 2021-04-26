<?php
  try{
    require "config.php";
    require "common.php";

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

 <h2>Update an Department</h2>
 <table>
  <thead>
    <tr>
      <th>Department Id</th>
      <th>Department Name</th>
      <th>Department Head Id</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
  <?php
       foreach($result as $row) : ?>
         <tr>
           <td><?php echo escape($row["department_id"]); ?></td>
           <td><?php echo escape($row["department_name"]); ?></td>
           <td><?php echo escape($row["department_head_id"]); ?></td>
           <td><a href="update-singleDepartment.php?department_id=<?php echo escape($row["department_id"]); ?>">Edit</a></td>
         </tr>
       <?php endforeach; ?>
  </tbody>
</table>

<a href="departmentOperations.php">Back to Department Operations</a>
<hr>
<a href="index.php">Back to Home Page</a>

<?php require "templates/footer.php"; ?>
