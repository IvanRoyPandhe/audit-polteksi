<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRoleId = auth()->user()->role_id;
        
        // Convert role names to role IDs
        $roleMap = [
            'admin' => 1,
            'auditor' => 2,
            'validator' => 3,
            'staff' => 4,
            'pimpinan' => 5,
        ];

        $allowedRoleIds = [];
        foreach ($roles as $role) {
            if (isset($roleMap[$role])) {
                $allowedRoleIds[] = $roleMap[$role];
            }
        }

        if (!in_array($userRoleId, $allowedRoleIds)) {
            abort(403, 'Unauthorized action. Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
