<?php

namespace App\Views;

class DashboardView extends View {
    public static function render($view, $vars = [])
    {
        return SidebarLayoutView::render('layouts/dashboard', [], 'dashboard');
    }
}
