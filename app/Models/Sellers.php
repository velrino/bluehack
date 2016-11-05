<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\ValidatorModel;
use Validator;

class Sellers extends Eloquent
{
  protected $collection = 'Sellers';
  protected static $unguarded = true;


  public function validateCreateSeller( array $inputs )
  {
    $validator = Validator::make(
      $inputs,
    [
      'name'   => 'required|string',
      'email' => 'required|string|unique:Sellers,email',
      'password' => 'required|string'
    ], ValidatorModel::$validatorMessage );


    if ($validator->fails())
      return [
        'code' => 400,
        'errors' => array_values(array_filter($validator->errors()->toArray())),
      ];
    return false;
  }

}
