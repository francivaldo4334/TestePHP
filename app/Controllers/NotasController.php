<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Models\Database\Repositories\AlunoRepository;
use App\Models\Database\Repositories\NotaRepository;
use App\Models\Entities\NotaEntity;
use App\Views\NotasView;

class NotasController extends CrudController {
    private NotaRepository $repository;
    private AlunoRepository $repositoryAlunos;
    public function __construct()
    {
        $this->repository = new NotaRepository();
        $this->repositoryAlunos = new AlunoRepository();
    }
    
    private function rendePage(){
        $notas = $this->repository->list();
        $alunos = $this->repositoryAlunos->list();
        return NotasView::render('', $notas, $alunos);
    }
    public function get(Request $request): Response
    {
    	return new Response($this->rendePage());
    }
    public function post(Request $request): Response
    {
        $body = $request->getBody();
        $model = new NotaEntity();
        $model->setAlunoId($body['aluno_id']);
        $model->setDataLancamento($body['lancamento']);
        $model->setNota($body['nota']);
        $model->setDisciplina($body['disciplina']);

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
