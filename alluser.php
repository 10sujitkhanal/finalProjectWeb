<?php

    session_start();
    require('config/config.php');
    require('auth/auth.php');
    require('auth/admin-auth.php');

    $result = mysqli_query($con,"SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/utilities.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <title>Adhyan- All User</title>
</head>
<body>

    <?php include 'header.php'; ?>
    

    <section class="courses">

        <h2 class="text-center my-2">
            Courses
        </h2>
        <table>
  <thead>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>User Types</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php 
                    if (mysqli_num_rows($result) > 0) { 
                        while($row = mysqli_fetch_array($result)) {
                ?>
    <tr>
      <td><?= $row['fname'] ?></td>
      <td><?= $row['lname'] ?></td>
      <td><?= $row['email'] ?></td>
      <td><?php if($row['user_type'] == 1){ echo "Admin"; } else{ echo "Normal User"; } ?></td>
      <td><?php if($row['status'] == 1){ ?> <a href="user_status.php?id=<?= $row['id'] ?>&status=<?= $row['status']?>">Active</a> <?php } else{ ?><a href="user_status.php?id=<?= $row['id'] ?>&status=<?= $row['status']?>">Inactive</a><?php } ?><a href="delete_user.php?id=<?= $row['id'] ?>">Delete</a></td>
    </tr>
    <?php } }?>
    
  </tbody>
</table>

                

                

 

    </section>

<?php include 'footer.php'; ?> 
</body>
</html>


