<?php

use Swoole\Timer;

Timer::tick(1000, function () {
    echo "Do something...\n";
});
