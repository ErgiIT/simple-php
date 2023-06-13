<?php

namespace App\Models;

use App\Core\App;
use App\Core\Database\QueryBuilder;
abstract class Model
{

    public static function get()
    {
        return App::get('database')->selectAll(static::getTable());
    }

    public static function create( $data)
    {
        return App::get('database')->insert(static::getTable(), $data);
    }

    public static function update($id, $data)
    {
        App::get('database')->update(static::getTable(), $id, $data);
    }

    public static function delete($id)
    {
        App::get('database')->delete(static::getTable(), $id);
    }

    public static function find($id)
    {
        return App::get('database')->select(static::getTable(), $id);
    }

    public static function where($column, $value)
    {
        return App::get('database')->select(static::getTable(), [$column => $value]);
    }

    protected abstract static function getTable();

}