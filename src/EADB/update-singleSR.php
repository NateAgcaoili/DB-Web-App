<?php
  require "config.php";
  require "common.php";
  if (isset($_POST['submit'])){
    try{
      $connection = new PDO($dsn, $username, $password, $options);
      $sr = [
        "branch_id"        =>$_POST['branch_id'],
        "customer_id"      =>$_POST['customer_id'],
        "total_sales"   =>$_POST['total_sales'],
      ];

      $sql = "UPDATE sales_relations
              SET branch_id    = :branch_id,
                  customer_id     = :customer_id,
                  total_sales    = :total_sales
              WHERE branch_id = :branch_id AND customer_id = :customer_id";

      $statement = $connection->prepare($sql);
      $statement->execute($sr);

    }catch (PDOException $error){
      echo $sql . "<br>" . $error->getMessage();
    }
  }
  if (isset($_GET['branch_id'])){
    try{
      $connection = new PDO($dsn, $username, $password, $options);
      $branch_id = $_GET['branch_id'];
      $customer_id = $_GET['customer_id'];

      $sql = "SELECT * FROM sales_relations WHERE branch_id = :branch_id AND customer_id = :customer_id";
      $statement = $connection->prepare($sql);
      $statement->bindValue(':branch_id', $branch_id);
      $statement->bindValue(':customer_id', $customer_id);
      $statement->execute();

      $sr = $statement->fetch(PDO:: FETCH_ASSOC);
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
    <?php echo escape($_POST['branch_id']); ?> successfully updated.
 <?php endif; ?>

<h2>Edit a sales relation</h2>

<form method="post">
    <?php foreach ($sr as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>"
             <?php echo ($key === 'branch_id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="salesRelationsOperations.php">Back to sales relations Operations</a>
<hr>
<a href="index.php">Back to Homepage</a>

<?php require "templates/footer.php"; ?>
