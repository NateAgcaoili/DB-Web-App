<?php
if (isset($_POST['submit'])){
  require "config.php";
  require "common.php";

  try{
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT *
            FROM customer
            WHERE customer_id = :customer_id";

    $customer_id = $_POST['customer_id'];

    $statement = $connection->prepare($sql);
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
    <th>Customer Id</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Customer Address</th>
    <th>Contact Information</th>
  </tr>
        </thead>
        <tbody>
  <?php
      foreach($result as $row){ ?>
        <tr>
    <td><?php echo escape($row["customer_id"]); ?></td>
    <td><?php echo escape($row["first_name"]); ?></td>
    <td><?php echo escape($row["last_name"]); ?></td>
    <td><?php echo escape($row["customer_address"]); ?></td>
    <td><?php echo escape($row["contact_information"]); ?></td>
      <?php } ?>
        </tbody>
    </tbody>
  <?php }else { ?>
      > No results found for <?php echo escape($_POST['customer_id']); ?>
  <?php  }
} ?>

  <h2>Find a customer based on id</h2>

  <form method="post">
    <label for="customer_id">Customer ID</label>
    <input type="number" id="customer_id" name="customer_id">
    <input type="submit" name="submit" value="View Results">

  </form>

  <a href="customerOperations.php">Back to customer operations</a>
  <hr>
  <a href="index.php">Back to Home Page</a>

<?php include "templates/footer.php"; ?>
