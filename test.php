<?php

include('./config/db.php');

$sql = 'SELECT id, name, email, date_of_birth, phone, comment, gender, grade  FROM student';
$result = mysqli_query($conn, $sql);

$account = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);

print_r($account);

?>


    <?php
    include('./template/header.php')
    ?>

<h4 class="center grey-text">account</h4>
<div class="container">
  <div class="row">
  <?php foreach($account as $a): ?>
    <div class="col s6 md3">
      <div class="card z-depth-0">
        <div class="card-content center">
          <h6><?php echo htmlspecialchars($a['name']);?></h6>
          <h6><?php echo htmlspecialchars($a['email']);?></h6>
          <h6><?php echo htmlspecialchars($a['gender']);?></h6>
          <h6><?php echo 'grade is ', htmlspecialchars($a['grade']);?></h6>

        </div>
        <div class="card-action right-align">
          <a class="brand-text" href="details.php?id=<?php echo $a['id']?>">more info</a>
        </div>
      </div>
    </div>

   <?php endforeach?>

  </div>
</div>


<?php
    include('./template/footer.php')
    ?>