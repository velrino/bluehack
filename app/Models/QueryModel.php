<?php

namespace App\Models;

class QueryModel
{
  public function query($model, $request = '')
    {
     return (!empty( $request->input() )) ? $this->queryExec($model, $request->input() )->get() : $model->take( (int) env('DB_LIMIT_RETURN') )->get() ;
    }

    function queryExec($model, $request)
    {
      foreach ($request as $key => $value)
        foreach (explode('AND', $value) as $index => $val)
          $model = $this->queryConditions( $model, $key, explode(',', $val)[0], explode(',', $val)[1] );
      return $model;
    }

    function queryConditions($model, $type = '' , $key, $value)
    {
      if ($type == 'where')
          $model = $model->where($key, $value);
      if ($type == 'orwhere')
          $model = $model->orWhere($key, $value);
      if ($type == 'order')
          $model = $model->orderBy($key, $value);
      return $model->take( ($type == 'take') ? (int) explode(',', $value)[0] : (int) env('DB_LIMIT_RETURN') );
    }
}
