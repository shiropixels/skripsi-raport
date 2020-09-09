<?php

namespace App\Http\Middleware;

use Closure;

use Session;

use DB;

class SessionFound
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    private $exception = [
        'auth/Login',
        'auth/login-page',
        'student/LoginStudent',
        'student/StudentLoginPage'
    ];

    public function handle($request, Closure $next)
    {
        $pdo = DB::connection()->getPdo();

        if(Session::get('school_internal') != null){
            $data = DB::table('school_internal as si')->where('si.id', '=', Session::get('school_internal')->id)->get()->first();

            if($data == null){
                Session::flush();
                return redirect('/student/LoginStudent');
            }
        }else if(Session::get('student') != null){
            $data = DB::table('student as si')->where('si.id', '=', Session::get('student')->id)->get()->first();

            if($data == null){
                Session::flush();
                return redirect('/student/LoginStudent');
            }
        }


        if ( !in_array($request->route()->uri, $this->exception) && (empty(Session::get('school_internal')) && empty(Session::get('student')))) {
            return redirect('/student/LoginStudent');
        }else if ( (!empty(Session::get('school_internal')) || !empty(Session::get('student'))) && in_array($request->route()->uri,$this->exception) ){
            if(!empty(Session::get('student')))
                return redirect('/student/student-dashboard');

            return redirect('/internal/internal-dashboard');
        }

        return $next($request);
    }
}
