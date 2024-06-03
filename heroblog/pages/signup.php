<?php
$err = "";
require_once '../db_conn.php';

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Formdan gelen verileri al
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password = md5($password);

  try {
    // Veritabanına ekleme sorgusunu hazırla
    $query = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");

    // Sorguyu parametrelerle birleştir ve çalıştır
    $query->execute(array(":username" => $username, ":email" => $email, ":password" => $password));

    // Başarılı bir şekilde eklendiğini kullanıcıya bildir
    $err = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Kayıt Başarıyla Gerçekleşti
        </div>";

    header('Refresh: 2; url=signin.php');
  } catch (PDOException $e) {
    // Ekleme sırasında bir hata oluştuysa hata mesajını göster
    echo "Hata: " . $e->getMessage();
  }
}



?>


<!doctype html>
<html lang="en">

<head>
  <title>Kayıt Ol</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="../css/bootstrap.min.css">

</head>

<body class="img js-fullheight" style="background-image: url(../assets/img/uav7.jpg);">
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-2 text-center mb-2">
          <h2 class="heading-section">Hero Blog</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
          <div class="login-wrap p-0">
            <h3 class="mb-2 text-center"><a href="signin.php" class="hesapmi">Hesabınız</a> Var mı?</h3>
            <form action="" method="post" class="signin-form">
              <?= $err ?>
              <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Kullanıcı Adı" required>
              </div>
              <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
              </div>
              <div class="form-group">
                <input id="password-field" type="password" name="password" class="form-control" placeholder="Parola" required>
                <span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
              </div>
              <div class="form-group">
                <input id="confirm-password-field" type="password" name="password" class="form-control" placeholder="Parolanızı Doğrulayın" required>
                <span toggle="#confirm-password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
              </div>

              <div class="form-group">
                <button type="submit" name="submit" class="form-control btn btn-primary submit px-3">Kayıt Ol</button>
              </div>
            </form>
            <p class="w-100 text-center">&mdash; Veya Şununla Kayıt Ol &mdash;</p>
            <div class="social d-flex text-center">
              <a href="#" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Facebook</a>
              <a href="#" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span> Google</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</body>

</html>



<script>
 document.querySelectorAll('.toggle-password').forEach(function(el) {
    el.addEventListener('click', function() {
        var passwordField = document.querySelector(this.getAttribute('toggle'));

        // Parola alanının tipini kontrol ederek değiştirme
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            this.classList.remove('fa-eye-slash');
            this.classList.add('fa-eye');
        } else {
            passwordField.type = 'password';
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        }
    });
});



  (function($) {

    "use strict";

    var fullHeight = function() {

      $('.js-fullheight').css('height', $(window).height());
      $(window).resize(function() {
        $('.js-fullheight').css('height', $(window).height());
      });

    };
    fullHeight();

    $(".toggle-password").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });

  })(jQuery);
</script>