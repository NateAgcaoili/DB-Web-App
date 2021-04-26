<?php
if (isset($_POST['submit'])){
  require "config.php";
  require "common.php";

  try{
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT *
            FROM supplier
            WHERE supplier_id = :supplier_id";

    $supplier_id = $_POST['supplier_id'];

    $statement = $connection->prepare($sql);
    $statement ->bindParam(':supplier_id', $supplier_id, PDO::PARAM_STR);
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
    <th>Supplier Id</th>
    <th>Company Name</th>
    <th>Contact Information</th>
    <th>Address</th>
  </tr>
        </thead>
        <tbody>
  <?php
      foreach($result as $row){ ?>
        <tr>
    <td><?php echo escape($row["supplier_id"]); ?></td>
    <td><?php echo escape($row["company_name"]); ?></td>
    <td><?php echo escape($row["contact_information"]); ?></td>
    <td><?php echo escape($row["address"]); ?></td>
      <?php } ?>
        </tbody>
    </tbody>
  <?php }else { ?>
      > No results found for <?php echo escape($_POST['supplier_id']); ?>
  <?php  }
} ?>

  <h2>Find a supplier based on id</h2>

  <form method="post">
    <label for="supplier_id">Supplier ID</label>
    <input type="number" id="supplier_id" name="supplier_id">
    <input type="submit" name="submit" value="View Results">

  </form>

  <a href="supplierOperations.php">Back to supplier operations</a>
  <hr>
  <a href="index.php">Back to Home Page</a>

<?php include "templates/footer.php"; ?>
