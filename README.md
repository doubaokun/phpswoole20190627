# phpswoole20190627

```bash
docker build -f Dockerfile -t swoole-php .
```

# Timer

```bash
docker run --rm -p 9501:9501 -v $(pwd):/app -w /app swoole-php timer.php
```

# Coroutine

```bash
docker run --rm -p 9501:9501 -v $(pwd):/app -w /app swoole-php coroutine.php
```

# Coroutine HTTP client

```bash
docker run --rm -p 9501:9501 -v $(pwd):/app -w /app swoole-php coroutine_http_client.php
```

# TCP server

```bash
docker run --rm -p 9501:9501 -v $(pwd):/app -w /app swoole-php tcp_server.php
```

```bash
(echo 123; sleep 1) | nc localhost 9501
```

# HTTP server

```bash
docker run --rm -p 9501:9501 -v $(pwd):/app -w /app swoole-php http_server.php
```

# Websocket server

```bash
docker run --rm -p 9501:9501 -v $(pwd):/app -w /app swoole-php websocket_server.php
```
