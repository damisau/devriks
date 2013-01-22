<h1>Development List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Title</th>
      <th>Text</th>
      <th>Date published</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rikssym_development_list as $rikssym_development): ?>
    <tr>
      <td><a href="<?php echo url_for('development/show?id='.$rikssym_development->getId()) ?>"><?php echo $rikssym_development->getId() ?></a></td>
      <td><?php echo $rikssym_development->getTitle() ?></td>
      <td><?php echo $rikssym_development->getText() ?></td>
      <td><?php echo $rikssym_development->getDatePublished() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('development/new') ?>">New</a>
