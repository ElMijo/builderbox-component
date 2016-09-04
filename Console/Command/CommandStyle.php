<?php
namespace BuilderBox\Component\Console\Command;

use BuilderBox\Component\Console\Exception\CommandStyleNotFoundException;
/**
 * It can handle more simply SymfonyStule styles of class
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class CommandStyle
{
    const COLOR_BLACK = "black";
    const COLOR_RED = "red";
    const COLOR_GREEN = "green";
    const COLOR_YELLOW = "yellow";
    const COLOR_BLUE = "blue";
    const COLOR_MAGENTA = "magenta";
    const COLOR_CYAN = "cyan";
    const COLOR_WHITE = "white";
    const COLOR_DEFAULT = "default";

    public static function styleBlock($fontColor, $backgroundColor)
    {
        if (!static::validateColor($fontColor)) {
            throw new CommandStyleNotFoundException(
                sprintf("Font color: %s is invalid color", $fontColor)
            );
        }

        if (!static::validateColor($backgroundColor)) {
            throw new CommandStyleNotFoundException(
                sprintf("Background color: %s is invalid color", $fontColor)
            );
        }

        return sprintf("fg=%s;bg=%s", $fontColor, $backgroundColor);
    }

    private static function validateColor($color)
    {
        return in_array(
            $color, [
            "black",
            "red",
            "green",
            "yellow",
            "blue",
            "magenta",
            "cyan",
            "white",
            "default"
        ]);
    }
}
