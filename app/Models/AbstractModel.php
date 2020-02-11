<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Closure;

/**
 * App\Models\AbstractModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbstractModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbstractModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbstractModel query()
 * @mixin \Eloquent
 */
class AbstractModel extends Model
{

    protected $guarded = [];

    public static function simpleDelete()
    {

    }

    protected function invokeClosure($closure, ...$params)
    {

    }


    public static function simpleEdit($id, $options = [])
    {

        $request = request();

        $options = array_merge([
            'isEdit' => true,
            'onload' => null,  // 页面载入的时候的回调函数
        ], $options);



//
//        if($options['onload'] instanceof Closure) {
//            $options['onload'] =
//        }


        $request = request();
        // 创建模型出来
        $model = new static;
        $model = static::find($id);

        dd($model);


        dd($model);
        die;




        $r = $model->exists;
        dd($r);


        $model->fill($data)->save();
    }

    public static function simpleCreate(array $options)
    {
        $model = new static;

        $options = array_merge([
            'attributes' => $options['attributes'],
            'beforeCreate' => null, // 创建之前的事件,
            'afterCreate' => null, // 创建以后的事件
        ], $options);

        if ($options['beforeCreate'] instanceof Closure) {
            $options['beforeCreate']($options['attributes'], $model);
        }

        $model->fill($options['attributes'])->save();

        if ($options['afterCreate'] instanceof Closure) {
            $options['afterCreate']($model);
        }

        return $model;
    }


}
