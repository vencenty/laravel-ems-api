<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Closure;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Schema;
use Vencenty\LaravelEnhance\Traits\JsonResponse;

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
    use JsonResponse;

    protected $guarded = [];


    public static function getList(array $params = [], $options = [])
    {


        $options = array_merge([
            'fields' => ['*'],
            'pager' => true,    // 是否返回分页
            'page' => null,    // 页面
            'pageSize' => (int)max(1, request('pageSize', 20)), // 页面大小
            'pageName' => 'page',    // 页面KEY
            'toArray' => false,  // callback中的对象转为Array
            'callback' => null, // 回调
            'sort' => null, // 排序字段
            'by' => null,   // 排序顺序
            'appendParams' => [],
        ], $options);


        $page = (int)request($options['pageName'], 1);

        $model = new static;

        // 从内存中拷贝一个对象出来
        $originModel = clone $model;

        foreach ($params as $key => $param) {
            // 处理搜索条件
            if ($key == 'search') {
                foreach ($param as $condition) {
                    $model = call_user_func_array([$model, 'where'], $condition);
                }
                // 处理完以后要跳出循环,避免掺杂其他条件
                continue;
            }
            /** @var Builder $model */
            $model = $model->$key($param);
        }


        // 计算总页数
        $total = $model->count();

        // 计算分页数据
        $list = $model->offset($options['pageSize'] * ($page - 1))
            ->limit($options['pageSize'])
            ->get();


        // 是否转为数组形式
        $list = $options['toArray'] ? $list->toArray() : $list->all();

        // 应用callback函数
        if ($options['callback'] instanceof Closure) {
            array_walk($list, $options['callback']);
        }

        // 分页数
        $pageTotal = ceil($total / $options['pageSize']);

        return array_merge([
            'list' => $list,
            'total' => $total,
            'page_total' => $pageTotal,
            'struct' => Schema::getColumnListing($originModel->getTable()),
        ], $options['appendParams']);

    }


    public static function simpleEdit($id, $options = [])
    {

    }

    public static function simpleCreate(array $options)
    {
        $model = new static;

        $options = array_merge([
            'attributes' => $options['attributes'],
            'beforeSave' => null, // 保存之前的事件,
            'afterSave' => null, // 保存以后的事件
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
