<?php

use Theory\Builder\Client;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/includes/functions.php";

$names = file(__DIR__ . "/data/names.txt");
$blocks = require __DIR__ . "/data/blocks.php";

$config = require __DIR__ . "/includes/config.php";

$builder = new Client(
    $config["rcon"]["ip"],
    (int) $config["rcon"]["port"],
    $config["rcon"]["password"]
);

$ox = $x = (int) $config["start"]["x"];
$oy = $y = (int) $config["start"]["y"];
$oz = $z = (int) $config["start"]["z"];

$builder->exec(teleportToOriginCommand($ox, $oy, $oz));

$builder->exec(sprintf('setblock %s %s %s air', $x - 5, $y, $z - 1));
$builder->exec(sprintf('setblock %s %s %s air', $x - 5, $y, $z));
$builder->exec(sprintf('setblock %s %s %s air', $x - 5, $y, $z + 1));
$builder->exec(sprintf('setblock %s %s %s air', $x - 5, $y, $z + 2));

$sx = 0;
$sy = 0;
$sz = 0;

$blocks = require __DIR__ . "/data/blocks.php";

foreach ($blocks as $block) {
    $sx = max($sx, abs($block[0]));
    $sy = max($sy, abs($block[1]));
    $sz = max($sz, abs($block[2]));
}

// $entities = require __DIR__ . "/data/entities.php";
//
// foreach ($entities as $entity) {
//     $sx = max($sx, abs($entity[0]));
//     $sy = max($sy, abs($entity[1]));
//     $sz = max($sz, abs($entity[2]));
// }

$shuffled = array_values(iterator_to_array(array_shuffle($names)));

$builder->exec(teleportToOriginCommand($ox, $oy, $oz));

foreach ($shuffled as $i => $name) {
    $name = trim($name);

    $entities = require __DIR__ . "/data/entities.php";

    printLine($i . ": " . "Building circuit for {$name}...");
    $builder->exec("say Building circuit for {$name}...");

    $cx = $x - $sx;
    $cy = $y + $sy;
    $cz = $z + $sz;

    if ($i < (int) $config["build"]) {
        foreach ($blocks as $block) {
            $dx = $x + $block[0];
            $dy = $y + $block[1];
            $dz = $z + $block[2];

            $type = $block[3];

            if (isset($block[4])) {
                $type .= " {$block[4]}";
            }

            if (isset($block[5])) {
                $type .= " replace {$block[5]}";
            }

            $command = "setblock {$dx} {$dy} {$dz} {$type}";

            $builder->exec($command);
            delay();
        }
    } else {
        $cloneStartX = $x;
        $cloneStartY = $y;
        $cloneStartZ = $z - $sz - 1;
        $cloneEndX = $x - $sx;
        $cloneEndY = $y + $sy;
        $cloneEndZ = $z - 1;
        $clonePlaceX = $cloneEndX;
        $clonePlaceY = $y;
        $clonePlaceZ = $cloneEndZ + 1;

        $command = "clone {$cloneStartX} {$cloneStartY} {$cloneStartZ} {$cloneEndX} {$cloneEndY} {$cloneEndZ} {$clonePlaceX} {$clonePlaceY} {$clonePlaceZ} masked force";

        $builder->exec($command);
    }

    foreach ($entities as $entity) {
        $type = $entity[3];

        $dx = $x + $entity[0];
        $dy = $y + $entity[1];
        $dz = $z + $entity[2];

        $additional = "";

        if (isset($entity[4])) {
            $additional = $entity[4];
        }

        $command = "summon {$type} {$dx} {$dy} {$dz} {$additional}";

        $builder->exec($command);
    }

    $blockData = require __DIR__ . "/data/blocks-data.php";

    foreach ($blockData as $datum) {
        $dx = $x + $datum[0];
        $dy = $y + $datum[1];
        $dz = $z + $datum[2];

        $builder->exec("blockdata {$dx} {$dy} {$dz} {$datum[3]}");
    }

    $entityData = require __DIR__ . "/data/entities-data.php";

    foreach ($entityData as $datum) {
        $dx = $x + $datum[0];
        $dy = $y + $datum[1];
        $dz = $z + $datum[2];

        delay();
        $builder->exec("entitydata @e[x={$dx},y={$dy},z={$dz},r=1] {$datum[3]}");
        delay();
    }

    $z += $sz + 1;

    if ($i + 1 < count($shuffled)) {
        $builder->exec(teleportToCurrentCommand($x, $y, $z));
    }

    if ($i >= (int) $config["limit"] - 1) {
        break;
    }

    delay();
}

$builder->exec(teleportToOriginCommand($ox, $oy, $oz));

$builder->exec(sprintf('setblock %s %s %s command_block 3 replace {Command: "%s"}', $x - 5, $y, $z, teleportToOriginCommand($ox, $oy, $oz)));
$builder->exec(sprintf('setblock %s %s %s chain_command_block 3 replace {Command: "setblock %s %s %s redstone_block", auto: 1b}', $x - 5, $y, $z + 1, $ox - 5, $oy, $oz - 1));
$builder->exec(sprintf('setblock %s %s %s command_block 3 replace {Command: "setblock ~-1 ~ ~ air"}', $ox - 4, $oy, $oz - 1));
