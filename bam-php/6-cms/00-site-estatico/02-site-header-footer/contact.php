<?php
$title = 'Contact Us';
include('includes/header.php');
?>

<h1><?php print $title; ?></h1>
<p>Please use the form below to contact us regarding order information, to share a unique usage of one of our sticks, or just to say hi.</p>
<div class="input-wrapper">
  <div class="label">Name:</div>
  <input type="text" name="name" />
</div>
<div class="input-wrapper">
  <div class="label">Email:</div>
  <input type="text" name="email" />
</div>
<div class="input-wrapper">
  <div class="label">Comments:</div>
  <textarea class="comments" name="comments"></textarea>
</div>
<div class="input-wrapper">
  <input type="submit" class="submit" value="Submit" />
</div>

<?php include('includes/footer.php'); ?>
