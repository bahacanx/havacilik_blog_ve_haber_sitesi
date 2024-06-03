<?php

try {
  $pdo = new PDO('mysql:host=localhost;dbname=heroblog', 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Bağlantı hatası: " . $e->getMessage();
}



function kisalt($metin, $uzunluk)
{
  // Eğer metin belirtilen uzunluktan kısa ise, metni doğrudan döndür
  if (strlen($metin) <= $uzunluk) {
    return $metin;
  }
  // Belirtilen uzunlukta bir alt metin al ve sonuna üç nokta koy
  $kisaltilmis_metin = substr($metin, 0, $uzunluk) . '...';
  return $kisaltilmis_metin;
}
