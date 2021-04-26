<?php
  require "config.php";
  require "common.php";
  if (isset($_POST['submit'])){
    try{
      $connection = new PDO($dsn, $username, $password, $options);
      $region = [
        "region_id"        =>$_POST['region_id'],
        "region_name"      =>$_POST['region_name'],
        "region_sales"     =>$_POST['region_sales'],
      ];

      $sql = "UPDATE region
              SET region_id    = :region_id,
                  region_name     = :region_name,
                  region_sales   = :region_sales
              WHERE region_id = :region_id";

      $statement = $connection->prepare($sql);
      $statement->execute($region);

    }catch (PDOException $error){
      echo $sql . "<br>" . $error->getMessage();
    }
  }
  if (isset($_GET['region_id'])){
    try{
      $connection = new PDO($dsn, $username, $password, $options);
      $region_id = $_GET['region_id'];

      $sql = "SELECT * FROM region WHERE region_id = :region_id";
      $statement = $connection->prepare($sql);
      $statement->bindValue(':region_id', $region_id);
      $statement->execute();

      $region = $statement->fetch(PDO:: FETCH_ASSOC);
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
    <?php echo escape($_POST['region_name']); ?> successfully updated.
 <?php endif; ?>

<h2>Edit a region</h2>

<form method="post">
    <?php foreach ($region as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>"
             <?php echo ($key === 'region_id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="regionOperations.php">Back to Region Operations</a>
<hr>
<a href="index.php">Back to Homepage</a>

<?php require "templates/footer.php"; ?>
