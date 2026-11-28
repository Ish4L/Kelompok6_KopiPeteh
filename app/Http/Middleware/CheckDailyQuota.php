<?php

namespace App\Http\Middleware;

use App\Models\OrderItem;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDailyQuota
{
    private const DAILY_MAX_CUPS = 10;

    public function handle(Request $request, Closure $next): Response
    {
        $soldToday = OrderItem::whereHas('order', 
            function ($query) {
                $query->whereDate('created_at', today())->where('status', '!=', 'dibatalkan');
            }
        )->sum('quantity');

        if ($soldToday >= self::DAILY_MAX_CUPS) {
            return redirect()->route('unavailable');
        }

        return $next($request);
    }
}