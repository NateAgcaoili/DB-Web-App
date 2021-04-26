<?php
  require "config.php";
  require "common.php";
  if (isset($_POST['submit'])){
    try{
      $connection = new PDO($dsn, $username, $password, $options);
      $supplier = [
        "supplier_id"        =>$_POST['supplier_id'],
        "company_name"      =>$_POST['company_name'],
        "contact_information"   =>$_POST['contact_information'],
        "address"      =>$_POST['address']
      ];

      $sql = "UPDATE supplier
              SET supplier_id    = :supplier_id,
                  company_name     = :company_name,
                  contact_information    = :contact_information,
                  address   = :address
              WHERE supplier_id = :supplier_id";

      $statement = $connection->prepare($sql);
      $statement->execute($supplier);

    }catch (PDOException $error){
      echo $sql . "<br>" . $error->getMessage();
    }
  }
  if (isset($_GET['supplier_id'])){
    try{
      $connection = new PDO($dsn, $username, $password, $options);
      $supplier_id = $_GET['supplier_id'];

      $sql = "SELECT * FROM supplier WHERE supplier_id = :supplier_id";
      $statement = $connection->prepare($sql);
      $statement->bindValue(':supplier_id', $supplier_id);
      $statement->execute();

      $supplier = $statement->fetch(PDO:: FETCH_ASSOC);
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
    <?php echo escape($_POST['company_name']); ?> successfully updated.
 <?php endif; ?>

<h2>Edit a supplier</h2>

<form method="post">
    <?php foreach ($supplier as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>"
             <?php echo ($key === 'supplier_id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="supplierOperations.php">Back to Supplier Operations</a>
<hr>
<a href="index.php">Back to Homepage</a>

<?php require "templates/footer.php"; ?>
