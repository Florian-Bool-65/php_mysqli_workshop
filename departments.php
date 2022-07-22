<?php
require_once "./classi/db/QueryHandler.php";
require_once "./classi/Department.php";

$departmentId = key_exists("id", $_GET) ? $_GET["id"] : null;

$data = Department::all();

// $dataWithTeachers = Department::teachers(4);

if (isset($departmentId)) {

  $dipartimento2 = Department::find($departmentId);

  var_dump($dipartimento2->toArray());
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Php mysqli Workshop</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</head>

<body>
  <?php include "./partials/header.php" ?>

  <main>
    <div class="container">
      <h1>Lista Dipartimenti</h1>

      <table class="table">
        <thead>
          <tr>
            <td>ID</td>
            <td>Nome</td>
            <td>Indirizzo</td>
            <td>Tel.</td>
            <td>Email</td>
            <td>Responsabile</td>
            <td>Sito</td>
            <td></td>
          </tr>
        </thead>

        <tbody>
          <?php
          $data->forEach(function ($row) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['address']}</td>";
            echo "<td>{$row['phone']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['head_of_department']}</td>";
            echo "<td><a href='https://{$row['website']}' target='_blank'>Apri</a></td>";
            echo "<td><a href='dipartimento.php?id={$row['id']}' target='_blank'>Dettagli</a></td>";
            echo "</tr>";
          });

          ?>
          <tr></tr>

        </tbody>

      </table>
    </div>
  </main>

  <?php include "./partials/footer.php" ?>
</body>

</html>