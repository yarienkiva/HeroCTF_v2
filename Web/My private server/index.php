<?php
if(isset($_POST['username']) && isset($_POST['password'])){
  $db = new PDO('mysql:host=localhost;dbname=heroctf;charset=utf8','root',''); //A changer lors de l'intégration dans le Docker acceuillant le challenge.
  $pass = md5($_POST['password']);
  $user = $_POST['username'];
  $sql = "SELECT * FROM users WHERE Username='$user' AND HashPassword='$pass'";
  $res = $db->query($sql);
  if(!is_bool($res)){
    if(isset($res->fetchAll()[0])){
      $msg = 'Welcome back admin, your last message was : HeroCTF{b4s1c_sql_1nj3ct1on}';
    }else{
      $msg = 'UhOh you don\'t seem to be an admin.';
    }
  }else{
    $msg = 'Query error.';
  }
}else{
  $msg = 'Please login before access admin panel.';
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Admin Login</title>
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar">
      <span class="navbar-brand mb-0 h1">HeroCTF</span>
    </nav>

    <!-- content -->
    <div class="container" style="margin-top: 20px;">
         <!-- form -->
         <form action="/sqli/index.php" method="POST">
            <div class="form-group">
              <?php echo '<label>'.$msg.'</label><br>'; ?>
              <input type="text" class="form-control" name="username" placeholder="username" required>
              <br>
              <input type="password" class="form-control" name="password" placeholder="password" required>
            </div>
            <button type="submit" class="btn btn-primary" style="background-color:#FF0000">Submit</button>
          </form>
    </div>
  </body>
</html>