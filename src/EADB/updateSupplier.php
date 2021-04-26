<?php
  try{
    require "config.php";
    require "common.php";

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

 <h2>Update a Supplier</h2>
 <table>
  <thead>
    <tr>
      <th>Supplier Id</th>
      <th>Company Name</th>
      <th>Contact Information</th>
      <th>Address</th>
      <th>Edit</th>
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
           <td><a href="update-singleSupplier.php?supplier_id=<?php echo escape($row["supplier_id"]); ?>">Edit</a></td>
         </tr>
       <?php endforeach; ?>
  </tbody>
</table>

<a href="supplierOperations.php">Back to Supplier Operations</a>
<hr>
<a href="index.php">Back to Home Page</a>

<?php require "templates/footer.php"; ?>
