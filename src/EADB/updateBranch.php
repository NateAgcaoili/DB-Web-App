<?php
  try{
    require "config.php";
    require "common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM branch";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();

  }catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
  }
 ?>
 <?php include "templates/header.php"; ?>

 <h2>Update an Branch</h2>
 <table>
  <thead>
    <tr>
      <th>Branch Id</th>
      <th>Branch Name</th>
      <th>Branch Head Id</th>
      <th>Region Id</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
  <?php
       foreach($result as $row) : ?>
         <tr>
           <td><?php echo escape($row["branch_id"]); ?></td>
           <td><?php echo escape($row["branch_name"]); ?></td>
           <td><?php echo escape($row["branch_head_id"]); ?></td>
           <td><?php echo escape($row["region_id"]); ?></td>
           <td><a href="update-singleBranch.php?branch_id=<?php echo escape($row["branch_id"]); ?>">Edit</a></td>
         </tr>
       <?php endforeach; ?>
  </tbody>
</table>

<a href="branchOperations.php">Back to Branch Operations</a>
<hr>
<a href="index.php">Back to Home Page</a>

<?php require "templates/footer.php"; ?>
