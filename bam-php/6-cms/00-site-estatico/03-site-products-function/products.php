<?php
    
  $title = 'World Class Throwing Sticks - Product Page';
  include('includes/header.php');
  
  $products[] = array(
    'title' => 'Mahogany',
    'img' => 'product-1.jpg',
    'price' => '29.99',
  );
  $products[] = array(
    'title' => 'Bamboo',
    'img' => 'product-3.jpg',
    'price' => '19.99',
  );
  $products[] = array(
    'title' => 'Cherry',
    'img' => 'product-4.jpg',
    'price' => '39.99',
  );
  $products[] = array(
    'title' => 'Birch',
    'img' => 'product-2.jpg',
    'price' => '15.99',
  );
  $products[] = array(
    'title' => 'Hard',
    'img' => 'product-5.jpg',
    'price' => '45.99',
  );
  $products[] = array(
    'title' => 'Driftwood',
    'img' => 'product-6.jpg',
    'price' => '5.99',
  );
    
  // Render featured products.
  // function is in the Header
  $product_output = '';
  foreach ($products as $product) {
    $product_output .= render_product($product);
  }
?>

<h1><?php print $title; ?></h1>
<p>Below is our complete catalog of high-end throwing sticks.</p>
<div class="main-product-listing">

<?php
  print $product_output;
  include('includes/footer.php'); 
?>
