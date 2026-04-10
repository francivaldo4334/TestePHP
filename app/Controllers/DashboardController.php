<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Views\BaseView;

class DashboardController extends Controller {
    public function entry(Request $request): Response
    {
        return new Response(BaseView::render('base'));
    }
}
