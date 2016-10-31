<?php
$sent = split(PHP_EOL, file_get_contents('sent.txt'));
$content = file_get_contents('http://resultmaps.neis-one.org/newestosm?c=Iran#5/32.510/52.844');
$list = [];
$needle = 'https://www.openstreetmap.org/user/';
$x = 0;
while (true) {
    $x = strpos($content, $needle, $x);
    if ($x === false) {
        break;
    }
    $x += strlen($needle);
    $user = '';
    while (true) {
        $ch = $content[$x++];
        if ($ch == '"') {
            break;
        }
        $user .= $ch;
    }
    if (($user != '') && (!in_array($user, $sent))) {
        $list[] = $user;
        $sent[] = $user;
    }
}
foreach ($list as $item) {
    echo '<iframe src="load.php?username=' . $item  . '"></iframe>';
}

foreach ($sent as $key => $item) {
    $sent[$key] .= PHP_EOL;
}
$x = count($sent)-1;
$sent[$x] = str_replace(PHP_EOL, '', $sent[$x]);
file_put_contents('sent.txt', $sent);
