  <?php
session_start();
$_SESSION['message'] = ' ';
$mysqli =new mysqli('localhost','root','','account');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Password must match
  if($_POST['password'] == $_POST['confirmpassword']) {
    $username=$mysqli->real_escape_string($_POST['username']);
    $email=$mysqli->real_escape_string($_POST['email']);
    $password=md5($mysqli->real_escape_string($_POST['password']));
    $avatar_path =$mysqli->real_escape_string('images/'.$_FILES['avatar']['name']);

    //makesure file type is image:
    if (preg_match("!image!",$_FILES['avatar']['type'])) {

      //copy image to folder
      if(copy($_FILES['avatar']['tmp_name'], $avatar_path)){

          $_SESSION['username'] = $username;
          $_SESSION['avatar'] = $avatar_path;
          /*$sql1="INSERT INTO users(username,email,password,avatar) "
                ."VALUES ('$username','$email','$password','$avatar_path')";*/


      $query = mysqli_query($mysqli, "SELECT * FROM users WHERE email = '".$email. "'");
      if(mysqli_num_rows($query) > 0){
        $_SESSION['message']="Email is already in use";
      }else{
          $query = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '".$username. "'");
        if(mysqli_num_rows(  $query) > 0){
          $_SESSION['message']="Username is already in use";
      }else{
    $sql ="INSERT INTO users(username,email,password,avatar) "
          ."VALUES ('$username','$email','$password','$avatar_path')";;
    if ($mysqli->query($sql) === TRUE) {
      $_SESSION['message']= "Registeration successful! WELCOME $username";
      header("location:welcome.php");
    }
    else {
       $_SESSION['message']="User couldn't be added to the database";
    }
  }
}
}
else {
    $_SESSION['message'] ="File Upload Failed!";
}
}
else {
  $_SESSION['message'] = "Please only Upload JPG or PNG images!";
}
}
else {
$_SESSION['message'] = "Two Password do not match!";
}
}
?>

<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="reg.css" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script type="text/javascript" >
  function validate(form)
{
   re = /[0-9]/;
      if(!re.test(form.password.value)) {
          <? php
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
    ?>
        form.password.focus();
        return false;

      }
      re = /[a-z]/;
      if(!re.test(form.password.value)) {
        <? php
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
    ?>
        form.password.focus();
        return false;
      }
      re = /[A-Z]/;
      if(!re.test(form.password.value)) {
          <? php
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
    ?>
        form.password.focus();
        return false;
      }
      else {
        <? php
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
    ?>
      form.password.focus();
      return false;
    }
      return true;
}
</script>
<div class="body-content">
  <div class="module">
    <h1>Hospital Registeration</h1>
    <form class="form" action="reg.php" name = "reg" method="post" enctype="multipart/form-data" autocomplete="off" onsubmit="return(validate(this));">
      <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
      <input type="text" placeholder="P Name" name="username" required />
      <input type="email" placeholder="Email" name="email" required />
      <input type="password" placeholder="Password" name="password" autocomplete="new-password" required />
      <input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required />
      <div class="avatar"><label>Select your image: </label><input type="file" name="avatar" accept="image/*" required /></div>
      <input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>
