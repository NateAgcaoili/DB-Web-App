<?php

    require "config.php";
    require "common.php";

    if (isset($_GET["region_id"])) {
    try {
      $connection = new PDO($dsn, $username, $password, $options);

      $region_id = $_GET["region_id"];

      $sql = "DELETE FROM region WHERE region_id = :region_id";

      $statement = $connection->prepare($sql);
      $statement->bindValue(':region_id', $region_id);
      $statement->execute();

      $success = "region deleted succesfully";
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
  }
  try{
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM region";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();

  }catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
  }
 ?>
 <?php include "templates/header.php"; ?>

 <h2>Delete region</h2>
 <table>
  <thead>
    <tr>
      <th>Region Id</th>
      <th>Region Name</th>
      <th>Region Sales</th>
    </tr>
  </thead>
  <tbody>
  <?php
       foreach($result as $row) : ?>
         <tr>
           <td><?php echo escape($row["region_id"]); ?></td>
           <td><?php echo escape($row["region_name"]); ?></td>
           <td><?php echo escape($row["region_sales"]); ?></td>
           <td><a href="deleteRegion.php?region_id=<?php echo escape($row["region_id"]); ?>">Delete</a></td>
         </tr>
       <?php endforeach; ?>
  </tbody>
</table>

<a href="regionOperations.php">Back to Region Operations</a>
<hr>
<a href="index.php">Back to Home Page</a>

<?php require "templates/footer.php"; ?>
