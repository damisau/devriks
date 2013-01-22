<h1>Georegion List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rikssym_georegion_list as $rikssym_georegion): ?>
    <tr>
      <td><a href="<?php echo url_for('georegion/show?id='.$rikssym_georegion->getId()) ?>"><?php echo $rikssym_georegion->getId() ?></a></td>
      <td><?php echo $rikssym_georegion->getName() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('georegion/new') ?>">New</a>
