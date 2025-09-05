<?php

namespace App\Actions\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
      //  return redirect()->intended('/'); // Change '/' to your custom redirect
      return redirect()->intended(url()->previous()); // Change '/' to your custom redirect
    }
}