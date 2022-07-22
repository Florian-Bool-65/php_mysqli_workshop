<?php
require_once "./classi/Degree.php";

$data = Degree::all(true)
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
      <h1>Lista Corsi di Laurea</h1>

      <table class="table">
        <thead>
          <tr>
            <td>ID</td>
            <td>Nome</td>
            <td>Dipartimento</td>
            <td>Tipologia</td>
            <td>Indirizzo</td>
            <td>Email</td>
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
            echo "<td>{$row['department_name']}</td>";
            echo "<td>{$row['level']}</td>";
            echo "<td>{$row['address']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td><a href='https://{$row['website']}' target='_blank'>Apri</a></td>";
            echo "<td><a href='corso_laurea.php?id={$row['id']}' target='_blank'>Dettagli</a></td>";
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