<?php

if (!function_exists('generateRoomId')) {
    function generateRoomId(int $id): string
    {
        $ids = [auth()->id(), $id];
        sort($ids);
        return 'room_' . md5($ids[0] . '_' . $ids[1]);
    }
}

