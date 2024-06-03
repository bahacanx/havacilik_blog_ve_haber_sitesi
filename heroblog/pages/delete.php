<?php
require_once '../db_conn.php';
$id = $_GET["id"];

try {
  // Kullanıcıya ait blogları sil
  $sql2 = "DELETE FROM blogs WHERE id = :id";
  $stmt2 = $pdo->prepare($sql2);
  $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt2->execute();

  if ($stmt2->rowCount() > 0) {
      // Bloglar başarıyla silindi
      $err = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Veriler başarıyla silindi..
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      header('Refresh: 2; url=myblog.php');
  } else {
      // Silinecek blog bulunamadı
      $err = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Silinecek blog bulunamadı.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
  }
} catch (PDOException $e) {
  // Hata durumunda hata mesajını ekrana yazdır
  echo "Failed: " . $e->getMessage();
}
