<?php

include_once "../function/app_top.php";

if (isset($_GET['action']) && $_GET['action'] === 'submit') {

    $sid = $db->CleanDBData($_POST['sid']);
    $g_title = $db->CleanDBData($_POST['g_title']);
    $g_detail = $db->CleanDBData($_POST['g_detail']);
    $g_link = $db->CleanDBData($_POST['g_link']);

    $g_background_old = $db->CleanDBData($_POST['g_background_old']);

    $imgBackground = '';
    $imgCon = '';

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


    $sqlu2 = "update section2 set g_title=?,g_detail=?,g_link=?,g_background=? where sid=?";
    $values2 = array($g_title,$g_detail,$g_link, $imgBackground, $sid);
    $model->doUpdate($sqlu2, $values2);

    header("Location:section2.php");

} else {
    $RecDataSQL = "SELECT * FROM section2 WHERE `sid` = ? LIMIT 1";
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
        <h3><i class="fa fa-angle-right"></i> Content Section 2</h3>
        <div class="row mt">
          <div class="col-lg-12">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" action="section2.php?action=submit" enctype="multipart/form-data">
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
                  <label class="col-sm-2 control-label">Detail</label>
                  <div class="col-sm-9">
                  <textarea class="form-control" name="g_detail" id="g_detail" placeholder="Content" rows="5" data-rule="required" data-msg="Content"><?php echo $RecData[0]['g_detail']; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Link</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="g_link" value="<?php echo $RecData[0]['g_link']; ?>">
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
