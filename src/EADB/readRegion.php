<?php
if (isset($_POST['submit'])){
  require "config.php";
  require "common.php";

  try{
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT *
            FROM region
            WHERE region_id = :region_id";

    $region_id = $_POST['region_id'];

    $statement = $connection->prepare($sql);
    $statement ->bindParam(':region_id', $region_id, PDO::PARAM_STR);
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
    <th>Region id</th>
    <th>Region Name</th>
    <th>Region Sales</th>
  </tr>
        </thead>
        <tbody>
  <?php
      foreach($result as $row){ ?>
        <tr>
    <td><?php echo escape($row["region_id"]); ?></td>
    <td><?php echo escape($row["region_name"]); ?></td>
    <td><?php echo escape($row["region_sales"]); ?></td>
      <?php } ?>
        </tbody>
    </tbody>
  <?php }else { ?>
      > No results found for <?php echo escape($_POST['region_id']); ?>
  <?php  }
} ?>

  <h2>Find a region based on id</h2>

  <form method="post">
    <label for="region_id">Region Id</label>
    <input type="number" id="region_id" name="region_id">
    <input type="submit" name="submit" value="View Results">

  </form>

  <a href="regionOperations.php">Back to region operations</a>
  <hr>
  <a href="index.php">Back to Home Page</a>

<?php include "templates/footer.php"; ?>
