<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Models\Database\Repositories\DashboardRepository;
use App\Views\DashboardView;

class DashboardController extends Controller {
    private DashboardRepository $repository;
    public function __construct()
    {
        $this->repository = new DashboardRepository();
    }
    public function entry(Request $request): Response
    {
        $items = $this->repository->list();
        return new Response(DashboardView::render('', $items, 'dashboard'));
    }
}
