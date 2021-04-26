<?php

    require "config.php";
    require "common.php";

    if (isset($_GET["customer_id"])) {
    try {
      $connection = new PDO($dsn, $username, $password, $options);

      $customer_id = $_GET["customer_id"];

      $sql = "DELETE FROM customer WHERE customer_id = :customer_id";

      $statement = $connection->prepare($sql);
      $statement->bindValue(':customer_id', $customer_id);
      $statement->execute();

      $success = "customer deleted succesfully";
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
  }
  try{
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

 <h2>Delete customer</h2>
 <table>
  <thead>
    <tr>
      <th>Customer Id</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Customer Address</th>
      <th>Contact Information</th>
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
           <td><a href="deleteCustomer.php?customer_id=<?php echo escape($row["customer_id"]); ?>">Delete</a></td>
         </tr>
       <?php endforeach; ?>
  </tbody>
</table>

<a href="customerOperations.php">Back to Customer Operations</a>
<hr>
<a href="index.php">Back to Home Page</a>

<?php require "templates/footer.php"; ?>
