<?php

function validateStringLength($min, $max, $value, $fieldName)
{
        if (mb_strlen($value) < $min || mb_strlen($value) > $max) {
          return $fieldName." трябва да бъдат между $min и $max символа!";
        }
}

function validateNumber($value, $fieldName)
{
  if (!is_numeric($value)) {
      return $fieldName." трябва да бъде число!";
  }
}

function validateDate($value, $fieldName)
{
  $formatDatetime = str_replace('/', '-', $value);
  if (date("d/m/Y H:i", strtotime($formatDatetime)) != $value) {
    return 'Невалидна дата. Форматът на дата трябва да бъде: dd / mm / gggg.';
  }
}