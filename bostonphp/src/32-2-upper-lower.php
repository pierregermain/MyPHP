<?php

// Ejemplo de uso de strtolower y strtoupper
$string = 'Rasmus Lerdorf is the creator of PHP';
$string_lower = strtolower($string);
$string_upper = strtoupper($string);

echo $string_lower.'<br>';
echo $string_upper.'<br><br>';

?>

<?php
// Ejemplo de uso de formulario para encontrar nombres
// sin destinguir minúsculas y mayúsculas
?>

<form action="32-2-upper-lower.php" method="GET">
  user name: <input type="text" name="user_name"><br><br>
  <input type="submit" value="Enviar">
</form>

<?php
if (isset($_GET['user_name']) && !empty($_GET['user_name'])){
  echo $user_name = $_GET['user_name'];

  // hacemos la comparación en minúsculas
  if (strtolower($user_name) == 'rasmus lerdorf'){
    echo "<br>$user_name is the best<br>";
  }
}

?>
