 <?php

echo
"<form action='' method='post'>
<input type='submit' name='use_button' value='something' />
</form>";

if(isset($_POST['use_button']))
{
    echo "hey";
}

?> 