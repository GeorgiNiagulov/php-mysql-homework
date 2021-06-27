<?php

namespace App\Data;

use Exception;

class Validator 
{
  /**
     * @param $min
     * @param $max
     * @param $value
     * @param $type
     * @param $fieldName
     * @throws \Exception
     */
    public static function validateString($min, $max, $value, $fieldName)
    {
            if (mb_strlen($value) < $min || mb_strlen($value) > $max) {
                throw new \Exception("{$fieldName} трябва да бъдат между $min и $max символа!");
            }
    }

    public static function validateNumber($value, $fieldName)
    {
      if (!is_numeric($value)) {
            throw new \Exception("{$fieldName} трябва да бъде между $min и $max!");
      }
    }

    public static function validateDate($value, $fieldName)
    {
      $formatDatetime = str_replace('/', '-', $value);
      if (date("d/m/Y H:i", strtotime($formatDatetime)) != $value) {
        return 'Невалидна дата. Форматът на дата трябва да бъде: dd / mm / gggg.';
      }
    }
    
}


