<?php

namespace App\Helpers;

class AvatarHelper
{
    public static function getInitials($name)
    {
        $words = explode(' ', $name);
        $initials = strtoupper(substr($words[0], 0, 1));
        if (count($words) > 1) {
            $initials .= strtoupper(substr($words[1], 0, 1));
        }
        return $initials;
    }

    public static function getColorClass($name)
    {
        $colors = [
            'bg-red-500', 'bg-green-500', 'bg-blue-500',
            'bg-yellow-500', 'bg-indigo-500', 'bg-purple-500', 'bg-pink-500'
        ];
        return $colors[crc32($name) % count($colors)];
    }
}
