<?php
  $no = 1;
  foreach ($dataLogs as $logs) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $logs->nama; ?></td>
      <td><?php echo $logs->deskripsi; ?></td>
      <td><?php echo $logs->created_at; ?></td>
    </tr>
    <?php
    $no++;
  }
?>