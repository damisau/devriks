<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $rikssym_journal->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $rikssym_journal->getName() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $rikssym_journal->getDescription() ?></td>
    </tr>
    <tr>
      <th>Url:</th>
      <td><?php echo $rikssym_journal->getUrl() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('journal/edit?id='.$rikssym_journal->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('journal/index') ?>">List</a>
