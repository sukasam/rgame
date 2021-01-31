<?php

include_once "../function/app_top.php";

if (isset($_GET['action']) && $_GET['action'] === 'submit') {

    $sid = $db->CleanDBData($_POST['sid']);
    $g_title = $db->CleanDBData($_POST['g_title']);

    $g_name = $db->CleanDBData($_POST['g_name']);
    $g_name2 = $db->CleanDBData($_POST['g_name2']);
    $g_name3 = $db->CleanDBData($_POST['g_name3']);

    $g_background_old = $db->CleanDBData($_POST['g_background_old']);
    $g_img_old = $db->CleanDBData($_POST['g_img_old']);
    $g_img_old2 = $db->CleanDBData($_POST['g_img_old2']);
    $g_img_old3 = $db->CleanDBData($_POST['g_img_old3']);

    $imgBackground = '';
    $imgCon = '';
    $imgCon2 = '';
    $imgCon3 = '';

    if ($_FILES["g_background"]["tmp_name"]) {
        $target_dir = '../../upload/background/';
        $filename = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241
        $extension = pathinfo($_FILES["g_background"]["name"], PATHINFO_EXTENSION); // jpg
        $basename = $filename . "." . $extension; // 5dab1961e93a7_1571494241.jpg

        $source = $_FILES["g_background"]["tmp_name"];
        $destination = $target_dir . $basename;

        @move_uploaded_file($source, $destination);

        @unlink($target_dir . $g_background_old);

        $imgBackground = $basename;

    } else {
        $imgBackground = $g_background_old;
    }

    if ($_FILES["g_img"]["tmp_name"]) {
        $target_dir = '../../upload/section/';
        $filename = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241
        $extension = pathinfo($_FILES["g_img"]["name"], PATHINFO_EXTENSION); // jpg
        $basename = $filename . "." . $extension; // 5dab1961e93a7_1571494241.jpg

        $source = $_FILES["g_img"]["tmp_name"];
        $destination = $target_dir . $basename;

        @move_uploaded_file($source, $destination);

        @unlink($target_dir . $g_background_old);

        $imgCon = $basename;

    } else {
        $imgCon = $g_img_old;
    }

    if ($_FILES["g_img2"]["tmp_name"]) {
        $target_dir = '../../upload/section/';
        $filename = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241
        $extension = pathinfo($_FILES["g_img2"]["name"], PATHINFO_EXTENSION); // jpg
        $basename = $filename . "." . $extension; // 5dab1961e93a7_1571494241.jpg

        $source = $_FILES["g_img2"]["tmp_name"];
        $destination = $target_dir . $basename;

        @move_uploaded_file($source, $destination);

        @unlink($target_dir . $g_background_old);

        $imgCon2 = $basename;

    } else {
        $imgCon2 = $g_img_old2;
    }

    if ($_FILES["g_img3"]["tmp_name"]) {
        $target_dir = '../../upload/section/';
        $filename = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241
        $extension = pathinfo($_FILES["g_img3"]["name"], PATHINFO_EXTENSION); // jpg
        $basename = $filename . "." . $extension; // 5dab1961e93a7_1571494241.jpg

        $source = $_FILES["g_img3"]["tmp_name"];
        $destination = $target_dir . $basename;

        @move_uploaded_file($source, $destination);

        @unlink($target_dir . $g_background_old);

        $imgCon3 = $basename;

    } else {
        $imgCon3 = $g_img_old3;
    }

    $sqlu2 = "update section3 set g_title=?,g_name=?,g_name2=?,g_name3=?,g_img=?,g_img2=?,g_img3=?, g_background=? where sid=?";
    $values2 = array($g_title, $g_name, $g_name2, $g_name3, $imgCon, $imgCon2, $imgCon3, $imgBackground, $sid);
    $model->doUpdate($sqlu2, $values2);

    header("Location:section3.php");

} else {
    $RecDataSQL = "SELECT * FROM section3 WHERE `sid` = ? LIMIT 1";
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
        <h3><i class="fa fa-angle-right"></i> Content Section 3</h3>
        <div class="row mt">
          <div class="col-lg-12">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" action="section3.php?action=submit" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Background Images <br>(1600px X 900px)</label>
                  <div class="col-sm-10">
                    <input name="g_background" type="file" class="form-control">
                    <input name="g_background_old" type="hidden" class="form-control" value="<?php echo $RecData[0]['g_background']; ?>">
                    <?php
if ($RecData[0]['g_background']) {?>
                        <br><a href="../../upload/background/<?php echo $RecData[0]['g_background']; ?>" target='_blank'><img src="../../upload/background/<?php echo $RecData[0]['g_background']; ?>" height="150" style="background-color: #ddd;"></a>
                        <?php
}
?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="g_title" value="<?php echo $RecData[0]['g_title']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Images 01<br>(300px X 500px)</label>
                  <div class="col-sm-10">
                    <input name="g_img" type="file" class="form-control">
                    <input name="g_img_old" type="hidden" class="form-control" value="<?php echo $RecData[0]['g_img']; ?>">
                    <?php
if ($RecData[0]['g_img']) {?>
                        <br><a href="../../upload/section/<?php echo $RecData[0]['g_img']; ?>" target='_blank'><img src="../../upload/section/<?php echo $RecData[0]['g_img']; ?>" height="150" style="background-color: #ddd;"></a>
                        <?php
}
?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Images Link 01</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="g_name" value="<?php echo $RecData[0]['g_name']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Images 02 <br>(300px X 500px)</label>
                  <div class="col-sm-10">
                    <input name="g_img2" type="file" class="form-control">
                    <input name="g_img_old2" type="hidden" class="form-control" value="<?php echo $RecData[0]['g_img2']; ?>">
                    <?php
if ($RecData[0]['g_img2']) {?>
                        <br><a href="../../upload/section/<?php echo $RecData[0]['g_img2']; ?>" target='_blank'><img src="../../upload/section/<?php echo $RecData[0]['g_img2']; ?>" height="150" style="background-color: #ddd;"></a>
                        <?php
}
?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Images Link 02</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="g_name2" value="<?php echo $RecData[0]['g_name2']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Images 03 <br>(300px X 500px)</label>
                  <div class="col-sm-10">
                    <input name="g_img3" type="file" class="form-control">
                    <input name="g_img_old3" type="hidden" class="form-control" value="<?php echo $RecData[0]['g_img3']; ?>">
                    <?php
if ($RecData[0]['g_img3']) {?>
                        <br><a href="../../upload/section/<?php echo $RecData[0]['g_img3']; ?>" target='_blank'><img src="../../upload/section/<?php echo $RecData[0]['g_img3']; ?>" height="150" style="background-color: #ddd;"></a>
                        <?php
}
?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Images Link 03</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="g_name3" value="<?php echo $RecData[0]['g_name3']; ?>">
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
