<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Models\Database\Repositories\TurmaRepository;
use App\Models\Entities\TurmaEntity;
use App\Views\TurmasView;

class TurmasController extends CrudController {
    private TurmaRepository$repository;
    public function __construct()
    {
        $this->repository = new TurmaRepository();
    }
    private function rendePage(){
        $alunos = $this->repository->list();
        return TurmasView::render('', $alunos);
    }
    public function get(Request $request): Response
    {
    	return new Response($this->rendePage());
    }
    public function post(Request $request): Response
    {
        $body = $request->getBody();
        $model = new TurmaEntity();
        $model->setNome($body['name']);
        $model->setAno($body['ano']);

        $this->repository->create($model);

    	return new Response($this->rendePage(), 201);
    }
    public function delete(Request $request): Response
    {
        $params = $request->getParams();
        $id = $params['id'];
        $this->repository->delete($id);
    	return new Response("Ok", 204);
    }
}
