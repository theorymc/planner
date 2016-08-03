<?php

return [
    [-5, 0, 0, "redstone_wire"],
    [-5, 0, 1, "redstone_wire"],
    [-6, 0, 1, "unpowered_repeater", 3],
    [-7, 0, 1, "command_block"],
    [-5, 0, 2, "redstone_wire"],
    [-5, 0, 3, "dropper", 3,
        sprintf("{Items:[
            {id:minecraft:record_11,Count:1,Slot:0b},
            {id:minecraft:dirt,Count:64,Slot:1b},
            {id:minecraft:dirt,Count:64,Slot:2b},
            {id:minecraft:dirt,Count:64,Slot:3b},
            {id:minecraft:dirt,Count:64,Slot:4b},
            {id:minecraft:dirt,Count:64,Slot:5b},
            {id:minecraft:dirt,Count:64,Slot:6b},
            {id:minecraft:dirt,Count:64,Slot:7b},
            {id:minecraft:dirt,Count:64,Slot:8b}
        ]}")
    ],
    [-5, 0, 4, "hopper", 0,
        sprintf("{Items:[
            {id:minecraft:air,Count:1,Slot:0b},
            {id:minecraft:air,Count:1,Slot:1b},
            {id:minecraft:air,Count:1,Slot:2b},
            {id:minecraft:air,Count:1,Slot:3b},
            {id:minecraft:air,Count:1,Slot:4b}
        ]}")
    ],
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
    [-5, 0, 13, "redstone_wire"],
    [-5, 0, 14, "redstone_wire"],
    [-2, 0, 13, "unpowered_repeater", 1],
    [-1, 0, 13, "command_block", 0,
        sprintf('{Command: "blockdata ~%s ~%s ~%s {Items:[
            {id:minecraft:record_11,Count:1,Slot:0b},
            {id:minecraft:dirt,Count:64,Slot:1b},
            {id:minecraft:dirt,Count:64,Slot:2b},
            {id:minecraft:dirt,Count:64,Slot:3b},
            {id:minecraft:dirt,Count:64,Slot:4b},
            {id:minecraft:dirt,Count:64,Slot:5b},
            {id:minecraft:dirt,Count:64,Slot:6b},
            {id:minecraft:dirt,Count:64,Slot:7b},
            {id:minecraft:dirt,Count:64,Slot:8b}
        ]}"}', -4, 0, -10),
    ],
    [-2, 0, 14, "unpowered_repeater", 1],
    [-1, 0, 14, "command_block", 0,
        sprintf('{Command: "blockdata ~%s ~%s ~%s {Items:[
            {id:minecraft:air,Count:1,Slot:0b},
            {id:minecraft:air,Count:1,Slot:1b},
            {id:minecraft:air,Count:1,Slot:2b},
            {id:minecraft:air,Count:1,Slot:3b},
            {id:minecraft:air,Count:1,Slot:4b}
        ]}"}', -4, 0, -10),
    ],
    [-5, 0, 5, "unpowered_comparator", 2],
    [-5, 0, 6, "redstone_wire"],
    [-6, 0, 6, "redstone_wire"],
    [-7, 0, 6, "command_block", 3],
    [-7, 0, 7, "chain_command_block", 3,
        sprintf('{
            Command: "fill ~%s ~%s ~%s ~%s ~%s ~%s air",
            auto: 1b
        }', +7, 0, -7, +1, +2, +7)
    ],
    [-7, 0, 8, "chain_command_block", 3,
        sprintf('{
            Command: "setblock ~%s ~%s ~%s unpowered_repeater 3",
            auto: 1b
        }', +1, 0, -7)
    ],
    [-7, 0, 9, "chain_command_block", 3,
        sprintf('{
            Command: "kill @e[type=Item]",
            auto: 1b
        }')
    ],
    [-7, 0, 10, "unpowered_comparator", 2],
    [-7, 0, 11, "unpowered_repeater", 14],
    [-7, 0, 12, "command_block", 4,
        sprintf('{
            Command: "fill ~%s ~%s ~%s ~%s ~%s ~%s redstone_wire"
        }', +2, 0, -12, +2, 0, +2)
    ],
    [-8, 0, 12, "chain_command_block", 4,
        sprintf('{
            Command: "fill ~%s ~%s ~%s ~%s ~%s ~%s unpowered_repeater 14",
            auto: 1b
        }', +3, 0, -7, +3, 0, -6)
    ],
    [-9, 0, 12, "unpowered_comparator", 3],
    [-10, 0, 12, "unpowered_repeater", 15],
    [-11, 0, 12, "command_block", 2],
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
