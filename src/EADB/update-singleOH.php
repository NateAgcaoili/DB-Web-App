<?php
  require "config.php";
  require "common.php";
  if (isset($_POST['submit'])){
    try{
      $connection = new PDO($dsn, $username, $password, $options);
      $order = [
        "customer_id"       =>$_POST['customer_id'],
        "order_id"     =>$_POST['order_id'],
        "product_id"     =>$_POST['product_id'],
        "order_date"   =>$_POST['order_date'],
        "delivery_date"        =>$_POST['delivery_date']
      ];

      $sql = "UPDATE order_history
              SET customer_id    = :customer_id,
                  order_id     = :order_id,
                  product_id     = :product_id,
                  order_date    = :order_date,
                  delivery_date   = :delivery_date
              WHERE order_id = :order_id";

      $statement = $connection->prepare($sql);
      $statement->execute($order);

    }catch (PDOException $error){
      echo $sql . "<br>" . $error->getMessage();
    }
  }
  if (isset($_GET['order_id'])){
    try{
      $connection = new PDO($dsn, $username, $password, $options);
      $order_id = $_GET['order_id'];

      $sql = "SELECT * FROM order_history WHERE order_id = :order_id";
      $statement = $connection->prepare($sql);
      $statement->bindValue(':order_id', $order_id);
      $statement->execute();

      $department = $statement->fetch(PDO:: FETCH_ASSOC);
    }catch(PDOException $error){
      echo $sql . "<br>" . $error->getMessage();
    }

  }else{
    echo "Something went wrong!";
    exit;
  }
 ?>

 <?php require "templates/header.php"; ?>

 <?php if (isset($_POST['submit']) && $statement) : ?>
    <?php echo escape($_POST['order_id']); ?> successfully updated.
 <?php endif; ?>

<h2>Edit an order</h2>

<form method="post">
    <?php foreach ($order as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>"
             <?php echo ($key === 'order_id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="orderHistoryOperations.php">Back to order history Operations</a>
<hr>
<a href="index.php">Back to Homepage</a>

<?php require "templates/footer.php"; ?>
