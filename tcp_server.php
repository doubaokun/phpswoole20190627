<?php

$server = new swoole_server("0.0.0.0", 9501);

$server->on("start", function ($server) {
    echo "Swoole TCP server is started at tcp://0.0.0.0:9501\n";
});

$server->on('connect', function ($server, $fd){
    echo "connection open: {$fd}\n";
});

$server->on('receive', function ($server, $fd, $from_id, $data) {
    $server->send($fd, "Swoole: {$data}\n");
    $server->close($fd);
});

$server->on('close', function ($server, $fd) {
    echo "connection close: {$fd}\n";
});

$server->start();
