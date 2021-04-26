<?php
  require "config.php";
  require "common.php";
  if (isset($_POST['submit'])){
    try{
      $connection = new PDO($dsn, $username, $password, $options);
      $customer = [
        "customer_id"       =>$_POST['customer_id'],
        "first_name"     =>$_POST['first_name'],
        "last_name"     =>$_POST['last_name'],
        "customer_address"   =>$_POST['customer_address'],
        "contact_information"        =>$_POST['contact_information']
      ];

      $sql = "UPDATE customer
              SET customer_id    = :customer_id,
                  first_name     = :first_name,
                  last_name     = :last_name,
                  customer_address    = :customer_address,
                  contact_information   = :contact_information
              WHERE customer_id = :customer_id";

      $statement = $connection->prepare($sql);
      $statement->execute($customer);

    }catch (PDOException $error){
      echo $sql . "<br>" . $error->getMessage();
    }
  }
  if (isset($_GET['customer_id'])){
    try{
      $connection = new PDO($dsn, $username, $password, $options);
      $customer_id = $_GET['customer_id'];

      $sql = "SELECT * FROM customer WHERE customer_id = :customer_id";
      $statement = $connection->prepare($sql);
      $statement->bindValue(':customer_id', $customer_id);
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
    <?php echo escape($_POST['customer_name']); ?> successfully updated.
 <?php endif; ?>

<h2>Edit a customer profile</h2>

<form method="post">
    <?php foreach ($customer as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>"
             <?php echo ($key === 'customer_id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="customerOperations.php">Back to Customer Operations</a>
<hr>
<a href="index.php">Back to Homepage</a>

<?php require "templates/footer.php"; ?>
