<?php

declare(strict_types=1);

namespace App\Enums;

enum InvoiceStatus: int
{
    case Pending = 0;
    case Paid = 1;
    case Void = 2;
    case Failed = 3;

    /**
     * Returns enum to a string
     * @return string
     */
    public function toString(): string
    {
        return match ($this) {
            self::Paid => 'Paid',
            self::Failed => 'Failed',
            self::Void => 'Void',
            default => 'Pending',
        };
    }

    /**
     * Return the color for the current Invoice status
     * @return Color
     */
    public function color(): Color

    {
        return match ($this) {
            self::Paid => Color::Green,
            self::Failed => Color::Red,
            self::Void => Color::Gray,
            default => Color::Orange,
        };
    }

    /**
     * Get invoice status from color enum
     * @param  Color  $color
     * @return InvoiceStatus
     */
    public static function fromColor(Color $color): self
    {
        return match ($color) {
            Color::Green => self::Paid,
            Color::Red => self::Failed,
            Color::Gray => self::Void,
            default => self::Pending,
        };
    }
}
