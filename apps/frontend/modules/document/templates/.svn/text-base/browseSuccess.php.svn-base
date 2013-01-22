<h1>
    Legal texts archive
</h1>
<?php include_partial('document/list', array('documents' => $pager->getResults())) ?>
<div class="pagination_desc">
<?php if ($pager->haveToPaginate()): ?>
    <?php foreach ($pager->getLinks() as $page): ?>
      <?php if ($page == $pager->getPage()): ?>
        <?php echo $page ?>
      <?php else: ?>
        <a href="<?php echo url_for('document/browse') ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
      <?php endif; ?>
    <?php endforeach; ?>
</div>
<?php endif; ?>
<div class="pagination_desc">
  <strong><?php echo $pager->getNbResults() ?></strong> documents

  <?php if ($pager->haveToPaginate()): ?>
    - page <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
  <?php endif; ?>
</div>