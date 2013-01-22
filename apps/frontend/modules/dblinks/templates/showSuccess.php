<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $rikssym_dblinks->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $rikssym_dblinks->getName() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $rikssym_dblinks->getDescription() ?></td>
    </tr>
    <tr>
      <th>Url:</th>
      <td><?php echo $rikssym_dblinks->getUrl() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('dblinks/edit?id='.$rikssym_dblinks->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('dblinks/index') ?>">List</a>
