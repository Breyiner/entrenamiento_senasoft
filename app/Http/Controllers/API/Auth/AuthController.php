<?php

namespace App\Http\Controllers\API\Auth;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

  protected $authService;

  public function __construct(AuthService $authService)
  {
    $this->authService = $authService;
  }

  public function login(LoginRequest $request)
  {
    $credentials = $request->validated();

    $result = $this->authService->login($credentials);

    if ($result['error'])

      return ResponseFormatter::error($result['message'], $result['code']);

    
    $cookieToken = $result['data']['cookieToken'];
    $cookieRefresh = $result['data']['cookieRefreshToken'];

    return ResponseFormatter::success(
      $result['message'], 
      $result['code'],
      array_diff_key($result['data'], array_flip(['cookieToken', 'cookieRefreshToken',]))
    )->cookie($cookieToken)
     ->cookie($cookieRefresh);
  }

  public function refreshToken(Request $request)
  {
    $user = Auth::user();

    $currentRefreshToken = $request->bearerToken();

    $result = $this->authService->refreshToken($currentRefreshToken, $user);

    return response()->json([
      'success' => true,
      'message' => 'Token refrescado exitosamente',
      'data' => []
    ])->cookie($result['cookieToken'])
      ->cookie($result['cookieRefreshToken']);
  }

  public function logOut(Request $request)
  {
    $user = Auth::user();

    $expiredCookies = $this->authService->createExpiredCookies();

    $result = $this->authService->logOut($user);

    return ResponseFormatter::success(
      $result['message'],
      $result['code'],
      $result['data']
    )->cookie($expiredCookies['expiredAccessToken'])
     ->cookie($expiredCookies['expiredRefreshToken']);
  }
}