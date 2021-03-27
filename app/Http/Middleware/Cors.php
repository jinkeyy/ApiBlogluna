<?php
namespace App\Http\Middleware;
use Closure;
class Cors
{
 public function handle($request, Closure $next)
 {
//   return $next($request)
//    ->header('Access-Control-Allow-Origin', '*')
//    ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
//    ->header('Access-Control-Allow-Headers', 'Content-Type')
//    ->header('Access-Control-Allow-Headers', ' Authorization')
//    ->header('Access-Control-Allow-Methods', '*')
//    ->header('Access-Control-Allow-Credentials', 'true')
//    ->header('Access-Control-Allow-Headers', 'X-CSRF-Token');
//  }
$response = $next($request);
$response->headers->set('Access-Control-Allow-Origin' , '*');
$response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
$response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application','ip');
        
return $response;
}
}