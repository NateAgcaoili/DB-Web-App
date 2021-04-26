<?php
  require "config.php";
  require "common.php";
  if (isset($_POST['submit'])){
    try{
      $connection = new PDO($dsn, $username, $password, $options);
      $department = [
        "department_id"        =>$_POST['department_id'],
        "department_name"      =>$_POST['department_name'],
        "department_head_id"   =>$_POST['department_head_id'],
      ];

      $sql = "UPDATE department
              SET department_id    = :department_id,
                  department_name     = :department_name,
                  department_head_id    = :department_head_id
              WHERE department_id = :department_id";

      $statement = $connection->prepare($sql);
      $statement->execute($department);

    }catch (PDOException $error){
      echo $sql . "<br>" . $error->getMessage();
    }
  }
  if (isset($_GET['department_id'])){
    try{
      $connection = new PDO($dsn, $username, $password, $options);
      $department_id = $_GET['department_id'];

      $sql = "SELECT * FROM department WHERE department_id = :department_id";
      $statement = $connection->prepare($sql);
      $statement->bindValue(':department_id', $department_id);
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
    <?php echo escape($_POST['department_name']); ?> successfully updated.
 <?php endif; ?>

<h2>Edit a department</h2>

<form method="post">
    <?php foreach ($department as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>"
             <?php echo ($key === 'department_id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="departmentOperations.php">Back to Department Operations</a>
<hr>
<a href="index.php">Back to Homepage</a>

<?php require "templates/footer.php"; ?>