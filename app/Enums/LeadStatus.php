<?php

namespace App\Enums;

enum LeadStatus: string
{
    case New = 'new';
    case InProgress = 'in_progress';
    case Done = 'done';

    public function getLabel(): string
    {
        return match ($this) {
            self::New => 'New',
            self::InProgress => 'In progress',
            self::Done => 'Done',
        };
    }
}
