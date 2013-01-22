<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $rikssym_indicator->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $rikssym_indicator->getName() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $rikssym_indicator->getDescription() ?></td>
    </tr>
    <tr>
      <th>Ispublic:</th>
      <td><?php echo $rikssym_indicator->getIspublic() ?></td>
    </tr>
    <tr>
      <th>Classname:</th>
      <td><?php echo $rikssym_indicator->getClassname() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('indicator/edit?id='.$rikssym_indicator->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('indicator/index') ?>">List</a>
