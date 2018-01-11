<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenerateTokenController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form to generate a new token or copy current token.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function generateForm(Request $request)
    {
        return view('auth.tokens.generate', [
            'token' => $request->user()->api_token
        ]);
    }

    /**
     * Generate a new token and redirect to form.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generate(Request $request)
    {
        $user = $request->user();

        $user->api_token = $token = md5($user->email . microtime());

        $user->save();

        return redirect()->route('tokens.generateForm')
            ->with('token', $token);
    }
}
