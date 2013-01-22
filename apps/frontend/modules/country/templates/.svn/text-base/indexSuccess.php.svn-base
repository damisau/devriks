<h1>Country List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rikssym_country_list as $rikssym_country): ?>
    <tr>
      <td><a href="<?php echo url_for('country/show?id='.$rikssym_country->getId()) ?>"><?php echo $rikssym_country->getId() ?></a></td>
      <td><?php echo $rikssym_country->getName() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('country/new') ?>">New</a>
