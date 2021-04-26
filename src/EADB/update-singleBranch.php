<?php
  require "config.php";
  require "common.php";
  if (isset($_POST['submit'])){
    try{
      $connection = new PDO($dsn, $username, $password, $options);
      $branch = [
        "branch_id"        =>$_POST['branch_id'],
        "branch_name"      =>$_POST['branch_name'],
        "branch_head_id"   =>$_POST['branch_head_id'],
        "region_id"   =>$_POST['region_id']
      ];

      $sql = "UPDATE branch
              SET branch_id    = :branch_id,
                  branch_name     = :branch_name,
                  branch_head_id    = :branch_head_id,
                  region_id    = :region_id
              WHERE branch_id = :branch_id";

      $statement = $connection->prepare($sql);
      $statement->execute($branch);

    }catch (PDOException $error){
      echo $sql . "<br>" . $error->getMessage();
    }
  }
  if (isset($_GET['branch_id'])){
    try{
      $connection = new PDO($dsn, $username, $password, $options);
      $branch_id = $_GET['branch_id'];

      $sql = "SELECT * FROM branch WHERE branch_id = :branch_id";
      $statement = $connection->prepare($sql);
      $statement->bindValue(':branch_id', $branch_id);
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
    <?php echo escape($_POST['branch_name']); ?> successfully updated.
 <?php endif; ?>

<h2>Edit a branch</h2>

<form method="post">
    <?php foreach ($branch as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>"
             <?php echo ($key === 'branch_id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="branchOperations.php">Back to Branch Operations</a>
<hr>
<a href="index.php">Back to Homepage</a>

<?php require "templates/footer.php"; ?>
