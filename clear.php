<?php

use Theory\Builder\Client;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/includes/functions.php";

$names = file(__DIR__ . "/data/names.txt");
$blocks = require __DIR__ . "/data/blocks.php";

$config = require __DIR__ . "/includes/config.php";

$ox = $x = (int) $config["start"]["x"];
$oy = $y = (int) $config["start"]["y"];
$oz = $z = (int) $config["start"]["z"];

$builder = new Client(
    $config["rcon"]["ip"],
    (int) $config["rcon"]["port"],
    $config["rcon"]["password"]
);

$builder->exec(teleportToOriginCommand($ox, $oy, $oz));

$sx = 0;
$sy = 0;
$sz = 0;

foreach ($blocks as $block) {
    $sx = max($sx, abs($block[0]));
    $sy = max($sy, abs($block[1]));
    $sz = max($sz, abs($block[2]));
}

$shuffled = array_values(iterator_to_array(array_shuffle($names)));

$clearStartX = $x;
$clearStartY = $y;
$clearStartZ = $z;

for ($i = 0; $i <= count($shuffled); $i++) {
    $clearEndX = $clearStartX - $sx;
    $clearEndY = $clearStartY + $sy;
    $clearEndZ = $clearStartZ + $sz;

    $builder->exec(teleportToCurrentCommand($clearStartX, $clearStartY, $clearStartZ));

    $builder->exec(
        sprintf("fill %s %s %s %s %s %s air", $clearStartX, $clearStartY, $clearStartZ, $clearEndX, $clearEndY, $clearEndZ)
    );

    $builder->exec(
        sprintf('setblock %s %s %s command_block 0 replace {auto:1b, Command:"%s"}', $clearStartX, $clearStartY, $clearStartZ, "kill @e[type=Item]")
    );

    $builder->exec(
        sprintf('setblock %s %s %s command_block 0 replace {auto:1b, Command:"%s"}', $clearStartX, $clearStartY, $clearStartZ + 1, "kill @e[type=ArmorStand]")
    );

    $builder->exec(
        sprintf('fill %s %s %s %s %s %s air', $clearStartX, $clearStartY, $clearStartZ, $clearStartX, $clearStartY, $clearStartZ + 1)
    );

    printLine(sprintf('%s: Clearing...', $i));

    $clearStartZ += $sz + 1;

    if ($i >= (int) $config["limit"] - 1) {
        break;
    }
}

$builder->exec(teleportToOriginCommand($ox, $oy, $oz));
