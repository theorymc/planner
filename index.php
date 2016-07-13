<?php

use Theory\Builder\Client;

require __DIR__ . "/vendor/autoload.php";

function printLine($message) {
    print trim($message) . "\n";
    flush();
}

function array_shuffle($items) {
    while ($count = count($items)) {
        $offset = random_int(0, $count - 1);
        yield array_splice($items, $offset, 1)[0];
    }
}

$names = file(__DIR__ . "/names.txt");

// printLine("Original list of names:");
//
// foreach ($names as $name) {
//     printLine("- {$name}");
//     usleep(100000);
// }
//
// printLine("Shuffled list of names:");
//
// $shuffledNames = array_shuffle($names);
//
// foreach ($shuffledNames as $name) {
//     printLine("- {$name}");
//     usleep(100000);
// }

$ox = $x = -600;
$oy = $y = 4;
$oz = $z = -200;

$builder = new Client("127.0.0.1", 25575, "hello");


printLine("Clearing workspace...");

$x1 = $x - (10 + count($names));
$x2 = $x + 10;
$z1 = $z - 10;
$z2 = $z + (10 + (count($names) * 13));

printLine("x1: {$x1}");
printLine("x2: {$x2}");
printLine("z1: {$z1}");
printLine("z2: {$z2}");

printLine($builder->exec("fill {$x1} {$y} {$z1} {$x2} {$y} {$z2} air"));
sleep(1);
printLine($builder->exec("kill @e[type=Item]"));

$blocks = [
    [-5, 0, 2, "dropper", 3],
    [-5, 0, 3, "hopper"],
    [-4, 0, 3, "unpowered_comparator", 1],
    [-3, 0, 3, "unpowered_repeater", 1],
    [-2, 0, 3, "redstone_wire"],
    [-1, 0, 3, "redstone_wire"],
    [-0, 0, 3, "redstone_wire"],
    [0, 0, 4, "redstone_wire"],
    [0, 0, 5, "redstone_wire"],
    [0, 0, 6, "redstone_wire"],
    [0, 0, 7, "redstone_wire"],
    [0, 0, 8, "redstone_wire"],
    [-1, 0, 8, "redstone_wire"],
    [-2, 0, 8, "redstone_wire"],
    [-3, 0, 8, "redstone_wire"],
    [-3, 0, 9, "redstone_wire"],
    [-3, 0, 10, "wool", 15],
    [-4, 0, 10, "wool", 15],
    [-5, 0, 10, "wool", 15],
    [-3, 1, 10, "redstone_torch"],
    [-4, 1, 10, "redstone_wire", 15],
    [-5, 1, 10, "redstone_torch"],
    [-4, 0, 11, "redstone_torch", 3],
    [-4, 0, 12, "redstone_wire"],
    [-5, 0, 4, "unpowered_comparator", 2],
    [-5, 0, 5, "redstone_wire"],
    [-6, 0, 5, "redstone_wire"],
    [-7, 0, 5, "command_block"],
    [-4, 0, 5, "redstone_wire"],
    [-3, 0, 5, "unpowered_repeater", 1],
    [-2, 0, 5, "redstone_wire"],
    [-2, 0, 6, "redstone_wire"],
    [-3, 0, 6, "redstone_wire"],
    [-4, 0, 6, "unpowered_repeater", 3],
    [-5, 0, 6, "unpowered_comparator", 2],
    [-5, 0, 7, "unpowered_repeater", 2],
    [-5, 0, 8, "redstone_wire"],
    [-5, 0, 9, "redstone_wire"],
];

foreach (array_shuffle($names) as $name) {
    $mz = $z;

    $name = trim($name);

    printLine("Building template for {$name}...");

    foreach ($blocks as $block) {
        $dx = $x + $block[0];
        $dy = $y + $block[1];
        $dz = $z + $block[2];

        $mz = max($mz, $dz);

        $type = $block[3];

        if (isset($block[4])) {
            $type .= " " . $block[4];
        }

        // printLine($builder->exec("setblock {$dx} {$dy} {$dz} {$type}"));
        $builder->exec("setblock {$dx} {$dy} {$dz} {$type}");
        usleep(100000);
    }

    $data = [
        [-5, 0, 2, '{Items:[{id:"minecraft:record_11",Count:1,Slot:0b},{id:"minecraft:dirt",Count:1,Slot:1b},{id:"minecraft:dirt",Count:1,Slot:2b},{id:"minecraft:dirt",Count:1,Slot:3b},{id:"minecraft:dirt",Count:1,Slot:4b},{id:"minecraft:dirt",Count:1,Slot:5b},{id:"minecraft:dirt",Count:1,Slot:6b},{id:"minecraft:dirt",Count:1,Slot:7b},{id:"minecraft:dirt",Count:1,Slot:8b}]}'],
        [-7, 0, 5, '{Command:"w assertchris \'The winner is ' . $name . '!\'"}'],
    ];

    printLine("Setting block data for {$name}...");

    foreach ($data as $datum) {
        $dx = $x + $datum[0];
        $dy = $y + $datum[1];
        $dz = $z + $datum[2];

        // printLine($builder->exec("blockdata {$dx} {$dy} {$dz} {$datum[3]}"));
        $builder->exec("blockdata {$dx} {$dy} {$dz} {$datum[3]}");
        usleep(100000);
    }

    $x += 1;
    $z = $mz - 1;
}

$dx = $ox - 5;
$dz = $oz + 1;

printLine("Starting...");

// printLine($builder->exec("setblock {$dx} {$oy} {$dz} redstone_block"));
$builder->exec("setblock {$dx} {$oy} {$dz} redstone_block");
