
<?php foreach ($items as $i => $item): ?>
<?php 
$country = RikssymCountryPeer::retrieveByPK($item->getCountryId());
?>
<p>
Country: <img src="/riks/web/images/flags/<?php echo $country->getName();?>.png">
    <?php echo $country->getName()."<br>"; ?>
Institute: <?php echo $item->getInstitute()."<br>"; ?>
Program: <a href="<?php echo $item->getUrl();?>">
    <?php echo $item->getProgramTitle()."<br>"; ?>
</a>
<?php endforeach; ?>

