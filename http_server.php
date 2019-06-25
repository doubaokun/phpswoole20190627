<?php

$http = new swoole_http_server("0.0.0.0", 9501);

$http->on("start", function ($server) {
	swoole_set_process_name("swoole server");
    echo "Swoole http server is started at http://0.0.0.0:9501\n";
});

$http->on("managerStart", function ($server) {
    swoole_set_process_name("swoole manager");
});

$http->on("workerStart", function ($server, $worker_id) {
    swoole_set_process_name("swoole worker: {$worker_id}\n");
});

$http->on("request", function ($request, $response) {
    $response->header("Content-Type", "text/plain");
    $response->end("Hello World\n");
});

$http->start();
