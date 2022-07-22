<?php
$username = $_POST["username"];
$password = $_POST["password"];

var_dump($username, $password);

define("DB_SERVERNAME", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
define("DB_NAME", "db_university");

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
$stmt = $conn->prepare("SELECT * FROM `students` WHERE email = ? ");
$stmt->bind_param("s", $username);
$stmt->execute();
// $query = "SELECT * FROM `students` WHERE email = '$username'";

// var_dump($query);


// $res = $conn->query($query);

$res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
var_dump($res);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
</head>

<body>
  <div class="container py-5">

    <div class="card">
      <div class="card-header">

        <div class="card-title">Login</div>
      </div>

      <div class="card-body">
        <?php if (count($res) === 0) : ?>
          <form action="" method="POST">
            <div class="mb-3"><input type="text" class="form-control" placeholder="Nome utente" name="username"></div>
            <div class="mb-3"><input type="text" class="form-control" placeholder="Password" type="password" name=password></div>

            <button type="submit" class="btn btn-primary">Accedi</button>
          </form>
        <?php else : ?>
          <h1>Benvenuto, hai i permessi per entrare</h1>
        <?php endif ?>
      </div>
    </div>

  </div>
</body>

</html>