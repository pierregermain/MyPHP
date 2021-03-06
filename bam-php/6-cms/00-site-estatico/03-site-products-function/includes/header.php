<?php
  
  // Takes array $options and returns a product display as HTML.
  function render_product($options) {
    return '
      <div class="product">
        <div class="product-img"><img src="images/' . $options['img'] . '" /></div>
        <div class="product-price">$' . $options['price'] . '</div>
        <div class="product-title">' . $options['title'] . '</div>
        <a class="cart-button" href="#">Add to cart</a>
      </div>';
  }
  
  // Create an array of featured products.
  $featured_products[] = array(
    'title' => 'Mahogany',
    'img' => 'product-1.jpg',
    'price' => '29.99',
  );
  $featured_products[] = array(
    'title' => 'Bamboo',
    'img' => 'product-3.jpg',
    'price' => '19.99',
  );
  
  // Render featured products.
  $featured_product_output = '';
  foreach ($featured_products as $product) {
    $featured_product_output .= render_product($product);
  }
?>

<!DOCTYPE html>
<html>
  
  <head>
  <title><?php print $title; ?> | AmaZING! Inc.</title>
    <link type="text/css" rel="stylesheet" media="all" href="styles/style.css" />
  </head>

  <body>
    <div class="body">
      <div class="header">
        <div class="logo"><img src="images/logo.png" alt="Logo" /></div>
        <div class="site-title">AmaZING! Inc: Throwing Sticks Done Right</div>
        <div class="header-menu">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </div>
      </div>
  
      <div class="content-outer">
        <div class="left-column">
          <div class="left-column-title">Featured sticks!</div>
          <div class="product">
            <div class="product-img"><img src="images/product-1.jpg" /></div>
            <div class="product-price">$29.99</div>
            <div class="product-title">Mahogany</div>
            <a class="cart-button" href="#">Add to cart</a>
          </div>
          <div class="product">
            <div class="product-img"><img src="images/product-3.jpg" /></div>
            <div class="product-price">$19.99</div>
            <div class="product-title">Bamboo</div>
            <a class="cart-button" href="#">Add to cart</a>
          </div>
        </div>
        <div class="content">
