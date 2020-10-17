<?php if(count($erros) > 0): ?>
  <header>
      <link rel="stylesheet" href="./css/erros.css">
  </header>    
    <div class="error" style="text-align:center; width:28%;">
        <?php foreach ($erros as $erro): ?>
            <p><?php echo $erro; ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>
