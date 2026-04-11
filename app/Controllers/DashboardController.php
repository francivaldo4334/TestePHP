<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Models\Database\Repositories\AlunoRepository;
use App\Models\Database\Repositories\DashboardRepository;
use App\Models\Database\Repositories\TurmaRepository;
use App\Models\Entities\AlunoEntity;
use App\Utils\DocxGenerator;
use App\Utils\PdfGenerator;
use App\Utils\XlsxGenerator;
use App\Views\DashboardView;
use App\Views\ReportDocxView;
use App\Views\ReportPdfView;

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
    public function generateReportXlsx(Request $request): Response {
        $notas = $this->repository->list();
        $headers = ['Aluno', 'Turma', 'Disciplina', 'Dt/Lancamento', 'Média'];
        $rows = [];

        foreach($notas as $nota) {
            $rows[] = [
                $nota->getNomeDoAluno(),
                $nota->getNomeDaTurma(),
                $nota->getDisciplina(),
                $nota->getDataLancamento(),
                $nota->getMediaDoAluno(),  
            ];
        }

        $xlsxGenerator = new XlsxGenerator();
        $xlsx = $xlsxGenerator->generateXlsx($headers, $rows);

        $response = new Response($xlsx);

        $response->setContentType('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->addHeader('Content-Disposition', 'attachment; filename="relatorio.xlsx"');
        $response->addHeader('Cache-Control', 'max-age=0');
        return $response;
    }
    public function generateReportDocx(Request $request): Response {
        $notas = $this->repository->list();
        $alunos = $this->repositoryAlunos->list();
        $html = ReportDocxView::render(notas:$notas, alunos:$alunos);
        $docxGenerator = new DocxGenerator();
        $docx = $docxGenerator->generateByHtml($html);

        $response = new Response($docx);
        $response->setContentType('application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        $response->addHeader('Content-Disposition', 'attachment; filename="relatorio.docx"');
        return $response;
    }
    public function generateReportPdf(Request $request): Response {
        $notas = $this->repository->list();
        $alunos = $this->repositoryAlunos->list();
        $html = ReportPdfView::render(notas:$notas, alunos:$alunos);

        $pdfGenerator = new PdfGenerator();
        $pdf = $pdfGenerator->generateByHtml($html);
        $response = new Response($pdf);
        $response->setContentType('application/pdf');
        $response->addHeader('Content-Disposition', 'attachment; filename="relatorio.pdf"');
        return $response;
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
