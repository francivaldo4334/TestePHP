<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Models\Database\Repositories\AlunoRepository;
use App\Models\Entities\AlunoEntity;
use App\Views\AlunosView;

class AlunosController extends CrudController {
    private AlunoRepository $repository;
    public function __construct()
    {
        $this->repository = new AlunoRepository();
    }
    private function rendePage(){
        $alunos = $this->repository->list();
        return AlunosView::render('', $alunos);
    }
    public function get(Request $request): Response
    {
    	return new Response($this->rendePage());
    }
    public function post(Request $request): Response
    {
        $body = $request->getBody();
        $model = new AlunoEntity();
        $model->setNome($body['nome']);
        $model->setEmail($body['email']);
        $model->setTurmaId($body['turma_id']);

        $this->repository->create($model);

    	return new Response($this->rendePage(), 201);
    }
    public function delete(Request $request): Response
    {
    	return new Response(AlunosView::render('', []));
    }
}
