<?php

function validateStringLength($min, $max, $value, $fieldName)
{
        if (mb_strlen($value) < $min || mb_strlen($value) > $max) {
          return $fieldName." трябва да бъдат между $min и $max символа!";
        }
        return true;
}

function validateNumber($value, $fieldName)
{
  if (!is_numeric($value)) {
      return $fieldName." трябва да бъде число!";
  }
  return true;
}

function validateDate($value, $fieldName)
{
  $formatDatetime = str_replace('/', '-', $value);
  if (date("Y-m-d", strtotime($formatDatetime)) != $value) {
    return 'Невалидна дата. Форматът на дата трябва да бъде: gggg-mm-dd.';
  }
  return true;
}