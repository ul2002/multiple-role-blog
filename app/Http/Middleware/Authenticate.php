<?php

namespace App\Http\Middleware;  // customize with your own namespace

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class Authenticate extends BaseMiddleware {

    const HEADER_TOKEN = 'x-access-token';
    const HTTP_FORBIDDEN        = 403;
    const HTTP_NOTFOUND         = 404;

    public function handle(\Illuminate\Http\Request $request, \Closure $next) {
        $token = $request->header(self::HEADER_TOKEN);

        if (!$token) {
            return response()->json('token_not_provided',self::HTTP_FORBIDDEN);
        }

        try {
            //$user = $this->auth->authenticate($token);
            var_dump($this->auth->parseToken());
            $user = $this->auth->parseToken()->authenticate(); //authenticate the token by user - Return an user instance if ok
        } catch (TokenExpiredException $e) {
            return response()->json('token_expired',self::HTTP_FORBIDDEN);
        } catch (JWTException $e) {
            return response()->json('token_invalid',self::HTTP_FORBIDDEN);
        }

        if (!$user) {
            return response()->json('user_not_found',self::HTTP_NOTFOUND);

        }

        $request->request->add(['user_id' => $user->id]); // Prepend our request with new params user_id and token in oder to check role after when we process in controller
        $request->request->add(['token' => $token]); // We add user_id and token in request params and forward to controller.

        return $next($request);
    }


}
