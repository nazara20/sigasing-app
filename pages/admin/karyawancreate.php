<?php
if (isset($_POST['button_create'])) {

    $database = new Database();
    $db = $database->getConnection();

    $validateSql = "SELECT * FROM karyawan WHERE nama_karyawan = ?";
    $stmt = $db->prepare($validateSql);
    $stmt->bindParam(1, $_POST['nama_karyawan']);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h5><i class="icon fas fa-ban"></i> Gagal</h5>
            Nama Karyawan sama sudah ada
        </div>
<?php
    } else {
        $insertSQL = "INSERT INTO karyawawn SET nama_karyawan = ?";
        $stmt = $db->prepare($insertSQL);
        $stmt->bindParam(1, $_POST['nama_karyawawn']);
        if ($stmt->execute()) {
            $_SESSION['hasil'] = true;
            $_SESSION['pesan'] = "Berhasil simpan data";
        } else {
            $_SESSION['hasil'] = false;
            $_SESSION['pesan'] = "Gagal simpan data";
        }
        echo "<meta http-equiv='refresh' content='0;url=?page=karyawanread'>";
    }
}

?>

<section class="content-header">
    <div class="containerfluid">
        <div class="row mb2">
            <div class="col-sm-6">
                <h1>Tambah Data Karyawan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                    <li class="breadcrumb-item"><a href="?page=karyawanread"> Karyawan</a></li>
                    <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Tambah Karyawan
            </h3>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="nik">Nama Induk Karyawan</label>
                    <input type="text" class="form-control" name="nik">
                </div>
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap">
                </div>
                <div class="form-group">
                    <label for="nama_karyawan">Handphone</label>
                    <input type="text" class="form-control" name="nama_karyawan">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email">
                </div>
                <a href="?=page=karyawanread" class="btn btn-danger btn-sm float-right">
                    <i class="fa fa-times"></i> Batal
                </a>
                <button type="submit" name="button_create" class="btn btn-success btn-sm float-right">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
</section>

<?php include_once "partials/scripts.php" ?>