<?php

namespace App\Actions\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
      $user = $request->user();

      if ($user->role === 'admin') {
          return redirect()->route('admin.dashboard');
      }
       elseif ($user->role === 'user') {
        return redirect()->intended(url()->previous()); // Change '/' to your custom redirect
      }

     // return redirect()->route('user.dashboard');
       // return redirect()->intended('/'); // Change '/' to your custom redirect
      return redirect()->to(url()->previous()); // Change '/' to your custom redirect
    }
}
