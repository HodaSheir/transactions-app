<?php

namespace App\Enums;

class UserTypes
{
  const ADMIN = 'admin';
  const CUSTOMER = 'customer';
  

  public static function getValues()
  {
    return [
      self::ADMIN,
      self::CUSTOMER,
    ];
  }
}
