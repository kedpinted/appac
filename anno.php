<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Appac | Annotation</title>

    <script src="js/jquery.js"></script>  
    <script src="build/mediaelement-and-player.min.js"></script>  
    <link rel="stylesheet" href="build/mediaelementplayer.min.css" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <script type="text/javascript" src="js/canvas.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

  </head>
  <body class="hold-transition skin-yellow slidebar-mini" onload="init()">

      <header class="main-header">

        <a href="#" class="logo">
          <span class="logo-lg"><b>A</b>ppac</span>
          <span class="logo-mini"><b>A</b></span>
        </a>

        <nav class="navbar" role="navigation">
          <div class="pull-right">
           <ul class="nav navbar-nav">
              <li>
                    <a href="index.php"><i class="fa fa-sign-out"></i> Log out </a>
              </li>
            </ul>
          </div>
        </nav>
      </header>

        <!-- Content Header (Page header) -->
        <section class="content-header" style="padding-left:43px; padding-top:50px">

       
            <?php
            @session_start();
            include("connectdb.php");

            $sql = "SELECT * FROM add_vdo ORDER BY id ASC LIMIT 0,6";
                    
            $result = mysql_db_query("test-2015",$sql);
            while($rs=mysql_fetch_array($result)) {
              $idvdo = $rs["vdo_id"];
              echo '<video width="760" height="480" id="player'.$rs['id'].'">';
              echo "<source type='video/youtube'  src='https://www.youtube.com/embed/$idvdo'/>"; 
              
              echo "</video>";
            }
              mysql_close();
            ?>
          
          <span id="player1-mode"></span>
          <script>

          $('video').mediaelementplayer({
            success: function(media, node, player) {
              $('#' + node.id + '-mode').html
            }
          });

          </script>


        </section><!-- /.content -->

          <canvas id="can" width="760" height="450" style="position:absolute;top:100px;left:41px;border:2px solid"></canvas>
          <input type="button" value="save" id="btn" size="30" onclick="save()" style="position:absolute;top:105px;left:51%;">
          <input type="button" value="clear" id="clr" size="30" onclick="erase()" style="position:absolute;top:105px;left:55%;"><br>

        <form role = "form" method="post" action="add_comment.php">
          <div class = "form-group" style="margin-left:45px">
              <textarea rows = "3" name="anno_content"></textarea><br>
              <button type="submit" class="btn btn-default">Submit</button>
          </div>
          
        </form>

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
  </body>
</html>
