<?php

namespace App\Enums;

class TransactionStatus
{
  const PAID = 'paid';
  const OUTSTANDING = 'outstanding';
  const OVERDUE = 'overdue';

  public static function getValues()
  {
    return [
      self::PAID,
      self::OUTSTANDING,
      self::OVERDUE,
    ];
  }
}
