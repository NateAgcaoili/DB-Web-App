<?php
if (isset($_POST['submit'])){
  require "config.php";
  require "common.php";

  try{
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT *
            FROM department
            WHERE department_id = :department_id";

    $department_id = $_POST['department_id'];

    $statement = $connection->prepare($sql);
    $statement ->bindParam(':department_id', $department_id, PDO::PARAM_STR);
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
    <th>Department id</th>
    <th>Department Name</th>
    <th>Department Head Id</th>
  </tr>
        </thead>
        <tbody>
  <?php
      foreach($result as $row){ ?>
        <tr>
    <td><?php echo escape($row["department_id"]); ?></td>
    <td><?php echo escape($row["department_name"]); ?></td>
    <td><?php echo escape($row["department_head_id"]); ?></td>
      <?php } ?>
        </tbody>
    </tbody>
  <?php }else { ?>
      > No results found for <?php echo escape($_POST['department_id']); ?>
  <?php  }
} ?>

  <h2>Find a department based on id</h2>

  <form method="post">
    <label for="department_id">department_id</label>
    <input type="number" id="department_id" name="department_id">
    <input type="submit" name="submit" value="View Results">

  </form>

  <a href="departmentOperations.php">Back to department operations</a>
  <hr>
  <a href="index.php">Back to Home Page</a>

<?php include "templates/footer.php"; ?>
