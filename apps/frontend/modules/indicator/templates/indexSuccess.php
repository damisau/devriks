<h1>Indicator List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Description</th>
      <th>Ispublic</th>
      <th>Classname</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rikssym_indicator_list as $rikssym_indicator): ?>
    <tr>
      <td><a href="<?php echo url_for('indicator/show?id='.$rikssym_indicator->getId()) ?>"><?php echo $rikssym_indicator->getId() ?></a></td>
      <td><?php echo $rikssym_indicator->getName() ?></td>
      <td><?php echo $rikssym_indicator->getDescription() ?></td>
      <td><?php echo $rikssym_indicator->getIspublic() ?></td>
      <td><?php echo $rikssym_indicator->getClassname() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('indicator/new') ?>">New</a>
