<?php
$err = "";
require_once '../db_conn.php';
session_start();
ob_start();
if (!$_SESSION) {
    header('Location:signin.php');
}

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_SESSION["username"]; // Kullanıcı adını tanımla
    $sql_user = "SELECT id FROM users WHERE username = :username"; // Kullanıcı adına göre sorguyu hazırla
    $stmt = $pdo->prepare($sql_user); // Sorguyu hazırla
    $stmt->bindParam(':username', $username, PDO::PARAM_STR); // Parametreleri bağla
    $stmt->execute(); // Sorguyu çalıştır
    $user_result = $stmt->fetch(PDO::FETCH_ASSOC); // Sonucu al
    $user_id = $user_result['id']; // Kullanıcı id'sini al

    $title = $_POST['title'];
    $image = $_POST['image'];
    $text = $_POST['text'];
    $time = date("d-m-Y");


    try {
        $query = $pdo->prepare("INSERT INTO blogs (user_id, title, image, text, time) VALUES (:user_id, :title, :image, :text, :time)");

        $query->execute(array(":user_id" => $user_id, ":title" => $title, ":image" => $image, ":text" => $text, ":time" => $time));


        // Başarılı bir şekilde eklendiğini kullanıcıya bildir
        $err = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Blog başarıyla eklendi..
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    } catch (PDOException $e) {
        // Ekleme sırasında bir hata oluştuysa hata mesajını göster
        echo "Hata: " . $e->getMessage();
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../include/head.php' ?>
</head>

<body>
    <?php include '../include/navigation.php' ?>

    <?php

    try {
        $query = $pdo->prepare("SELECT * FROM blogs");
        $query->execute();
        $time = date("d-m-Y");
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $blog_id = $row['id'];
            $user_id = $row['user_id'];
            $title = $row['title'];
            $image = $row['image'];
            $text = $row['text'];
            $time = $row['time'];
        }

    ?>

        <!-- Page Header-->
        <header class="masthead" style="background-image: url('../assets/img/uav9.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center text-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1>Yeni Bir Blog Ekleyin</h1>
                            <span class="meta">
                                <?php echo $time; ?> tarihinde
                                <a href="#!"><?php echo $username; ?></a> tarafından yayınlandı.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>


    <?php
    } catch (PDOException $e) {
        // Eğer bir hata olursa hatayı yakalayıp ekrana yazdırabiliriz
        echo "Hata: " . $e->getMessage();
    }
    ?>


    <div class="container">
        <form action="" method="post" class="row">
            <?= $err ?>
            <div class="row col-12">
                <div class="newpost">
                    <div class="mb-3 shadow-lg rounded">
                        <input required type="text" name="title" id="title" class="form-control" placeholder="Başlık Girin" value="">
                    </div>
                </div>
                <div class="newpost">
                    <div class="input-group mb-3 shadow-lg rounded">
                        <input type="file" name="image" id="image" class="form-control form-control-lg" value="">
                    </div>
                </div>
                <div class="newpost">
                    <div class="input-group mb-3 shadow-lg rounded">
                        <textarea class="form-control" name="text" id="text" cols="60" rows="10" placeholder="Blog Metni Girin" value=""></textarea>
                    </div>
                </div>
                <div class="newpost-button mb-3 ">
                    <button type="submit" name="submit" class="btn btn-light border">Bloğu Kaydet</button>
                </div>
            </div>
        </form>
    </div>



    <?php include '../include/footer.php' ?>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../js/scripts.js"></script>
</body>

</html>