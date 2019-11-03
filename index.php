<!DOCTYPE html>
<html>
  <head>
    <title></title>
    <script></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </head>
  <body>

      <?php
        require_once 'process.php';
      ?>

      <?php if (isset($_SESSION['message'])):?>

        <div class = "alert alert-<?=$_SESSION['msg_type']?>">

          <?php

            echo $_SESSION['message'];
            unset($_SESSION['message']);

           ?>
        </div>
      <?php endif; ?>
      <div class="container">
      <?php
        $mysqli = new mysqli('localhost:3307', 'root', '', 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data ") or die($my_sql->error);

        //pre_r($result);
        //pre_r($result->fetch_assoc());

      //   function pre_r($array){
      //     echo '<pre>';
      //     print_r($array);
      //     echo '</pre>';
      //   }
      // ?>


      <div class="row justify-content-center">
        <table class = "table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>DOB</th>
              <th>Address</th>
              <th colspan = "2">Actions</th>
            </tr>
          </thead>
          <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['mail']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['dob']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td>
              <a href = "index.php?edit=<?php echo $row['id']; ?>" class = "btn btn-info">Edit</a>
              <a href = "process.php?delete=<?php echo $row['id']; ?>" class = "btn btn-danger">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
        </table>
      </div>



      <div class = "row justify-content-center">
        <form action = "process.php" method="POST">
          <div class = "form-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label >Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter Your name" >
          </div>
          <div class = "form-group">
            <label >Email</label>
            <input type="email" name="mail" class="form-control" value="<?php echo $mail; ?>" placeholder="Enter Your email" >
          </div>
          <div class = "form-group">
            <label >Password</label>
            <input type="password" name="psw" class="form-control" value="<?php echo ''; ?>" placeholder="Enter Your password">
          </div>
          <div class = "form-group">
            <label >DOB</label>
            <input type="date" name="dob" class="form-control" value="<?php echo $dob; ?>" placeholder="Enter Your date of birth" >
          </div>
          <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" class = "form-control" value="<?php echo $address; ?>" placeholder="Enter your address" >
          </div>
          <div class="form-group">
            <?php if ($update == true): ?>
              <button type="submit"class = "btn btn-info" name="update">Update</button>
            <?php else: ?>
            <button type="submit"class = "btn btn-primary" name="save">Save</button>
          <?php endif; ?>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
