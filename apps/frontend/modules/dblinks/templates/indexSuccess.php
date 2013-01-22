<div class="breadcrumb_green"><?php echo $breadcrumb ?></div>
<h1>Links to databases:</h1>
<ul class="csc-bulletlist">

    <?php foreach ($rikssym_dblinks_list as $rikssym_dblinks): ?>

    <li><h1><B><a href="<?php echo $rikssym_dblinks->getUrl(); ?>">
    <?php echo $rikssym_dblinks->getName() ?></a></li></B></h1>
    <p><?php echo $rikssym_dblinks->getDescription(); ?></p>
    <?php endforeach; ?>

</ul>
