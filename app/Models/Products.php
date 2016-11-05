<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\ValidatorModel;
use Validator;

class Products extends Eloquent
{
  protected $collection = 'Products';
  protected static $unguarded = true;


  public function validateNewProduct( array $inputs )
  {
    $validator = Validator::make(
      $inputs,
    [
      'seller_id'   => 'required|string|exists:Sellers,_id',
      'plan'        => 'required|string',
    ], ValidatorModel::$validatorMessage );


    if ($validator->fails())
      return [
        'code' => 400,
        'errors' => array_values(array_filter($validator->errors()->toArray())),
      ];
    return false;
  }

}
