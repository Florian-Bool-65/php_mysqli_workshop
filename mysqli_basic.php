<?php
define("DB_SERVERNAME", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
define("DB_NAME", "db_university");

// creare una connessione con il DB
$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Controlliamo che la connessione non abbia errori
if ($conn->connect_error) {
  throw new Exception($conn->connect_error);
}

// Esegue qualsiasi query desiderata
$result = $conn->query("SELECT * 
                        FROM `departments`");

// Leggo i dati in un colpo solo ed ottengo un array associativo
var_dump($result->fetch_all(MYSQLI_ASSOC));

// Resetto l'indice di lettura
$result->data_seek(0);

// Leggo i dati una riga alla volta tramite fetch_assoc()
for ($i = 0; $i < $result->num_rows; $i++) {
  $row = $result->fetch_assoc();

  echo "<li>Elemento con id {$row['id']} - {$row['name']}</li>";
}

// Resetto l'indice di lettura
$result->data_seek(0);

// Leggo i dati una riga alla volta tramite fetch_assoc()
while ($row = $result->fetch_assoc()) {
  echo "<li>Elemento con id {$row['id']} - {$row['name']}</li>";
}


$result = $conn->query("SELECT * 
                        FROM `degrees`");

var_dump($result->fetch_all(MYSQLI_ASSOC));