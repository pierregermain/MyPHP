<?php

// Takes array of product IDs and returns a rendered product list.
function render_products($product_ids = '') {

  // This way we can pass one number or an array to the function.
  if (!is_array($product_ids)) {
    if ($product_ids != '') {
      $product_ids = array($product_ids);
    } else {
      $product_ids = array();
    }
  }
  
  // If there are specific products selected, construct a WHERE query.
  $where_query = '';
  if (count($product_ids) > 0) {
    $where_query = ' WHERE pid IN (' . implode(',', $product_ids) . ') ';
  }

  $output = '';

  $mysqli = db_connect();
  $query = "SELECT * FROM products " . $where_query;
  $mysqli->real_query($query);
  $result = $mysqli->use_result();

  while ($row = $result->fetch_assoc()) {
    $output .= '
      <div class="product">
        <div class="product-img"><img src="' . url('images/' . $row['image']) . '" /></div>
        <div class="product-price">$' . $row['price'] . '</div>
        <div class="product-title">' . $row['title'] . '</div>
        <a class="cart-button" href="#">Add to cart</a>
      </div>';
  }
  
  return $output;
}


// Returns a setting from settings.php.
function get_setting($name) {
  static $settings;
  
  if (!isset($settings)) {
    include('settings/settings.php');
  }
  
  return $settings[$name];
}


// Connect to the database.
function db_connect() {

  $server = get_setting('db_server');
  $user = get_setting('db_username');
  $pass = get_setting('db_password');
  $db = get_setting('db_database');

  $mysqli = mysqli_connect($server, $user, $pass, $db);

  if ($mysqli->connect_errno) {
    die( "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
  }

  return $mysqli;
}



// We're setting up a function to pull together notices to the user and display them.
function notice($text, $action = 'add') {
  static $notices;
  if ($action == 'add') {
    $notices[] = $text;
  } elseif ($action == 'get') {
    if (count($notices) > 0) {
      $output = '<div class="notices">' . array_to_list($notices) . '</div>';
      unset($notices);
      return $output;
    }
  }
}


// A shortcut function that's more intuitive to use for getting the notices.
function get_notices() {
  return notice('', 'get');
}


// Convert an array to an HTML list.
function array_to_list($array) {
  return '<ul><li>' . implode('</li><li>', $array) . '</li></ul>';
}

// Prepends the base path to the URL.
function url($path) {
  return get_setting('base_path') . $path;
}