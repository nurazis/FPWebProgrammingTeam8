<?php

require '../koneksi.php';

$key = $_GET['keyword'];
  $result = mysqli_query($conn, "SELECT * FROM kupon WHERE kode LIKE '%" . $key . "%'");
  $kupon = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $kupon[] = $row;
  }



?>

<table border="1">
        <tr>
          <th>No.</th>
          <th>Kode</th>
          <th>Diskon</th>
          <th>Aksi</th>
        </tr>
        <?php $i = 1;
        foreach ($kupon as $kpn) : ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $kpn["kode"]; ?></td>
            <td><?php echo $kpn["disc"]; ?></td>
            <td>
              <div class="aksi">
                <a href="editkupon.php?id=<?php echo $kpn['id']; ?>"><i class="fas fa-edit fa-2x" style="color: green;"></i></a>
                <a href="hapus.php?id=<?php echo $kpn['id']; ?>&tabel=kupon" onclick="return confirm('Yakin ingin menghapus data?');"><i class="fas fa-trash fa-2x" style="color: red;"></i></a>
              </div>
            </td>
          </tr>
        <?php $i++;
        endforeach; ?>
      </table>