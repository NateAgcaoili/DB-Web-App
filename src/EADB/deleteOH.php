<?php

    require "config.php";
    require "common.php";

    if (isset($_GET["order_id"])) {
    try {
      $connection = new PDO($dsn, $username, $password, $options);

      $order_id = $_GET["order_id"];

      $sql = "DELETE FROM order_history WHERE order_id = :order_id";

      $statement = $connection->prepare($sql);
      $statement->bindValue(':order_id', $order_id);
      $statement->execute();

      $success = "order deleted succesfully";
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
  }
  try{
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM order_history";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();

  }catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
  }
 ?>
 <?php include "templates/header.php"; ?>

 <h2>Delete order</h2>
 <table>
  <thead>
    <tr>
      <th>Customer Id</th>
      <th>Order Id</th>
      <th>Product Id</th>
      <th>Order Date</th>
      <th>Delivery Date</th>
    </tr>
  </thead>
  <tbody>
  <?php
       foreach($result as $row) : ?>
         <tr>
           <td><?php echo escape($row["customer_id"]); ?></td>
           <td><?php echo escape($row["order_id"]); ?></td>
           <td><?php echo escape($row["product_id"]); ?></td>
           <td><?php echo escape($row["order_date"]); ?></td>
           <td><?php echo escape($row["delivery_date"]); ?></td>
           <td><a href="deleteOH.php?order_id=<?php echo escape($row["order_id"]); ?>">Delete</a></td>
         </tr>
       <?php endforeach; ?>
  </tbody>
</table>

<a href="orderHistoryOperations.php">Back to order history Operations</a>
<hr>
<a href="index.php">Back to Home Page</a>

<?php require "templates/footer.php"; ?>
