<?php
$username = $_GET['username'];
$content = file_get_contents('compose.html');
$content = str_replace('user_name', $username, $content);
echo $content;
