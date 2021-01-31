<?php

include_once "../function/app_top.php";

if (isset($_GET['action']) && $_GET['action'] === 'submit') {

    $sid = $db->CleanDBData($_POST['sid']);
    $maintenance = $db->CleanDBData($_POST['maintenance']);
    $g_title = $db->CleanDBData($_POST['g_title']);
    $g_description = $db->CleanDBData($_POST['g_description']);
    $g_keywords = $db->CleanDBData($_POST['g_keywords']);
    $g_author = $db->CleanDBData($_POST['g_author']);
    $social_telegram = $db->CleanDBData($_POST['social_telegram']);
    $social_instagram = $db->CleanDBData($_POST['social_instagram']);
    $social_youtube = $db->CleanDBData($_POST['social_youtube']);
    $g_login = $db->CleanDBData($_POST['g_login']);
    $g_register = $db->CleanDBData($_POST['g_register']);

    $g_logo_old = $db->CleanDBData($_POST['g_logo_old']);

    if ($_FILES["g_logo"]["tmp_name"]) {
        $target_dir = '../../upload/logo/';
        $filename = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241
        $extension = pathinfo($_FILES["g_logo"]["name"], PATHINFO_EXTENSION); // jpg
        $basename = $filename . "." . $extension; // 5dab1961e93a7_1571494241.jpg

        $source = $_FILES["g_logo"]["tmp_name"];
        $destination = $target_dir . $basename;

        @move_uploaded_file($source, $destination);

        @unlink($target_dir . $g_logo_old);

        $sqlu2 = "update setting set maintenance=?,g_logo=?,g_title=?,g_description=?,g_keywords=?,g_author=?,social_telegram=?,social_instagram=?,social_youtube=?,g_login=?,g_register=? where sid=?";
        $values2 = array($maintenance, $basename, $g_title, $g_description, $g_keywords, $g_author, $social_telegram, $social_instagram, $social_youtube, $g_login, $g_register, $sid);

    } else {
        $sqlu2 = "update setting set maintenance=?,g_logo=?,g_title=?,g_description=?,g_keywords=?,g_author=?,social_telegram=?,social_instagram=?,social_youtube=?,g_login=?,g_register=? where sid=?";
        $values2 = array($maintenance, $g_logo_old, $g_title, $g_description, $g_keywords, $g_author, $social_telegram, $social_instagram, $social_youtube, $g_login, $g_register, $sid);
    }

    $model->doUpdate($sqlu2, $values2);

    header("Location:setting.php");

} else {
    $RecDataSQL = "SELECT * FROM setting WHERE `sid` = ? LIMIT 1";
    $valuesRecDataSQL = array('1');
    $RecData = $model->doSelect($RecDataSQL, $valuesRecDataSQL);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Lion Royal Casino</title>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker/css/datepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-timepicker/compiled/timepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-datetimepicker/css/datetimepicker.css" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <section id="container">
    <?php include_once "top_bar.php";?>
    <?php include_once "sidebar_menu.php";?>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Setting</h3>
        <div class="row mt">
          <div class="col-lg-12">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" action="setting.php?action=submit" enctype="multipart/form-data">
              <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Logo Images <br>(300px X 150px)</label>
                  <div class="col-sm-10">
                    <input name="g_logo" type="file" class="form-control">
                    <input name="g_logo_old" type="hidden" class="form-control" value="<?php echo $RecData[0]['g_logo']; ?>">
                    <?php
if ($RecData[0]['g_logo']) {?>
                        <br><img src="../../upload/logo/<?php echo $RecData[0]['g_logo']; ?>" height="150" style="background-color: #ddd;">
                        <?php
}
?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Site Maintenance</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="maintenance" title="Maintenance">
                      <option value="0" <?php if ($RecData[0]['maintenance'] == '0') {echo 'selected=""';}?>>No</option>
                      <option value="1" <?php if ($RecData[0]['maintenance'] == '1') {echo 'selected=""';}?>>Yes</option>
                    </select>
                  </div>
                </div>
                <h3>Website Setting</h3>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Site Title</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="g_title" value="<?php echo $RecData[0]['g_title']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Site Description</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="g_description" value="<?php echo $RecData[0]['g_description']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Site Keywords</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="g_keywords" value="<?php echo $RecData[0]['g_keywords']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Site Author</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="g_author" value="<?php echo $RecData[0]['g_author']; ?>">
                  </div>
                </div>
                <h3></i>Social Media</h3>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Social Telegram</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="social_telegram" value="<?php echo $RecData[0]['social_telegram']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Social Instagram</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="social_instagram" value="<?php echo $RecData[0]['social_instagram']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Social Youtube</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="social_youtube" value="<?php echo $RecData[0]['social_youtube']; ?>">
                  </div>
                </div>
                <h3>Link External</h3>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Login</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="g_login" value="<?php echo $RecData[0]['g_login']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Register</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="g_register" value="<?php echo $RecData[0]['g_register']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 text-center">
                  <button class="btn btn-theme" type="submit">Save</button>
                  <input type="hidden" class="form-control" name="sid" value="1">
                  <!-- <button class="btn btn-theme04" type="button" onClick="window.location='setting.php';">Cancel</button> -->
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <?php include_once "footer_bar.php";?>
  </section>

  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!-- <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script> -->
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js"></script>

  <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->

  <script>

  $(document).ready(function() {
    $(".form_datetime").datetimepicker({
      format: "mm/dd/yyyy HH:ii P",
      showMeridian: true,
      autoclose: true,
      todayBtn: true
    });
  });
  </script>

</body>

</html>
