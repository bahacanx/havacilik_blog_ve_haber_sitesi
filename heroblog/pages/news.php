<?php
$err = "";
require_once '../db_conn.php';
session_start();
ob_start();
if (!$_SESSION) {
    header('Location:signin.php');
}
// Başarılı bir şekilde eklendiğini kullanıcıya bildir
$err = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Lütfen İnternet Bağlantınızı Kontrol Edin..!</div>";
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <?php include '../include/head.php' ?>
</head>

<body>
    <?php include '../include/navigation.php' ?>

    <!-- Page Header-->
    <header class="masthead" style="background-image: url('../assets/img/uav11.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center text-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1>Haberler</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>



    <?php
    $xml_link = "https://www.airlinehaber.com/feed/";

    $data = file_get_contents($xml_link);


    $xml = simplexml_load_string($data);



    ?>

    <div class="container">
        <div class="row">


            <?php
            foreach ($xml->channel->item as $row) {
                $description = (string)$row->description;
                $link = (string)$row->link;

                preg_match('/<img[^>]+src="([^">]+)"/', $description, $matches);

                if (isset($matches[1])) {
                    $image_link = $matches[1];
                } else {
                }


            ?>
                <div class="col-12">

                    <div class="card mt-5">
                        <div class="card-header">
                            <?= $row->title ?>
                        </div>
                        <div class="card-body">
                            <?= $description ?>
                        </div>
                        <a href="<?= $link ?>" class="btn btn-primary">Haber için</a>
                    </div>

                </div>


            <?php } ?>



        </div>
    </div>









    <?php include '../include/footer.php' ?>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../js/scripts.js"></script>
</body>

</html>