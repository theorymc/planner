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

function encode(array $data) {
    $replacements = [
        '"Items"' => "Items",
        '"Command"' => "Command",
        '"id"' => "id",
        '"Count"' => "Count",
        '"Slot"' => "Slot",
        '"CustomName"' => "CustomName",
        '"0b"' => "0b",
        '"1b"' => "1b",
        '"2b"' => "2b",
        '"3b"' => "3b",
        '"4b"' => "4b",
        '"5b"' => "5b",
        '"6b"' => "6b",
        '"7b"' => "7b",
        '"8b"' => "8b",
    ];

    $encoded = json_encode($data);

    foreach ($replacements as $key => $value) {
        $encoded = str_replace($key, $value, $encoded);
    }

    return $encoded;
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

$config = require __DIR__ . "/config.php";

$ox = $x = (int) $config["start"]["x"];
$oy = $y = (int) $config["start"]["y"];
$oz = $z = (int) $config["start"]["z"];

function teleportToOriginCommand($ox, $oy, $oz) {
    return sprintf("tp @a %s %s %s", $ox - 5, $oy + 3, $oz - 2);
}

function teleportToCurrentCommand($x, $y, $z) {
    return sprintf("tp @a %s %s %s", $x - 5, $y + 3, $z - 2);
}

$builder = new Client(
    $config["rcon"]["ip"],
    (int) $config["rcon"]["port"],
    $config["rcon"]["password"]
);

$builder->exec(teleportToOriginCommand($ox, $oy, $oz));

$builder->exec(sprintf('setblock %s %s %s air', $x - 5, $y, $z - 1));
$builder->exec(sprintf('setblock %s %s %s air', $x - 5, $y, $z));
$builder->exec(sprintf('setblock %s %s %s air', $x - 5, $y, $z + 1));
$builder->exec(sprintf('setblock %s %s %s air', $x - 5, $y, $z + 2));

$blocks = [
    [-5, 0, 0, "redstone_wire"],
    [-5, 0, 1, "redstone_wire"],
    [-6, 0, 1, "unpowered_repeater", 3],
    [-7, 0, 1, "command_block"],
    [-5, 0, 2, "redstone_wire"],
    [-5, 0, 3, "dropper", 3, encode([
        "Items" => [
            ["id" => "minecraft:record_11", "Count" => 1, "Slot" => "0b"],
            ["id" => "minecraft:dirt", "Count" => 1, "Slot" => "1b"],
            ["id" => "minecraft:dirt", "Count" => 1, "Slot" => "2b"],
            ["id" => "minecraft:dirt", "Count" => 1, "Slot" => "3b"],
            ["id" => "minecraft:dirt", "Count" => 1, "Slot" => "4b"],
            ["id" => "minecraft:dirt", "Count" => 1, "Slot" => "5b"],
            ["id" => "minecraft:dirt", "Count" => 1, "Slot" => "6b"],
            ["id" => "minecraft:dirt", "Count" => 1, "Slot" => "7b"],
            ["id" => "minecraft:dirt", "Count" => 1, "Slot" => "8b"],
        ]
    ])],
    [-5, 0, 4, "hopper", 0, encode([
        "Items" => [
            ["id" => "minecraft:air", "Count" => 1, "Slot" => "0b"],
            ["id" => "minecraft:air", "Count" => 1, "Slot" => "1b"],
            ["id" => "minecraft:air", "Count" => 1, "Slot" => "2b"],
            ["id" => "minecraft:air", "Count" => 1, "Slot" => "3b"],
            ["id" => "minecraft:air", "Count" => 1, "Slot" => "4b"],
        ]
    ])],
    [-4, 0, 4, "unpowered_comparator", 1],
    [-3, 0, 4, "unpowered_repeater", 1],
    [-2, 0, 4, "redstone_wire"],
    [-1, 0, 4, "redstone_wire"],
    [-0, 0, 4, "redstone_wire"],
    [0, 0, 5, "redstone_wire"],
    [0, 0, 6, "redstone_wire"],
    [0, 0, 7, "redstone_wire"],
    [0, 0, 8, "unpowered_repeater", 14],
    [0, 0, 9, "redstone_wire"],
    [-1, 0, 9, "redstone_wire"],
    [-2, 0, 9, "redstone_wire"],
    [-3, 0, 9, "redstone_wire"],
    [-3, 0, 9, "redstone_wire"],
    [-3, 0, 10, "redstone_wire"],
    [-3, 0, 11, "wool", 15],
    [-4, 0, 11, "wool", 15],
    [-5, 0, 11, "wool", 15],
    [-3, 1, 11, "redstone_torch"],
    [-4, 1, 11, "redstone_wire", 15],
    [-5, 1, 11, "redstone_torch"],
    [-4, 0, 12, "redstone_torch", 3],
    [-4, 0, 13, "redstone_wire"],
    [-3, 0, 13, "redstone_wire"],
    [-3, 0, 14, "redstone_wire"],
    [-3, 0, 15, "redstone_wire"],
    [-5, 0, 13, "redstone_wire"],
    [-5, 0, 14, "redstone_wire"],
    [-5, 0, 15, "redstone_wire"],
    [-2, 0, 13, "unpowered_repeater", 1],
    [-1, 0, 13, "command_block"],
    [-2, 0, 14, "unpowered_repeater", 1],
    [-1, 0, 14, "command_block"],
    [-5, 0, 5, "unpowered_comparator", 2],
    [-5, 0, 6, "redstone_wire"],
    [-6, 0, 6, "redstone_wire"],
    [-7, 0, 6, "command_block", 3],
    [-7, 0, 7, "chain_command_block", 3],
    [-7, 0, 8, "chain_command_block", 3],
    [-7, 0, 9, "unpowered_comparator", 2],
    [-7, 0, 10, "unpowered_repeater", 14],
    [-7, 0, 11, "unpowered_repeater", 14],
    [-7, 0, 12, "command_block", 4],
    [-8, 0, 12, "chain_command_block", 4],
    [-9, 0, 12, "unpowered_comparator", 3],
    [-10, 0, 12, "unpowered_repeater", 15],
    [-11, 0, 12, "unpowered_repeater", 15],
    [-12, 0, 12, "command_block", 2],
    [-4, 0, 6, "redstone_wire"],
    [-3, 0, 6, "unpowered_repeater", 1],
    [-2, 0, 6, "redstone_wire"],
    [-2, 0, 7, "redstone_wire"],
    [-3, 0, 7, "redstone_wire"],
    [-4, 0, 7, "unpowered_repeater", 3],
    [-5, 0, 7, "unpowered_comparator", 2],
    [-5, 0, 8, "unpowered_repeater", 2],
    [-5, 0, 9, "redstone_wire"],
    [-5, 0, 10, "redstone_wire"],
];

$sx = 0;
$sy = 0;
$sz = 0;

foreach ($blocks as $block) {
    $sx = max($sx, abs($block[0]));
    $sy = max($sy, abs($block[1]));
    $sz = max($sz, abs($block[2]));
}

printLine("sx: {$sx}, sy: {$sy}, sz: {$sz}");

$shuffled = array_values(iterator_to_array(array_shuffle($names)));

$clearStartX = $x;
$clearStartY = $y;
$clearStartZ = $z;

// for ($i = 0; $i <= 20; $i++) {
for ($i = 0; $i <= count($shuffled); $i++) {
    $clearEndX = $clearStartX - $sx;
    $clearEndY = $clearStartY + $sy;
    $clearEndZ = $clearStartZ + $sz;

    printLine($builder->exec("fill {$clearStartX} {$clearStartY} {$clearStartZ} {$clearEndX} {$clearEndY} {$clearEndZ} air"));

    $builder->exec(teleportToCurrentCommand($clearStartX, $clearStartY, $clearStartZ));

    $clearStartZ += $sz + 1;
}

printLine($builder->exec("kill @e[type=Item]"));
$builder->exec(teleportToOriginCommand($ox, $oy, $oz));

foreach ($shuffled as $i => $name) {
    $name = trim($name);

    printLine("Building circuit for {$name}...");
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

            $builder->exec("setblock {$dx} {$dy} {$dz} {$type}");
            usleep(10000);
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

    $data = [
        [-7, 0, 6, sprintf('{Command: "say winner is %s!"}', $name)],
        [-7, 0, 7, sprintf('{Command: "fill %s %s %s %s %s %s air"}', $x, $y, $z, $cx + 6, $cy, $cz)],
        [-7, 0, 8, sprintf('{Command: "kill @e[type=Item]"}')],
        [-7, 0, 12, sprintf('{Command: "fill %s %s %s %s %s %s redstone_wire"}', $cx + 7, $y, $z, $cx + 7, $y, $cz)],
        [-8, 0, 12, sprintf('{Command: "setblock %s %s %s unpowered_repeater 2"}', $cx + 7, $y, $z + 5)],
        [-12, 0, 12, sprintf('{Command: "%s"}', teleportToOriginCommand($ox, $oy, $oz))],
        [-1, 0, 13, sprintf('{Command: "blockdata %s %s %s {Items:[{id:minecraft:record_11,Count:1,Slot:0b},{id:minecraft:dirt,Count:1,Slot:1b},{id:minecraft:dirt,Count:1,Slot:2b},{id:minecraft:dirt,Count:1,Slot:3b},{id:minecraft:dirt,Count:1,Slot:4b},{id:minecraft:dirt,Count:1,Slot:5b},{id:minecraft:dirt,Count:1,Slot:6b},{id:minecraft:dirt,Count:1,Slot:7b},{id:minecraft:dirt,Count:1,Slot:8b}]}"}', $x - 5, $y, $z + 3)],
        [-1, 0, 14, sprintf('{Command: "blockdata %s %s %s {Items:[{id:minecraft:air,Count:1,Slot:0b},{id:minecraft:air,Count:1,Slot:1b},{id:minecraft:air,Count:1,Slot:2b},{id:minecraft:air,Count:1,Slot:3b},{id:minecraft:air,Count:1,Slot:4b}]}"}', $x - 5, $y, $z + 4)],
        [-7, 0, 1, sprintf('{Command: "%s"}', teleportToCurrentCommand($x, $y, $z))],
    ];

    foreach ($data as $datum) {
        $dx = $x + $datum[0];
        $dy = $y + $datum[1];
        $dz = $z + $datum[2];

        $builder->exec("blockdata {$dx} {$dy} {$dz} {$datum[3]}");
        usleep(10000);
    }

    $z += $sz + 1;

    if ($i + 1 < count($shuffled)) {
        $builder->exec(teleportToCurrentCommand($x, $y, $z));
    }
}

$builder->exec(teleportToOriginCommand($ox, $oy, $oz));

$builder->exec(sprintf('setblock %s %s %s command_block 3', $x - 5, $y, $z));
$builder->exec(sprintf('setblock %s %s %s chain_command_block 3', $x - 5, $y, $z + 1));
$builder->exec(sprintf('blockdata %s %s %s {Command: "%s"}', $x - 5, $y, $z, teleportToCurrentCommand($ox, $oy, $oz)));
$builder->exec(sprintf('blockdata %s %s %s {Command: "setblock %s %s %s redstone_block"}', $x - 5, $y, $z + 1, $ox - 5, $oy, $oz - 1));

$builder->exec(sprintf('setblock %s %s %s command_block', $ox - 4, $oy, $oz - 1));
$builder->exec(sprintf('blockdata %s %s %s {Command: "setblock %s %s %s air"}', $ox - 4, $oy, $oz - 1, $ox - 5, $oy, $oz - 1));
