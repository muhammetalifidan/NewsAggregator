<?php

arch('registered admin controller must contain methods')
    ->expect('App\Http\Controllers\Web\Auth\RegisteredAdminController')
    ->toHaveMethods(['create', 'store']);