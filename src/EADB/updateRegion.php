<?php
  try{
    require "config.php";
    require "common.php";

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

 <h2>Update a Region</h2>
 <table>
  <thead>
    <tr>
      <th>Region Id</th>
      <th>Region Name</th>
      <th>Region Sales</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
  <?php
       foreach($result as $row) : ?>
         <tr>
           <td><?php echo escape($row["region_id"]); ?></td>
           <td><?php echo escape($row["region_name"]); ?></td>
           <td><?php echo escape($row["region_sales"]); ?></td>
           <td><a href="update-singleRegion.php?region_id=<?php echo escape($row["region_id"]); ?>">Edit</a></td>
         </tr>
       <?php endforeach; ?>
  </tbody>
</table>

<a href="regionOperations.php">Back to Region Operations</a>
<hr>
<a href="index.php">Back to Home Page</a>

<?php require "templates/footer.php"; ?>
