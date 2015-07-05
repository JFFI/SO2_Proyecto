<!DOCTYPE html>
<html lang="en">
<head>
<title>Proyecto de SOPES1</title>
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
<style>
            .progress {
                height: 300px;
            }
            .progress > svg {
                height: 100%;
                display: block;
            }           
</style>
</head>
<body>
<div class="navbar">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="index.html"><img src="img/user.jpg" alt=""></a>
      
      <ul class="nav nav-collapse pull-right">
        <li><a href="index.html" class="active"><i class="icon-user"></i> Principal</a></li>
        <li><a href="skills.html"><i class="icon-doc-text"></i> Logs</a></li>
      </ul>
      <div class="nav-collapse collapse"></div>
    </div>
  </div>
</div>
<div class="container profile">
  <div class="span5"> 
    <div>
      <h1><i class="icon-picture"></i>Suba su video!</h1>
      <form action='' method='post'>
	<input type='submit' name='use_button' value='something' />
      </form>
      
      <div class="progress" id="progress"></div>

        <script src="js/progressbar.js"></script>

        <script src="porcentaje.js"></script>
    </div>
  </div>
</div>
<div class="footer" href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
  <div class="container">
    <p class="pull-left">Proyecto de SOPES2</p>
    <p class="pull-right">Vacaciones Junio 2015</p>
  </div>
</div>

<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;
if(isset($_POST['use_button']))
{
    echo "hey";
    $connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
    $channel = $connection->channel();
    $channel->queue_declare('renderizar', false, false, false, false);
    $msg = new AMQPMessage('Hello World!');
    $channel->basic_publish($msg, '', 'renderizar');
    echo " [x] Sent 'Hello World!'\n";
    $channel->close();
    $connection->close();
}
?>