<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $rikssym_center->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $rikssym_center->getName() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $rikssym_center->getDescription() ?></td>
    </tr>
    <tr>
      <th>Region:</th>
      <td><?php echo $rikssym_center->getRegionId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('center/edit?id='.$rikssym_center->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('center/index') ?>">List</a>
