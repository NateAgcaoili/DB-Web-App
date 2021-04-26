<?php
if (isset($_POST['submit'])){
  require "config.php";
  require "common.php";

  try{
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT *
            FROM employee
            WHERE employee_id = :employee_id";

    $location = $_POST['employee_id'];

    $statement = $connection->prepare($sql);
    $statement ->bindParam(':employee_id', $location, PDO::PARAM_STR);
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
    <th>Employee Id</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>D.O.B.</th>
    <th>Sex</th>
    <th>Salary</th>
    <th>Supervisor Id</th>
    <th>Department Id</th>
    <th>Branch Id</th>
  </tr>
        </thead>
        <tbody>
  <?php
      foreach($result as $row){ ?>
        <tr>
    <td><?php echo escape($row["employee_id"]); ?></td>
    <td><?php echo escape($row["first_name"]); ?></td>
    <td><?php echo escape($row["last_name"]); ?></td>
    <td><?php echo escape($row["birth_date"]); ?></td>
    <td><?php echo escape($row["sex"]); ?></td>
    <td><?php echo escape($row["salary"]); ?></td>
    <td><?php echo escape($row["super_id"]); ?></td>
    <td><?php echo escape($row["department_id"]); ?></td>
    <td><?php echo escape($row["branch_id"]); ?></td>
        </tr>
      <?php } ?>
        </tbody>
    </tbody>
  <?php }else { ?>
      > No results found for <?php echo escape($_POST['location']); ?>
  <?php  }
} ?>

  <h2>Find employee based on id</h2>

  <form method="post">
    <label for="employee_id">Employee Id</label>
    <input type="number" id="employee_id" name="employee_id">
    <input type="submit" name="submit" value="View Results">

  </form>

  <a href="employeeOperations.php">Back to Employee Operations</a>
  <hr>
  <a href="index.php">Back to Home Page</a>

<?php include "templates/footer.php"; ?>
