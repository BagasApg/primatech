<?php

namespace App\Enums;

enum Gender: string
{
    case MALE = "male";
    case FEMALE = "female";

    public function getLabel() {
        return match($this) {
            self::MALE => "Male",
            self::FEMALE => "Female",
        };
    }
}
