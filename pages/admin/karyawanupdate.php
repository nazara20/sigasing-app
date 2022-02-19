<?php
if (isset($_GET['id'])) {
    $database = new Database();
    $db = $database->getConnection();

    $id = $_GET['id'];
    $findSql = "SELECT K.*, P.* FROM karyawan K
    INNER JOIN pengguna P ON K.pengguna_id = p.id WHERE k.id = ?";
    $stmt = $db->prepare($findSql);
    $stmt->bindParam(1, $_GET['id']);
    $stmt->execute();
    $row = $stmt->fetch();
    if (isset($row['id'])) {
        if (isset($_POST['button_update'])) {

            $database = new Database();
            $db = $database->getConnection();

            $validateSQL = "SELECT * FROM karyawan WHERE nik = ? AND id != ?";
            $stmt = $db->prepare($validateSQL);
            $stmt->bindParam(1, $_POST['nik']);
            $stmt->bindParam(2, $_POST['id']);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h5><i class="icon fas fa-ban"></i> Gagal</h5>
                    NIK sama sudah ada
                </div>
                <?php
            } else {
                if ($_POST['password'] != $_POST['password_ulangi']) {
                ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h5><i class="icon fas fa-ban"></i> Gagal</h5>
                        Password tidak sama
                    </div>
                <?php
                } else {
                    $md5Password = md5($_POST['password']);
                    $updateSQL = "UPDATE pengguna SET (NULL, ?, ?, ?, NULL) WHERE id = ?";
                    $stmt = $db->prepare($updateSQL);
                    $stmt->bindParam(1, $_POST['username']);
                    $stmt->bindParam(2, $md5Password);
                    $stmt->bindParam(3, $_POST['peran']);
                    $stmt->bindParam(4, $_POST['id']);
                    if ($stmt->execute()) {
                        $insertKaryawanSQL = "UPDATE karyawan VALUES (NULL, ?, ?, ?, ?, ?) WHERE id = ?";
                        $stmtKaryawan->bindParam(1, $_POST['nik']);
                        $stmtKaryawan->bindParam(2, $_POST['nama_lengkap']);
                        $stmtKaryawan->bindParam(3, $_POST['handphone']);
                        $stmtKaryawan->bindParam(4, $_POST['email']);
                        $stmtKaryawan->bindParam(5, $_POST['tanggal_masuk']);
                        $stmtKaryawan->bindParam(6, $_POST['id']);
                        if ($stmtKaryawan->execute()) {
                            $_SESSION['hasil'] = true;
                            $_SESSION['pesan'] = "Berhasil ubah data";
                        } else {
                            $_SESSION['hasil'] = false;
                            $_SESSION['pesan'] = "Gagal ubah data";
                        }
                    } else {
                        $_SESSION['hasil'] = false;
                        $_SESSION['pesan'] = "Gagal ubah data";
                    }
                    echo "<meta http-equiv='refresh' content='0;url=?page=karyawanread'>";
                }
            }
        }
    }
}
?>

<section class="content-header">
    <div class="container-fluid">
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
                    <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'] ?>">
                    <label for="nik">Nama Induk Karyawan</label>
                    <input type="text" class="form-control" name="nik" value="<?php echo $row['nik'] ?>">
                </div>
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $row['nama_lengkap'] ?>">
                </div>
                <div class="form-group">
                    <label for="handphone">Handphone</label>
                    <input type="number" class="form-control" name="handphone" value="<?php echo $row['handphone'] ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>">
                </div>
                <div class="form-group">
                    <label for="tanggal_masuk">Tanggal Masuk</label>
                    <input type="date" class="form-control" name="tanggal_masuk" value="<?php echo $row['tanggal_masuk'] ?>">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $row['username'] ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label for="password_ulangi">Password(Ulangi)</label>
                    <input type="password" class="form-control" name="password_ulangi">
                </div>
                <div class="form-group">
                    <label for="peran">Peran</label>
                    <select class="form-control" name="peran">
                        <option value="<?php echo $row['peran'] ?>"><?php echo $row['peran'] ?></option>
                        <option value="ADMIN">ADMIN</option>
                        <option value="USER">USER</option>
                    </select>
                </div>
                <a href="?page=karyawanread" class="btn btn-danger btn-sm float-right">
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