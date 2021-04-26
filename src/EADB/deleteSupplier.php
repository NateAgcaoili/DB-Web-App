<?php

    require "config.php";
    require "common.php";

    if (isset($_GET["supplier_id"])) {
    try {
      $connection = new PDO($dsn, $username, $password, $options);

      $supplier_id = $_GET["supplier_id"];

      $sql = "DELETE FROM supplier WHERE supplier_id = :supplier_id";

      $statement = $connection->prepare($sql);
      $statement->bindValue(':supplier_id', $supplier_id);
      $statement->execute();

      $success = "supplier deleted succesfully";
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
  }
  try{
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM supplier";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();

  }catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
  }
 ?>
 <?php include "templates/header.php"; ?>

 <h2>Delete supplier</h2>
 <table>
  <thead>
    <tr>
      <th>Supplier Id</th>
      <th>Company Name</th>
      <th>Contact Information</th>
      <th>Address</th>
    </tr>
  </thead>
  <tbody>
  <?php
       foreach($result as $row) : ?>
         <tr>
           <td><?php echo escape($row["supplier_id"]); ?></td>
           <td><?php echo escape($row["company_name"]); ?></td>
           <td><?php echo escape($row["contact_information"]); ?></td>
           <td><?php echo escape($row["address"]); ?></td>
           <td><a href="deleteSupplier.php?supplier_id=<?php echo escape($row["supplier_id"]); ?>">Delete</a></td>
         </tr>
       <?php endforeach; ?>
  </tbody>
</table>

<a href="supplierOperations.php">Back to Supplier Operations</a>
<hr>
<a href="index.php">Back to Home Page</a>

<?php require "templates/footer.php"; ?>
