<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_db_conn = "localhost";
$database_db_conn = "postgrad";
$username_db_conn = "root";
$password_db_conn = "";
$db_conn = mysql_pconnect($hostname_db_conn, $username_db_conn, $password_db_conn) or trigger_error(mysql_error(),E_USER_ERROR); 
?>