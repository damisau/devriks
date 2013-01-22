<div class="breadcrumb_blue"><?php echo $breadcrumb; ?></div>
<h1>Research Centers</h1>
<p>This is a list of research centers that may be useful for researchers interested 
    in a particular geographic area. If you think we missed an important center
    send us a <a href="mailto:bfuhne@cris.unu.edu">message</a>, your input is highly
    appreciated.
</p>
<p>Jump to region: <?php foreach ($rikssym_georegion_list as $region):?>
    <a href="#<?php echo $region->getName();?>">
        <?php echo $region->getName(); ?>
    </a>&nbsp;
    <?php endforeach; ?>
</p>
<?php foreach ($rikssym_georegion_list as $region): ?>

<h2 id="<?php echo $region->getName(); ?>"><?php echo $region->getName(); ?></h2>
<?php foreach($rikssym_center_list as $center): ?>
<ul>
    <?php if($center->getRikssymGeoregion()->getName() == $region->getName()){
        ?><li><a href="<?php echo $center->getUrl(); ?>"><?php echo $center->getName(); ?></a>
        <p><?php echo $center->getDescription(); ?> </p>
    </li>
    <?php } ?>
</ul>
<?php endforeach; ?>
<?php endforeach; ?>
