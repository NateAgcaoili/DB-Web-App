<?php
if (isset($_POST['submit'])){
  require "config.php";
  require "common.php";

  try{
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT *
            FROM order_history
            WHERE order_id = :order_id";

    $order_id = $_POST['order_id'];

    $statement = $connection->prepare($sql);
    $statement ->bindParam(':order_id', $order_id, PDO::PARAM_STR);
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
    <th>Customer Id</th>
    <th>Order Id</th>
    <th>Product Id</th>
    <th>Order Date</th>
    <th>Delivery Date</th>
  </tr>
        </thead>
        <tbody>
  <?php
      foreach($result as $row){ ?>
        <tr>
    <td><?php echo escape($row["customer_id"]); ?></td>
    <td><?php echo escape($row["order_id"]); ?></td>
    <td><?php echo escape($row["product_id"]); ?></td>
    <td><?php echo escape($row["order_date"]); ?></td>
    <td><?php echo escape($row["delivery_date"]); ?></td>
      <?php } ?>
        </tbody>
    </tbody>
  <?php }else { ?>
      > No results found for <?php echo escape($_POST['order_id']); ?>
  <?php  }
} ?>

  <h2>Find an order based on id</h2>

  <form method="post">
    <label for="order_id">Order ID</label>
    <input type="number" id="order_id" name="order_id">
    <input type="submit" name="submit" value="View Results">

  </form>

  <a href="orderHistoryOperations.php">Back to order history operations</a>
  <hr>
  <a href="index.php">Back to Home Page</a>

<?php include "templates/footer.php"; ?>
