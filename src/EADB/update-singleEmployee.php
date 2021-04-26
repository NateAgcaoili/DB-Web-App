<?php
  require "config.php";
  require "common.php";
  if (isset($_POST['submit'])){
    try{
      $connection = new PDO($dsn, $username, $password, $options);
      $employee = [
        "employee_id"     =>$_POST['employee_id'],
        "first_name"      =>$_POST['first_name'],
        "last_name"       =>$_POST['last_name'],
        "birth_date"      =>$_POST['birth_date'],
        "sex"             =>$_POST['sex'],
        "salary"          =>$_POST['salary'],
        "super_id"        =>$_POST['super_id'],
        "department_id"   =>$_POST['department_id'],
        "branch_id"       =>$_POST['branch_id'],
      ];

      $sql = "UPDATE employee
              SET employee_id   = :employee_id,
                  first_name    = :first_name,
                  last_name     = :last_name,
                  birth_date    = :birth_date,
                  sex           = :sex,
                  salary        = :salary,
                  super_id      = :super_id,
                  department_id = :department_id,
                  branch_id     = :branch_id
              WHERE employee_id = :employee_id";

      $statement = $connection->prepare($sql);
      $statement->execute($employee);

    }catch (PDOException $error){
      echo $sql . "<br>" . $error->getMessage();
    }
  }
  if (isset($_GET['employee_id'])){
    try{
      $connection = new PDO($dsn, $username, $password, $options);
      $employee_id = $_GET['employee_id'];

      $sql = "SELECT * FROM employee WHERE employee_id = :employee_id";
      $statement = $connection->prepare($sql);
      $statement->bindValue(':employee_id', $employee_id);
      $statement->execute();

      $employee = $statement->fetch(PDO:: FETCH_ASSOC);
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
    <?php echo escape($_POST['first_name']); ?> successfully updated.
 <?php endif; ?>

<h2>Edit a user</h2>

<form method="post">
    <?php foreach ($employee as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>"
             <?php echo ($key === 'id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="employeeOperations.php">Back to Employee Operations</a>
<hr>
<a href="index.php">Back to Homepage</a>

<?php require "templates/footer.php"; ?>
