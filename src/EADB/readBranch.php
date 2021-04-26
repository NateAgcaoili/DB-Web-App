<?php
if (isset($_POST['submit'])){
  require "config.php";
  require "common.php";

  try{
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT *
            FROM branch
            WHERE branch_id = :branch_id";

    $branch_id = $_POST['branch_id'];

    $statement = $connection->prepare($sql);
    $statement ->bindParam(':branch_id', $branch_id, PDO::PARAM_STR);
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
    <th>Branch Id</th>
    <th>Branch Name</th>
    <th>Branch Head Id</th>
    <th>Region Id</th>
  </tr>
        </thead>
        <tbody>
  <?php
      foreach($result as $row){ ?>
        <tr>
    <td><?php echo escape($row["branch_id"]); ?></td>
    <td><?php echo escape($row["branch_name"]); ?></td>
    <td><?php echo escape($row["branch_head_id"]); ?></td>
    <td><?php echo escape($row["branch_head_id"]); ?></td>
      <?php } ?>
        </tbody>
    </tbody>
  <?php }else { ?>
      > No results found for <?php echo escape($_POST['branch_id']); ?>
  <?php  }
} ?>

  <h2>Find a branch based on id</h2>

  <form method="post">
    <label for="branch_id">Branch id</label>
    <input type="number" id="branch_id" name="branch_id">
    <input type="submit" name="submit" value="View Results">

  </form>

  <a href="branchOperations.php">Back to branch operations</a>
  <hr>
  <a href="index.php">Back to Home Page</a>

<?php include "templates/footer.php"; ?>
