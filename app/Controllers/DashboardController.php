<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Models\Database\Repositories\AlunoRepository;
use App\Models\Database\Repositories\DashboardRepository;
use App\Models\Database\Repositories\TurmaRepository;
use App\Models\Entities\AlunoEntity;
use App\Views\DashboardView;

class DashboardController extends Controller {
    private DashboardRepository $repository;
    private TurmaRepository $repositoryTurmas;
    private AlunoRepository $repositoryAlunos;
    public function __construct()
    {
        $this->repository = new DashboardRepository();
        $this->repositoryTurmas = new TurmaRepository();
        $this->repositoryAlunos = new AlunoRepository();
    }
    private function renderPage($items, $params){
        $turmas = $this->repositoryTurmas->list();
        return new Response(DashboardView::render('', $items, $turmas, $params));
    }
    public function entry(Request $request): Response
    {
        $params = $request->getParams();
        $filters = [];
        if (!empty($params['turma_id'])) {
            $alunos = $this->repositoryAlunos->listByTurmaId($params['turma_id']);
            $filters['aluno_ids'] = array_map(fn( AlunoEntity $it)=>$it->getId(), $alunos);
            if (empty($filters['aluno_ids'])) {
                $filters['aluno_ids'] = [0];
            }
        }
        if (!empty($params["date_start"])) {
            $filters['start_date'] = $params["date_start"];
        }
        if (!empty($params["date_end"])) {
            $filters['end_date'] = $params["date_end"];
        }
        $items = $this->repository->listWithFilters($filters);
        return $this->renderPage($items, $params);
    }
}
