<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaleProperty;
use App\Models\Structure;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $dbUp = true;

        try {
            DB::connection()->getPdo();
        } catch (\Throwable $e) {
            $dbUp = false;
        }

        $health = [
            'database' => $dbUp,
            'storage_public_writable' => is_writable(storage_path('app/public')),
            'app_key_set' => !empty(config('app.key')),
        ];

        $stats = [
            'structures_total' => Structure::query()->count(),
            'structures_active' => Structure::query()->where('active', true)->count(),
            'sales_total' => SaleProperty::query()->count(),
            'sales_active' => SaleProperty::query()->where('active', true)->count(),
            'admins_total' => User::query()->where('is_admin', true)->count(),
        ];

        return view('admin.dashboard', compact('health', 'stats'));
    }
}
