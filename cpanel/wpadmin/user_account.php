<?php  
    include_once("../function/app_top.php");

    if(isset($_GET['action']) && $_GET['action'] === 'delete'){
      $sqli = "DELETE FROM `user_profile` WHERE `user_profile`.`Player` = ?";
      $values = array($_GET['user']);
      $model->doDelete($sqli, $values);

      header("Location:user_account.php");
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
  <!-- <link href="lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="lib/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="lib/advanced-datatable/css/DT_bootstrap.css" /> -->

  <link rel="stylesheet" href="css/jquery.dataTables.min.css" />
  
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
    <?php include_once("top_bar.php");?>
    <?php include_once("sidebar_menu.php");?>
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> User Account</h3>
        <!-- <div><a href="user_account_add.php"><button class="btn btn-primary">Add New User</button></a></div></div><br> -->
        <div class="row mb">

          <!-- page start-->
          <div class="content-panel" style="margin-left: 15px;margin-right: 15px;padding-left: 15px;padding-right: 15px;">
            <div class="adv-table">
              <table cellpadding="0" cellspacing="0" class="display responsive table table-bordered" id="hidden-table-info">
                <thead>
                  <tr>
                    <th>Player</th>
                    <th>EMail</th>
                    <th class="text-center">Telephone</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          <!-- page end-->
        </div>
        <!-- /row -->
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <?php include_once("footer_bar.php");?>
  </section>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Delete User Account</h4>
          </div>
          <div class="modal-body">
          Are you sure you want to delete this account (<span id="userPlayer"></span>)?
          </div>
          <div class="modal-footer text-center">
            <button type="button" class="btn btn-primary udelBt">Yes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!-- <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script> -->
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js"></script> -->
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>

<script src="js/jquery.dataTables.min.js"></script>

  <!--script for this page-->
  <script type="text/javascript">


    $(document).ready(function() {

      $( ".udelBt" ).click(function() {
        var player = $("#userPlayer").text();
        window.location.href = 'user_account.php?action=delete&user='+player;
      });
      
      var dataTable = $('#hidden-table-info').DataTable( {
					"processing": true,
					"serverSide": true,
          "aaSorting": [
            [0, 'desc']
          ],
          "iDisplayLength": 25,
					"ajax":{
						url :"user_account_ajax.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".hidden-table-info-error").html("");
							$("#hidden-table-info").append('<tbody class="hidden-table-info-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#hidden-table-info_processing").css("display","none");
						
						}
					},initComplete: function() {
              $('#hidden-table-info_filter input').unbind();
              $('#hidden-table-info_filter input').bind('keyup', function(e) {
                  if(e.keyCode == 13) {
                    dataTable.search(this.value).draw();
                  }
              });
          },
				} );


    });

    function deleteUser(user){
        $("#userPlayer").text(user);
        $("#myModal").modal('show');
      }
  </script>
</body>

</html>
