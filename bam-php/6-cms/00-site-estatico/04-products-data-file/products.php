<?php
$title = 'World Class Throwing Sticks - Product Page';
include('includes/header.php');

// renders all products
$product_output = render_products();

?>

<h1><?php print $title; ?></h1>
<p>Below is our complete catalog of high-end throwing sticks.</p>
<div class="main-product-listing">
  <?php print $product_output; ?>
</div>

<?php include('includes/footer.php'); ?>
