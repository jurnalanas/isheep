<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_sispak = "localhost";
$database_sispak = "sispakv2";
$username_sispak = "root";
$password_sispak = "";
$sispak = mysql_pconnect($hostname_sispak, $username_sispak, $password_sispak) or trigger_error(mysql_error(),E_USER_ERROR); 
?>