<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        // Attempt login
        $request->authenticate();

        // Regenerate session
        $request->session()->regenerate();

        // Redirect based on role
        $role = Auth::user()->role;

        switch ($role) {
            case 'admin':
                return redirect()->route('dashboard');
                break;
            case 'student':
                return redirect()->route('Studentdasbord.index');
                break;
            default:
                return redirect()->route('unauthorized.index');
                break;
        }
    }
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
