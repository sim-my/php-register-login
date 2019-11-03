<?php
session_start();
$mysqli = new mysqli('localhost:3307', 'root', '', 'crud') or die(mysqli_error($mysqli));

$update = false;

$id = 0;
$name = '';
$mail = '';
$psw = '';
$dob = '';
$address = '';
$mail_confirm = '';
$psw_confirm = '';

if (isset($_POST['save'])){
  $name = $_POST['name'];
  $mail = $_POST['mail'];
  $psw = $_POST['psw'];
  $dob = $_POST['dob'];
  $address = $_POST['address'];



  $hashed = md5($psw);

  $mysqli->query("INSERT INTO data (name, mail, password, dob, address) VALUES ('$name', '$mail', '$hashed', '$dob', '$address')") or die($mysqli->error);


  $_SESSION['message'] = "Record has been saved.";
  $_SESSION['msg_type'] = "success";

  header("location:index.php");
}



if (isset($_GET['delete'])){
  $id = $_GET['delete'];

  $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted.";
  $_SESSION['msg_type'] = "danger";

  header("location:index.php");
}

if (isset($_GET['edit'])){

  $update = true;
  $id = $_GET['edit'];

  $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());

  if ($result->num_rows){
  $row = $result->fetch_array();
  $name = $row['name'];
  $mail = $row['mail'];
  $psw = $row['password'];
  $dob = $row['dob'];
  $address = $row['address'];
  }
}

if (isset($_POST['update'])){
  $id = $_POST['id'];
  $name = $_POST['name'];
  $mail = $_POST['mail'];
  $psw = $_POST['psw'];
  $dob = $_POST['dob'];
  $address = $_POST['address'];

  $hashed_update = md5($psw);

  $mysqli->query("UPDATE data SET id = '$id', name = '$name', mail = '$mail', password = '$hashed_update', dob = '$dob', address = '$address' WHERE id=$id") or die($mysqli->error());

  $_SESSION['message'] = "Record has been updated.";
  $_SESSION['msg_type'] = "warning";

  header("location:index.php");

}

if (isset($_POST['login'])){
  $mail_confirm = $_POST['mail_confirm'];
  $psw_confirm = $_POST['psw_confirm'];

  $sql = " SELECT * FROM data WHERE mail = '$mail_confirm' ";
  $result = $mysqli->query($sql) or trigger_error($mysqli->error."[$sql]");


  $row = $result->fetch_array();
  if ($result->num_rows){

  $psw = $row['password'];

}
  $hashed_confirm = md5($psw_confirm);

  if ($hashed_confirm == $psw) {

    $_SESSION['message'] = "Welcome!! You are logged in.";
    $_SESSION['msg_type'] = "success";

    header("location:index.php");

    }

    else {
      $_SESSION['message'] = "Sorry password or email doesn't match";
      $_SESSION['msg_type'] = "danger";

      header("location:login.php");
    }


}
?>
