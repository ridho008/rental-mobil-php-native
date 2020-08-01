<!-- menampilkan semua data tb_user -->
<?php 
$queryOrder = $conn->query("SELECT * FROM tb_mobil, tb_order WHERE tb_mobil.id_mobil = tb_order.id_mobil") or die(mysqli_error($conn));

if(isset($_POST['tambahmobil'])) {
	if(tambahmobil($_POST) > 0) {
		echo "<script>alert('Data Mobil berhasil ditambahkan.');window.location='?p=mobil';</script>";
	} else {
		echo "<script>alert('Data Mobil gagal ditambahkan.');window.location='?p=mobil';</script>";
	}
}

if(isset($_POST['ubahmobil'])) {
	if(ubahmobil($_POST) > 0) {
		echo "<script>alert('Data Mobil berhasil diubah.');window.location='?p=mobil';</script>";
	} else {
		echo "<script>alert('Data Mobil gagal diubah.');window.location='?p=mobil';</script>";
	}
}
?>
<?php 
// cek jika ada level 2 yang ingin mengakses level 1, akan di redirect ke halaman index utamanya.
if($_SESSION['level'] == 1) {
?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formTambahOrder">
  Tambah Data Order
</button>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Data Rental Mobil
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No.Polisi</th>
                        <th>Merk</th>
                        <th>Nama</th>
                        <th>Tujuan</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                	<?php 
                	$no = 1;
                	while($dOrder = $queryOrder->fetch_assoc()) {
                	?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $dOrder['no_polisi']; ?></td>
										<td><?= $dOrder['merk']; ?></td>
										<td><?= $dOrder['nama_order']; ?></td>
										<td><?= $dOrder['tujuan']; ?></td>
										<td><?= $dOrder['tgl_pinjam']; ?></td>
										<td><?= $dOrder['tgl_kembali']; ?></td>
										<td><?= $dOrder['hrg_total']; ?></td>
										<td>
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formUbahOrder<?= $dOrder['id_order']; ?>">
											  <i class="fas fa-user-edit"></i>
											</button>
											<a href="?p=hmobil&id=<?= $dOrder['id_order']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ?')"><i class="fas fa-trash"></i></a>
										</td>
									</tr>
									<!-- Modal Tambah User -->
									<div class="modal fade" id="formUbahOrder<?= $dOrder['id_order']; ?>" tabindex="-1" role="dialog" aria-labelledby="formUbahMobilLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="formUbahMobilLabel">Ubah Data Mobil</h5>
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span>
									        </button>
									      </div>
									      <div class="modal-body">
									        <form action="" method="post">
									        	<input type="text" name="id" value="<?= $dMobil['id_mobil']; ?>">
									        	<div class="form-group">
										      		<label for="polisi">No.Polisi</label>
										      		<input type="text" name="polisi" value="<?= $dMobil['no_polisi']; ?>" id="polisi" class="form-control">
										      	</div>
										      	<div class="form-group">
										      		<label for="merk">Merk</label>
										      		<input type="text" name="merk" id="merk" class="form-control" value="<?= $dMobil['merk']; ?>">
										      	</div>
										      	<div class="form-group">
										      		<label for="tahun">Tahun</label>
										      		<input type="number" name="tahun" id="tahun" class="form-control" value="<?= $dMobil['tahun']; ?>">
										      	</div>
										      	<div class="form-group">
										      		<label for="hrg_mobil">Harga</label>
										      		<input type="number" name="hrg_mobil" id="hrg_mobil" class="form-control" value="<?= $dMobil['hrg_mobil']; ?>">
										      	</div>
												      <div class="modal-footer">
												        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												        <button type="submit" name="ubahmobil" class="btn btn-primary">Ubah</button>
												      </div>
									        </form>
									      </div>
									    </div>
									  </div>
									</div>
                	<?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal Tambah User -->
<div class="modal fade" id="formTambahOrder" tabindex="-1" role="dialog" aria-labelledby="formTambahOrderLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formTambahOrderLabel">Tambah Data Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
        	<div class="form-group">
        		<label for="polisi">No.Polisi</label>
        		<input type="text" name="polisi" id="polisi" class="form-control">
        	</div>
        	<div class="form-group">
        		<label for="merk">Merk</label>
        		<input type="text" name="merk" id="merk" class="form-control">
        	</div>
        	<div class="form-group">
        		<label for="tahun">Tahun</label>
        		<input type="number" name="tahun" id="tahun" class="form-control">
        	</div>
        	<div class="form-group">
        		<label for="hrg_mobil">Harga</label>
        		<input type="number" name="hrg_mobil" id="hrg_mobil" class="form-control">
        	</div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" name="tambahmobil" class="btn btn-primary">Tambah</button>
			      </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php 
} else {
	header("Location: index.php");
	exit;
} 

?>