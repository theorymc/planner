<?php

return [
    [-7, 0, 6,
        sprintf('{Command: "say winner is %s!"}', $name)
    ],
    // [-7, 0, 7, sprintf('{Command: "fill %s %s %s %s %s %s air"}', $x, $y, $z, $cx + 5, $cy, $cz)],
    // [-7, 0, 8, sprintf('{Command: "setblock %s %s %s unpowered_repeater 3"}', $x - 6, $y, $z + 1)],
    // [-7, 0, 9, sprintf('{Command: "kill @e[type=Item]"}')],
    // [-7, 0, 12, sprintf('{Command: "fill %s %s %s %s %s %s redstone_wire"}', $cx + 6, $y, $z, $cx + 6, $y, $cz)],
    // [-8, 0, 12, sprintf('{Command: "fill %s %s %s %s %s %s unpowered_repeater 14"}', $cx + 6, $y, $z + 5, $cx + 6, $y, $z + 6)],
    [-11, 0, 12,
        sprintf('{Command: "%s"}', teleportToOriginCommand($ox, $oy, $oz))
    ],
    // [-1, 0, 13, sprintf('{Command: "blockdata %s %s %s {Items:[{id:minecraft:record_11,Count:1,Slot:0b},{id:minecraft:dirt,Count:1,Slot:1b},{id:minecraft:dirt,Count:1,Slot:2b},{id:minecraft:dirt,Count:1,Slot:3b},{id:minecraft:dirt,Count:1,Slot:4b},{id:minecraft:dirt,Count:1,Slot:5b},{id:minecraft:dirt,Count:1,Slot:6b},{id:minecraft:dirt,Count:1,Slot:7b},{id:minecraft:dirt,Count:1,Slot:8b}]}"}', $x - 5, $y, $z + 3)],
    // [-1, 0, 14, sprintf('{Command: "blockdata %s %s %s {Items:[{id:minecraft:air,Count:1,Slot:0b},{id:minecraft:air,Count:1,Slot:1b},{id:minecraft:air,Count:1,Slot:2b},{id:minecraft:air,Count:1,Slot:3b},{id:minecraft:air,Count:1,Slot:4b}]}"}', $x - 5, $y, $z + 4)],
    [-7, 0, 1,
        sprintf('{Command: "%s"}', teleportToCurrentCommand($x, $y, $z))
    ],
];
