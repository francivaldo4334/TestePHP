<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Models\Database\Database;
use App\Views\AlunosView;

class AlunosController extends CrudController {
    private function renderResponse(){
        $items = Database::getConnection();
    	return new Response(AlunosView::render('', []));
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
