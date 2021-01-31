<?php

include_once "../function/app_top.php";

if (isset($_GET['action']) && $_GET['action'] === "submit") {

    if ($_POST['Password'] != "") {
        $sqlu = "update user_profile set Email=?, Telephone=?, permission=?, password=?, uactive=? where Player=?";
        $values = array($_POST['Email'], $_POST['Telephone'], 'admin', encode($_POST['Password'], KEY_HASH), $_POST['uactive'], $_POST['Player']);

    } else {
        $sqlu = "update user_profile set Email=?, Telephone=?, permission=?, uactive=? where Player=?";
        $values = array($_POST['Email'], $_POST['Telephone'], 'admin', $_POST['uactive'], $_POST['Player']);
    }

    $model->doUpdate($sqlu, $values);

    header("Location:user_account.php");

} 

$RecDataUserSQL = "SELECT * FROM user_profile WHERE Player = ?";
$valuesRecDataUserSQL = array($_GET['Player']);
$RecDataUser = $model->doSelect($RecDataUserSQL, $valuesRecDataUserSQL);


// echo "<pre>";
// print_r($RecDataUser[0]);
// echo "</pre>";

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
        <h3><i class="fa fa-angle-right"></i> User Account <i class="fa fa-angle-right"></i> (Edit -> <?php echo $_GET['Player']; ?>)</h3>
        <div class="row mt">
          <div class="col-lg-12">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" action="user_account_edit.php?action=submit">
                <div class="form-group">
                  <label class="col-lg-2 col-sm-2 control-label">Username</label>
                  <div class="col-lg-10">
                    <p class="form-control-static"><?php echo $RecDataUser[0]['Player']; ?></p>
                    <input type="hidden" name="Player" class="form-control" value="<?php echo $RecDataUser[0]['Player']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="text" name="Password" class="form-control" value="">
                    <input type="hidden" name="passOld" value="<?php echo $RecDataUser[0]['password']; ?>">
                    <br>Password not displayed. Leave blank to keep existing password.
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" name="Email" class="form-control" value="<?php echo $RecDataUser[0]['Email']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="text" name="Telephone" class="form-control" value="<?php echo $RecDataUser[0]['Telephone']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Active User</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="uactive" title="Status User">
                      <option value="0" <?php if ($RecDataUser[0]['uactive'] == '0') {echo 'selected=""';}?>>No</option>
                      <option value="1" <?php if ($RecDataUser[0]['uactive'] == '1') {echo 'selected=""';}?>>Yes</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 text-center">
                  <button class="btn btn-theme" type="submit">Save</button>
                  <button class="btn btn-theme04" type="button" onClick="window.location='user_account.php';">Cancel</button>
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
  <script src="lib/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="lib/jquery.ui.touch-punch.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->

</body>

</html>
