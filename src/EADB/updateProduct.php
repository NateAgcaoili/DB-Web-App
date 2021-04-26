<?php
  try{
    require "config.php";
    require "common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM products";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();

  }catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
  }
 ?>
 <?php include "templates/header.php"; ?>

 <h2>Update a Product</h2>
 <table>
  <thead>
    <tr>
      <th>Product Id</th>
      <th>Product Name</th>
      <th>Price Per Unit</th>
      <th>Inventory</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
  <?php
       foreach($result as $row) : ?>
         <tr>
           <td><?php echo escape($row["product_id"]); ?></td>
           <td><?php echo escape($row["product_name"]); ?></td>
           <td><?php echo escape($row["price_per_unit"]); ?></td>
           <td><?php echo escape($row["inventory"]); ?></td>
           <td><a href="update-singleProduct.php?product_id=<?php echo escape($row["product_id"]); ?>">Edit</a></td>
         </tr>
       <?php endforeach; ?>
  </tbody>
</table>

<a href="productOperations.php">Back to Product Operations</a>
<hr>
<a href="index.php">Back to Home Page</a>

<?php require "templates/footer.php"; ?>
