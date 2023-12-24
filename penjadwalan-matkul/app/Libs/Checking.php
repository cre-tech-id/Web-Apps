<?php

namespace App\Libs;

use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class Checking
{
    public static function list()
    {
        $list = [];
        foreach (array_diff(scandir(app_path('Http/Controllers/Backend')), array('.', '..')) as $controller) {
            // preg_match_all('/function (\w+)/', file_get_contents(app_path('Http/Controllers/Backend/' . $controller)), $m);
            preg_match_all("/Access::has\('(.*?)'/", file_get_contents(app_path('Http/Controllers/Backend/' . $controller)), $m);
            $m[1] = array_unique($m[1]);
            $menu = strtolower(str_replace('Controller.php', '', $controller));
            $list = array_merge($list, [$menu => $m[1]]);
        }

        return $list;
    }
    public static function has($permission)
    {
        if (!auth()->check()) {
            abort(401);
        }
        if (self::check($permission) == false) {
            abort(403);
        }
    }
    public static function peserta()
    {
        if (!auth()->check()) {
            abort(401);
        }
        if (auth()->user()->role_id != 3) {
            abort(401);
        }
    }
    public static function check($permission)
    {
        if($permission == 'dosen'){
            abort(404);
        }        
    }
}
