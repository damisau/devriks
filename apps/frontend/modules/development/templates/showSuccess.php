<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $rikssym_development->getId() ?></td>
    </tr>
    <tr>
      <th>Title:</th>
      <td><?php echo $rikssym_development->getTitle() ?></td>
    </tr>
    <tr>
      <th>Text:</th>
      <td><?php echo $rikssym_development->getText() ?></td>
    </tr>
    <tr>
      <th>Date published:</th>
      <td><?php echo $rikssym_development->getDatePublished() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('development/edit?id='.$rikssym_development->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('development/index') ?>">List</a>
