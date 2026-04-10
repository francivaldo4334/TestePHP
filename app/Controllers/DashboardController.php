<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Views\SidebarLayoutView;

class DashboardController extends Controller {
    public function entry(Request $request): Response
    {
        return new Response(SidebarLayoutView::render('sidebar',[], 'dashboard'));
    }
}
