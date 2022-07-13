<?php 

require '../koneksi.php';

$key = $_GET['keyword'];
$result = mysqli_query($conn, "SELECT * FROM akun WHERE CONCAT(f_name,' ',l_name) LIKE '%" . $key . "%'");

  $akun = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $akun[] = $row;
  }

 ?>

 <table border="1">
        <tr>
          <th>No.</th>
          <th>Nama Depan</th>
          <th>Nama Belakang</th>
          <th>Tanggal Lahir</th>
          <th>No. Telp</th>
          <th>Email</th>
          <th>Nama Pengguna</th>
          <th>Aksi</th>
        </tr>
        <?php $i = 1;
        foreach ($akun as $acc) : ?>
          <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $acc["f_name"]; ?></td>
            <td><?php echo $acc["l_name"]; ?></td>
            <td><?php echo $acc["tanggal_lahir"]; ?></td>
            <td><?php echo $acc["no_telp"]; ?></td>
            <td><?php echo $acc["email"]; ?></td>
            <td><?php echo $acc["username"]; ?></td>
            <td><a href="hapus.php?id=<?php echo $acc['id']; ?>&tabel=akun" onclick="return confirm('Yakin ingin menghapus data?');"><i class="fas fa-trash fa-1x" style="color: red;"></i></a></td>
          </tr>
        <?php $i++;
        endforeach; ?>
      </table>