<?php

namespace App\Http\Middleware;

use App\Models\Config\LogsActivities;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordLogs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $this->log($request, $response);
    }

    protected function log($request, $response)
    {

        if(isset(Auth::user()->id)){

            # Informasi url
            $fullUrl = $request->fullUrl();

            # Informasi Methode POST, PUT, DELETE atau GET
            $method = $request->getMethod();

            # Informasi getClientIp
            $clientIp = $request->getClientIp();

            # Informasi Status Code 200,403,500 dll
            $statusCode = $response->getStatusCode();

            # Data request ambil data yg di kirim user
            $req = $request->all();

            # Data user
            $userId = Auth::user()->id;
            $userName = Auth::user()->name;
            $userEmail = Auth::user()->email;

            $data = new LogsActivities();
            $data->users_id     = $userId;
            $data->name         = $userName;
            $data->email        = $userEmail;
            $data->full_url     = $fullUrl;
            $data->method       = $method;
            $data->client_ip    = $clientIp;
            $data->status_code  = $statusCode;
            $data->response     = json_encode($req);
            $data->save();
        }
        
    }
}
