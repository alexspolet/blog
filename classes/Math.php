<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 23.11.18
 * Time: 11:19
 */

class Math
{
  const PI = 3.14;

  public static function circleRange($r)
  {
    return self::PI * $r * $r;
  }
}