<?php if (!empty($errors)) : ?>
  <?php foreach ($errors as $error) : ?>
    <ul class="form-alert">
      <li><?php echo $error ?></li>
    </ul>
  <?php endforeach; ?>
<?php endif; ?>