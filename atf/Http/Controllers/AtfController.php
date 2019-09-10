<?php

namespace atf\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Atf\Http\Controllers\tAtfInitController;

class AtfController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    use tAtfInitController;
}
