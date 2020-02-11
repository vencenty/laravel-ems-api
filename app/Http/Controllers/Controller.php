<?php

namespace App\Http\Controllers;

use Encore\Admin\Controllers\HasResourceActions;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Vencenty\LaravelEnhance\Traits\JsonResponse;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    use JsonResponse;




}
