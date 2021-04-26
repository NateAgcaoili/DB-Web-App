<?php
  require "config.php";
  require "common.php";
  if (isset($_POST['submit'])){
    try{
      $connection = new PDO($dsn, $username, $password, $options);
      $product = [
        "product_id"       =>$_POST['product_id'],
        "product_name"     =>$_POST['product_name'],
        "price_per_unit"   =>$_POST['price_per_unit'],
        "inventory"        =>$_POST['inventory'],
      ];

      $sql = "UPDATE products
              SET product_id    = :product_id,
                  product_name     = :product_name,
                  price_per_unit    = :price_per_unit,
                  inventory   = :inventory
              WHERE product_id = :product_id";

      $statement = $connection->prepare($sql);
      $statement->execute($department);

    }catch (PDOException $error){
      echo $sql . "<br>" . $error->getMessage();
    }
  }
  if (isset($_GET['product_id'])){
    try{
      $connection = new PDO($dsn, $username, $password, $options);
      $product_id = $_GET['product_id'];

      $sql = "SELECT * FROM products WHERE product_id = :product_id";
      $statement = $connection->prepare($sql);
      $statement->bindValue(':product_id', $product_id);
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
    <?php echo escape($_POST['product_name']); ?> successfully updated.
 <?php endif; ?>

<h2>Edit a product</h2>

<form method="post">
    <?php foreach ($product as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>"
             <?php echo ($key === 'product_id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="productOperations.php">Back to Product Operations</a>
<hr>
<a href="index.php">Back to Homepage</a>

<?php require "templates/footer.php"; ?>
