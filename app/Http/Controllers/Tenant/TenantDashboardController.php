<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TenantDashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('tenant/TenantDashboard');
    }
}
