<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Views\SidebarLayoutView;

class AlunosController extends CrudController {
    private function renderResponse(){
    	return new Response(SidebarLayoutView::render('', [], 'alunos'));
    }
    public function get(Request $request): Response
    {
        return $this->renderResponse();
    }
    public function post(Request $request): Response
    {
        return $this->renderResponse();
    }
    public function delete(Request $request): Response
    {
        return $this->renderResponse();
    }
}
