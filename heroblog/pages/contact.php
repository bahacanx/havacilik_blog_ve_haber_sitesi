<?php
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


    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    try {
        // Veritabanına ekleme sorgusunu hazırla
        $query = $pdo->prepare("INSERT INTO messages (user_id, name, email, phone, message) VALUES (:user_id, :name, :email, :phone, :message)");

        // Sorguyu parametrelerle birleştir ve çalıştır
        $query->execute(array(":user_id" => $user_id, ":name" => $name, ":email" => $email, ":phone" => $phone, ":message" => $message));

        // Başarılı bir şekilde eklendiğini kullanıcıya bildir
        $err = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Mesaj başarıyla gönderildi..
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";

        header('Refresh: 2; url=main.php');
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

    <!-- Page Header-->
    <header class="masthead" style="background-image: url('../assets/img/contact-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center text-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1>Bize Ulaşın</h1>
                        <span class="subheading">Aşağıdaki form üzerinden bizimle iletişime geçebilirsiniz.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <?php

    $username = $_SESSION["username"]; // Kullanıcı adını tanımla

    // Kullanıcının bilgilerini al
    $sql_user = "SELECT * FROM users WHERE username = :username"; // Kullanıcı adına göre sorguyu hazırla
    $stmt = $pdo->prepare($sql_user); // Sorguyu hazırla
    $stmt->bindParam(':username', $username, PDO::PARAM_STR); // Parametreleri bağla
    $stmt->execute(); // Sorguyu çalıştır
    $user_result = $stmt->fetch(PDO::FETCH_ASSOC); // Sonucu al

    ?>


    <!-- Main Content-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="my-5">
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form id="contactForm" action="" method="post" data-sb-form-api-token="API_TOKEN">
                            <?= $err ?>
                            <div class="col-md-10 col-lg-8 col-xl-7">
                                <div class="form-floating">
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                                    <label for="name">Ad Soyad</label>
                                    <div class="invalid-feedback" data-sb-feedback="name:required">Bu bölüm zorunlu.</div>
                                </div>
                                <div class="form-floating">
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Enter your email..." data-sb-validations="required,email" value="<?php echo $user_result['email'];
                                                                                                                                                                                    ?>" />
                                    <label for="email">Email Adresi</label>
                                    <div class="invalid-feedback" data-sb-feedback="email:required">Bu bölüm zorunlu.</div>
                                    <div class="invalid-feedback" data-sb-feedback="email:email">Email adresi geçerli değil.</div>
                                </div>
                                <div class="form-floating">
                                    <input class="form-control" id="phone" name="phone" type="text" placeholder="Enter your phone number..." data-sb-validations="required" />
                                    <label for="phone">Telefon Numarası</label>
                                    <div class="invalid-feedback" data-sb-feedback="phone:required">Bu bölüm zorunlu.</div>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" id="message" name="message" placeholder="Enter your message here..." style="height: 12rem" data-sb-validations="required"></textarea>
                                    <label for="message">Mesaj</label>
                                    <div class="invalid-feedback" data-sb-feedback="message:required">Bu bölüm zorunlu.</div>
                                </div>
                                <br />
                                <!-- Submit Button-->
                                <button type="submit" name="submit" class="btn btn-light border">Gönder</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include '../include/footer.php' ?>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>