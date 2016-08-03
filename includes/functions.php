<?php

if (!function_exists("printLine")) {
    function printLine($message) {
        print trim($message) . "\n";
        flush();
    }
}

if (!function_exists("array_shuffle")) {
    function array_shuffle($items) {
        while ($count = count($items)) {
            $offset = random_int(0, $count - 1);
            yield array_splice($items, $offset, 1)[0];
        }
    }
}

if (!function_exists("teleportToOriginCommand")) {
    function teleportToOriginCommand($ox, $oy, $oz) {
        return sprintf("tp @a %s %s %s", $ox - 5, $oy + 3, $oz - 2);
    }
}

if (!function_exists("teleportToCurrentCommand")) {
    function teleportToCurrentCommand($x, $y, $z) {
        return sprintf("tp @a %s %s %s", $x - 5, $y + 3, $z - 2);
    }
}

if (!function_exists("delay")) {
    function delay($microseconds = 100000) {
        usleep($microseconds);
    }
}
