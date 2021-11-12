<?php

namespace App\Http\Helpers;

use Carbon\Carbon;

class Format
{

  public static function formatDate($date_time)
  {
    return Carbon::parse($date_time)->subHours(3)->format('d/m/Y \à\s H\h');
  }
}
