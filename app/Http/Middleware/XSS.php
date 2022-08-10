<?php
/*
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
class XSS
{
    public function handle(Request $request, Closure $next)
    {
        // echo json_encode($request->all())."<br><br>";
        $input = $request->all();
        array_walk_recursive($input, function(&$input) {
            if($input==="")
                $input=null;
            else
                $input = strip_tags($input);
        });
        $request->merge($input);
        // die(json_encode($request->all()));
        return $next($request);
    }
}
*/