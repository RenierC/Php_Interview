<?php
include_once "./models/DbImport.php";
// Instancia la base de datos
$database = new Importing();

if (isset($_POST["sub"])) {
    $database->import($_FILES["file"]["tmp_name"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Php interview</title>
</head>
<body>
  <h1>Por acá puede importar el csv 😉</h1>
  <form method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" name="sub" value="Import">
  </form>
</body>
</html>