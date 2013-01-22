<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="breadcrumb_orange">
    <?php echo $breadcrumb;?>
</div>
<h1>Training Programmes</h1>
<p>
    The following is a list of training programmes dealing with regional integration
    processes. It is ordered alphabetically by host country. The link presented
    will lead you to the program description. If you would like to suggest a programme
    to be included in this list, simply send a mail to <a href="mailto:bfuhne@cris.unu.edu">
    the developer<a>.
</p>

<?php include_partial('education/list', array('items' => $pager->getResults())) ?>
<div class="pagination_desc">
    <?php if ($pager->haveToPaginate()): ?>
    <?php foreach ($pager->getLinks() as $page): ?>
    <?php if ($page == $pager->getPage()): ?>
    <?php echo $page ?>
    <?php else: ?>
    <a href="<?php echo url_for('education/training') ?>?page=<?php echo $page ?>">
        <?php echo $page ?>
    </a>
    <?php endif; ?>
    <?php endforeach; ?>
</div>
<?php endif; ?>
<div class="pagination_desc">
    <strong>
        <?php echo $pager->getNbResults() ?>
    </strong> Training Programmes

    <?php if ($pager->haveToPaginate()): ?>
    - page <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
    <?php endif; ?>
</div>