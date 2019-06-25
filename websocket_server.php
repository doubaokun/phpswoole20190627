<?php

$server = new swoole_websocket_server("0.0.0.0", 9501);

$server->on("start", function ($server) {
    echo "Swoole websocket server is started at ws://0.0.0.0:9501\n";
    echo "Swoole HTTP server is started at http://0.0.0.0:9501\n";
});

$server->on('open', function($server, $req) {
    echo "conn open: {$req->fd}\n";
    $fd = $req->fd;
    $server->tick(2000, function($id) use ($fd, $server) {
        $now = "conn $fd - ". date('Y-m-d H:m:s', time()). "\r\n";
        $ret = $server->push($fd, $now);
        if (!$ret) {
            var_dump($id);
            var_dump($server->clearTimer($id));
        }
    });

});

$server->on('message', function($server, $frame) {
    echo "received message: {$frame->data}\n";
    $server->push($frame->fd, json_encode(["hello", "world"]));
});

$server->on('request', function (swoole_http_request $request, swoole_http_response $response) {

$html = <<<HTML
    <b>WebSocket Server</b>
    <pre id="box"></pre>
    <script>
	var wsServer = 'ws://127.0.0.1:9501';
	var websocket = new WebSocket(wsServer);
	websocket.onopen = function (evt) {
		console.log("Connected to WebSocket server.");
	};
	websocket.onclose = function (evt) {
		console.log("Disconnected");
	};
	websocket.onmessage = function (evt) {
		document.getElementById('box').innerHTML += evt.data;
		console.log('Retrieved data from server: ' + evt.data);
	};
	websocket.onerror = function (evt, e) {
		console.log('Error occured: ' + evt.data);
	};
	</script>
HTML;

    $response->end($html);
});

$server->on('close', function($server, $fd) {
    echo "connection close: {$fd}\n";
});

$server->start();
