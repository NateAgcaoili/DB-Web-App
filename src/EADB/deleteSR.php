<?php

    require "config.php";
    require "common.php";

    if (isset($_GET["branch_id"])) {
    try {
      $connection = new PDO($dsn, $username, $password, $options);

      $branch_id = $_GET["branch_id"];
      $customer_id = $_GET["customer_id"];

      $sql = "DELETE FROM sales_relations WHERE branch_id = :branch_id AND customer_id = :customer_id";

      $statement = $connection->prepare($sql);
      $statement->bindValue(':branch_id', $branch_id);
      $statement->bindValue(':customer_id', $customer_id);
      $statement->execute();

      $success = "sales relation deleted succesfully";
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
  }
  try{
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

 <h2>Delete sales relation</h2>
 <table>
  <thead>
    <tr>
      <th>Branch Id</th>
      <th>Customer Name</th>
      <th>Total Sales</th>
    </tr>
  </thead>
  <tbody>
  <?php
       foreach($result as $row) : ?>
         <tr>
           <td><?php echo escape($row["branch_id"]); ?></td>
           <td><?php echo escape($row["customer_name"]); ?></td>
           <td><?php echo escape($row["total_sales"]); ?></td>
           <td><a href="deleteSR.php?branch_id=<?php echo escape($row["branch_id"]); ?>">Delete</a></td>
         </tr>
       <?php endforeach; ?>
  </tbody>
</table>

<a href="salesRelationsOperations.php">Back to sales relations Operations</a>
<hr>
<a href="index.php">Back to Home Page</a>

<?php require "templates/footer.php"; ?>
