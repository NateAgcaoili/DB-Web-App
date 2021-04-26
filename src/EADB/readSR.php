<?php
if (isset($_POST['submit'])){
  require "config.php";
  require "common.php";

  try{
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT *
            FROM sales_relations
            WHERE branch_id = :branch_id AND customer_id = :customer_id";

    $branch_id = $_POST['branch_id'];
    $customer_id = $_POST['customer_id'];

    $statement = $connection->prepare($sql);
    $statement ->bindParam(':branch_id', $branch_id, PDO::PARAM_STR);
    $statement ->bindParam(':customer_id', $customer_id, PDO::PARAM_STR);
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
    <th>Branch id</th>
    <th>Customer id</th>
    <th>Total Sales</th>
  </tr>
        </thead>
        <tbody>
  <?php
      foreach($result as $row){ ?>
        <tr>
    <td><?php echo escape($row["branch_id"]); ?></td>
    <td><?php echo escape($row["customer_id"]); ?></td>
    <td><?php echo escape($row["total_sales"]); ?></td>
      <?php } ?>
        </tbody>
    </tbody>
  <?php }else { ?>
      > No results found for <?php echo escape($_POST['branch_id']); ?>
  <?php  }
} ?>

  <h2>Find a sales relation based on branch_id and customer_id</h2>

  <form method="post">
    <label for="branch_id">Branch Id</label>
    <input type="number" id="branch_id" name="branch_id">
    <label for="customer_id">Customer Id</label>
    <input type="number" id="customer_id" name="customer_id">
    <input type="submit" name="submit" value="View Results">

  </form>

  <a href="salesRelationsOperations.php">Back to sales relations operations</a>
  <hr>
  <a href="index.php">Back to Home Page</a>

<?php include "templates/footer.php"; ?>
