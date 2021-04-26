<?php
  try{
    require "config.php";
    require "common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM customer";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();

  }catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
  }
 ?>
 <?php include "templates/header.php"; ?>

 <h2>Update a Customer</h2>
 <table>
  <thead>
    <tr>
      <th>Customer Id</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Customer Address</th>
      <th>Contact Information</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
  <?php
       foreach($result as $row) : ?>
         <tr>
           <td><?php echo escape($row["customer_id"]); ?></td>
           <td><?php echo escape($row["first_name"]); ?></td>
           <td><?php echo escape($row["last_name"]); ?></td>
           <td><?php echo escape($row["customer_address"]); ?></td>
           <td><?php echo escape($row["contact_information"]); ?></td>
           <td><a href="update-singleCustomer.php?customer_id=<?php echo escape($row["customer_id"]); ?>">Edit</a></td>
         </tr>
       <?php endforeach; ?>
  </tbody>
</table>

<a href="customerOperations.php">Back to Customer Operations</a>
<hr>
<a href="index.php">Back to Home Page</a>

<?php require "templates/footer.php"; ?>
