<?php
if (isset($_POST['submit'])){
  require "config.php";
  require "common.php";

  try{
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT *
            FROM products
            WHERE product_id = :product_id";

    $product_id = $_POST['product_id'];

    $statement = $connection->prepare($sql);
    $statement ->bindParam(':product_id', $product_id, PDO::PARAM_STR);
    $statement ->execute();

    $result = $statement ->fetchAll();
  }catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
  }
}

?>
<?php include "templates/header.php"; ?>

<?php
  if (isset($_POST['submit'])){
    if($result && $statement->rowCount() > 0){ ?>
      <h2>Results</h2>

      <table>
        <thead>
  <tr>
    <th>Product Id</th>
    <th>Product Name</th>
    <th>Price Per Unit</th>
    <th>Inventory</th>
  </tr>
        </thead>
        <tbody>
  <?php
      foreach($result as $row){ ?>
        <tr>
    <td><?php echo escape($row["product_id"]); ?></td>
    <td><?php echo escape($row["product_name"]); ?></td>
    <td><?php echo escape($row["price_per_unit"]); ?></td>
    <td><?php echo escape($row["inventory"]); ?></td>
      <?php } ?>
        </tbody>
    </tbody>
  <?php }else { ?>
      > No results found for <?php echo escape($_POST['product_id']); ?>
  <?php  }
} ?>

  <h2>Find a product based on id</h2>

  <form method="post">
    <label for="product_id">Product ID</label>
    <input type="number" id="product_id" name="product_id">
    <input type="submit" name="submit" value="View Results">

  </form>

  <a href="productOperations.php">Back to product operations</a>
  <hr>
  <a href="index.php">Back to Home Page</a>

<?php include "templates/footer.php"; ?>
