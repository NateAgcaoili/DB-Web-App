<?php
  try{
    require "config.php";
    require "common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM sales_relations";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();

  }catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
  }
 ?>
 <?php include "templates/header.php"; ?>

 <h2>Update a Sales Relation</h2>
 <table>
  <thead>
    <tr>
      <th>Branch Id</th>
      <th>Customer Id</th>
      <th>Total Sales</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
  <?php
       foreach($result as $row) : ?>
         <tr>
           <td><?php echo escape($row["branch_id"]); ?></td>
           <td><?php echo escape($row["customer_id"]); ?></td>
           <td><?php echo escape($row["total_sales"]); ?></td>
           <td><a href="update-singleSR.php?customer_id=<?php echo escape($row["customer_id"]); ?>">Edit</a></td>
         </tr>
       <?php endforeach; ?>
  </tbody>
</table>

<a href="salesRelationsOperations.php">Back to Sales Relations Operations</a>
<hr>
<a href="index.php">Back to Home Page</a>

<?php require "templates/footer.php"; ?>
