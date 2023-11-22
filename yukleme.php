<?php
$maxBoyut = 51200; // 50 MB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES["dosya"])) {
        $dosyaAdi = $_FILES["dosya"]["name"];
        $dosyaBoyutu = $_FILES["dosya"]["size"];
        $dosyaTuru = $_FILES["dosya"]["type"];
        $dosyaGeciciYolu = $_FILES["dosya"]["tmp_name"];

        if (!empty($dosyaAdi)) {
            $dosyaBilgisi = pathinfo($dosyaAdi);
            $dosyaUzantisi = strtolower($dosyaBilgisi["extension"]);
            $dosyaAdi = uniqid() . "." . $dosyaUzantisi;
            $dosyaYolu = "dosya/" . $dosyaAdi;

            if ($dosyaBoyutu > $maxBoyut) {
                echo "Dosya boyutu en fazla <b>50 MB</b> olmalıdır.";
            } else {
                $izinliUzantilar = ["jpeg", "jpg", "png", "gif", "heic"];
                if (in_array($dosyaUzantisi, $izinliUzantilar)) {
                    if (move_uploaded_file($dosyaGeciciYolu, $dosyaYolu)) {
                        echo "<b>{$dosyaAdi}</b> adlı dosya başarı ile yüklendi.
                        <img src ='{$dosyaYolu}'>";
                    } else {
                        echo "Dosya taşınırken bir sorun ile karşılaştı.";
                    }
                } else {
                    echo "Dosya boyutu uygun fakat format uygun değil ('jpeg', 'jpg', 'png', 'gif', 'heic').";
                }
            }
        } else {
            echo "Dosya adı boş.";
        }
    } else {
        echo "Dosya yüklenemedi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dosyaYukle</title>
</head>

<body>
    <form action="yukleme.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="dosya" />
        <input type="submit" value="Yükle">
    </form>
</body>

</html>