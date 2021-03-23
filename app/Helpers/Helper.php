<?php
namespace App\Helpers;
use DateTime;
use Illuminate\Support\Carbon;

class Helper  {
  
  public static function addDate($date_str, $months)
  {
      $date = new DateTime($date_str);

      // We extract the day of the month as $start_day
      $start_day = $date->format('j');

      // We add 1 month to the given date
      $date->modify("+{$months} month");

      // We extract the day of the month again so we can compare
      $end_day = $date->format('j');

      if ($start_day != $end_day)
      {
          // The day of the month isn't the same anymore, so we correct the date
          $date->modify('last day of last month');
      }

      return $date;
  }

  public static function translateDate($date = null, $format = 'd F Y')
  {
      if($date == null) {
          return null;
      } else {
          return  Carbon::parse($date)->translatedFormat($format);
      }
  }

  public static function nullReplace($value, $replace = '-')
  {
      return $value ? $value : $replace;
  }

}