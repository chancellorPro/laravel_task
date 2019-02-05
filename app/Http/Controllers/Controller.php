<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs,
Illuminate\Routing\Controller as BaseController,
Illuminate\Foundation\Validation\ValidatesRequests,
Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
