<h1>Arrangements List</h1>

<table>
  <thead>
    <tr>
      <th>Arrangement</th>
      <th>Country</th>
      <th>Id</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rikssym_arrangement_country_list as $rikssym_arrangement_country): ?>
    <tr>
      <td><?php echo $rikssym_arrangement_country->getArrangementId() ?></td>
      <td><?php echo $rikssym_arrangement_country->getCountryId() ?></td>
      <td><a href="<?php echo url_for('arrangements/show?id='.$rikssym_arrangement_country->getId()) ?>"><?php echo $rikssym_arrangement_country->getId() ?></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('arrangements/new') ?>">New</a>
