<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $database = new Database();
    $db = $database->getConnection();


    $deleteSQL = "DELETE FROM karyawan WHERE id = ?";
    $stmt = $db->prepare($deleteSQL);
    $stmt->bindParam(1, $_GET['id']);
    if ($stmt->execute()) {
        $_SESSION['hasil'] = true;
        $_SESSION['pesan'] = "Berhasil dihapus";
    } else {
        $_SESSION['hasil'] = false;
        $_SESSION['pesan'] = "Gagal dihapus";
    }

    $deletePenggunaSQL = "DELETE FROM pengguna WHERE id = ?";
    $stmt = $db->prepare($deletePenggunaSQL);
    $stmt->bindParam(1, $_GET['id']);
    if ($stmt->execute()) {
        $_SESSION['hasil'] = true;
        $_SESSION['pesan'] = "Berhasil dihapus";
    } else {
        $_SESSION['hasil'] = false;
        $_SESSION['pesan'] = "Gagal dihapus";
    }
}
echo "<meta http-equiv='refresh' content='0;url=?page=karyawanread'>";
