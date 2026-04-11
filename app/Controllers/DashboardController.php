<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Views\DashboardView;

class DashboardController extends Controller {
    public function entry(Request $request): Response
    {
        return new Response(DashboardView::render('',[], 'dashboard'));
    }
}
