
<html>
  <head>
    <title>Hola mundo</title>
  </head>
  <body>
    <form action='' method='post'>
    <input type='submit' name='use_button' value='something' />
    </form>
  </body>
</html>

 <?php
if(isset($_POST['use_button']))
{
    echo "hey";
}

?> 