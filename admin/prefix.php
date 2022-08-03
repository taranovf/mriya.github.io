<?php
include("../assets/config.php");
$me = mysqli_query($bsd, "SELECT * FROM `users` WHERE sid='$_COOKIE[sid]'");
if ( $mm = $me->fetch_array() ){

$prava = $mm['prava'];
$uname = $mm['name'];
$uava = $mm['img'];
}

if ( $prava != 1 ){

header("Location: /");

}else{

$prefixs = mysqli_query($bsd, "SELECT * FROM `prefix` ORDER BY id DESC");

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Админ-панель</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ned.im/noty/v2/vendor/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="https://ned.im/noty/v2/vendor/noty-2.4.1/js/noty/packaged/jquery.noty.packaged.js"></script>
    <script type="text/javascript" src="https://ned.im/noty/v2/vendor/google-code-prettify/prettify.js"></script>
    <script type="text/javascript" src="https://ned.im/noty/v2/vendor/share.min.js"></script>
    <script type="text/javascript" src="https://ned.im/noty/v2/vendor/showdown/showdown.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>



        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="<?=$uava?>" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?=$uname?></span>
                  <span class="text-secondary text-small">Администратор</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/admin/">
                <span class="menu-title">Главная</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="/admin/users.php">
                <span class="menu-title">Пользователи</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/admin/prefix.php">
                <span class="menu-title">Привилегии</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="/admin/withdraws.php">
                <span class="menu-title">Выплаты</span>
                <i class="mdi mdi-arrow-bottom-left-bold-outline menu-icon"></i>
              </a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="/admin/deposits.php">
                <span class="menu-title">Пополнения</span>
                <i class="mdi mdi-arrow-top-right-bold-outline menu-icon"></i>
              </a>
            </li>


            <li class="nav-item sidebar-actions">
              <span class="nav-link">


                  <a href="/"><button class="btn btn-block btn-lg btn-gradient-primary mt-4"><i class="mdi mdi-arrow-left"></i></button></a>

              </span>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Привилегии </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Привилегии проекта <i title="Скрипт куплен в ScriptArchive / у пользователя Enigman / Никиты Корнеева" class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>

            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="clearfix">
                      <h4 class="card-title float-left">Привилегии</h4>
                      <a href="/admin/addprefix.php"><button class="btn btn-gradient-primary float-right">Создать новый</button></a>
                      </div>
                      <script>
                        function deletePrefix(id){

$.ajax({
type: 'POST',
url: 'adminengine.php',
data: {
type: 'deletePrefix',
id: id,

},
success: function(data){

var obj = jQuery.parseJSON(data);

if ( obj.msgType == "success" ){

$(".privilegystable").load("/admin/prefix.php .privilegystable");

}else{

noty({
  text: 'Изменения сохранены!',
    type: 'success',
    timeout: 4000,
  });

}

}

});

                        }
                      </script>
<table class="table table-hover privilegystable">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Префикс</th>
                          <th>Необходимый депозит</th>
                          <th>Цвет префикса</th>
                          <th>Ежедневный бонус</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          while( ($ue = $prefixs->fetch_array())){

$prefix = $ue['prefix'];
$depos = $ue['deposit'];
$color = $ue['color'];
$bonussize = $ue['bonussize'];


                              $pe.= "<tr>
                              <td>$ue[id]</td>
                          <td>$prefix</a></td>
                          <td>$depos</td>
                          <td>$color</td>
                          <td>$bonussize</td>
                          <td><button onClick=\"deletePrefix($ue[id]);\" class=\"badge badge-primary\">Удалить</button></a></td>
                        </tr>";

                          }

echo $pe;
                        ?>





                      </tbody>
                    </table>





                  </div>
                </div>
              </div>



</div>

          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">https://vk.com/kur4ch_yt</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Сделано в ScriptArchive с  <i class="mdi mdi-heart text-danger"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>

    <!-- End custom js for this page -->
  </body>
</html>