<!DOCTYPE html>
<html lang="en">
<head>
<title>Proyecto de SOPES2</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="font/css/fontello.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
<script src="js/jquery-1.10.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/socket.io.js"></script>
<script src="js/publish.js"></script>
<script src="js/progressbar.js"></script>
<script type="text/javascript">var ident = 0;</script>
<script type="text/javascript">var nident = '';</script>
<style>
            .progress {
                height: 40%;
		width: 40%;
		background-color:#203748;
            }
            .progress > svg {
                height: 100%;
                display: block;
		background-color:#203748;
            }           
</style>
<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;
?>
</head>
<body>
<div class="navbar">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="index.html"><img src="img/user.jpg" alt=""></a>
      
      <ul class="nav nav-collapse pull-right">
        <li><a href="publish.php" class="active"><i class="icon-user"></i>Principal</a></li>
        <li><a href="lista.html"><i class="icon-doc-text"></i>Monitoreo</a></li>
	<li><a href="http://192.168.1.30/list.php"><i class="icon-picture"></i>Videos</a></li>
      </ul>
      <div class="nav-collapse collapse"></div>
    </div>
  </div>
</div>
<div class="container profile">
  <div class="span8" style="text-align:center;float:left"> 
    <div>
      <h1><i class="icon-picture"></i>Suba su video!</h1>
      <form enctype= "multipart/form-data" action="publish.php"  method='post' name="miform">
	<input name ="userfile" type="file" />
	<input type="submit" name='use_button' value='subir' />
      </form>
     </div>
  </div>
  <div style="text-align:center;clear:both">
    <div style="float:left;width:30%">&nbsp</div>
    <div class="progress" id="progress" style="text-align:center;float:left"></div>
  </div>
  <div style="float:left">&nbsp</div>
  <div id="result" style="clear:both">&nbsp</div>
</div>
<div class="footer" href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
  <div class="container">
    <p class="pull-left">Proyecto de SOPES2</p>
    <p class="pull-right">Vacaciones Junio 2015</p>
  </div>
</div>

<?php
if(isset($_POST['use_button']))
{
    $upload_dir = "/var/www/html/Web/videos/";
    $txa = str_replace(" ","_",$_FILES["userfile"]["name"]);
    move_uploaded_file( $_FILES["userfile"]["tmp_name"] , $upload_dir . $txa );

    $t = time();
    $connection = new AMQPConnection('192.168.1.16', 5672, 'guest', 'guest');
    $channel = $connection->channel();
    $channel->queue_declare('publish', false, true, false, false);
    $msg = new AMQPMessage($t . "~" . $txa);
    $channel->basic_publish($msg, '', 'publish');
    $channel->close();
    $connection->close();
    $txa = substr($txa,0,-4);
    echo "<script type='text/javascript'>ident = " . $t . ";</script>";
    echo "<script type='text/javascript'>nident = '" . $txa . "';</script>";
}
?>
</body>
</html>
