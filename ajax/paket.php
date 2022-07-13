<?php 
require '../koneksi.php';

$key = $_GET['keyword'];
  $result = mysqli_query($conn, "SELECT * FROM paket WHERE nama LIKE '%" . $key . "%'");
  $paket = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $paket[] = $row;
  }


?>

<table border="1">
        <tr>
          <th>No.</th>
          <th>Nama Paket Wisata</th>
          <th>Deskripsi</th>
          <th>Keterangan</th>
          <th>Tanggal Berangkat</th>
          <th>Harga</th>
          <th>Link Gambar</th>
          <th>Aksi</th>
        </tr>
        <?php $i = 1;
        foreach ($paket as $pkt) : ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $pkt["nama"]; ?></td>
            <td><?php echo $pkt["deskripsi"]; ?></td>
            <td><?php echo $pkt["keterangan"]; ?></td>
            <td><?php echo $pkt["tanggal_berangkat"]; ?></td>
            <td><?php echo $pkt["harga"]; ?></td>
            <td><?php echo $pkt["image"]; ?></td>
            <td>
              <div class="aksi">
                <a href="editpaket.php?id=<?php echo $pkt['id']; ?>"><i class="fas fa-edit fa-2x" style="color: green; margin: 0 5px;"></i></a>
                <a href="hapus.php?id=<?php echo $pkt['id']; ?>&tabel=paket" onclick="return confirm('Yakin ingin menghapus data?');"><i class="fas fa-trash fa-2x" style="color: red; margin: 0 5px;"></i></a>
              </div>
            </td>
          </tr>
        <?php $i++;
        endforeach; ?>
      </table>