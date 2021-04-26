<?php
  try{
    require "config.php";
    require "common.php";

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

 <h2>Update an Order</h2>
 <table>
  <thead>
    <tr>
      <th>Customer Id</th>
      <th>Order Id</th>
      <th>Product Id</th>
      <th>Order Date</th>
      <th>Delivery Date</th>
      <th>Edit</th>
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
           <td><a href="update-singleOH.php?order_id=<?php echo escape($row["order_id"]); ?>">Edit</a></td>
         </tr>
       <?php endforeach; ?>
  </tbody>
</table>

<a href="orderHistoryOperations.php">Back to ordery history Operations</a>
<hr>
<a href="index.php">Back to Home Page</a>

<?php require "templates/footer.php"; ?>
