<?php

namespace App\Views;

class TableView extends View {
    public static function render(
        $tableHeaders = [],
        $tableItems = [],
        $renderDatas = null
    ) {
        $renderDatas = $renderDatas ?? fn($item) => [];
        return parent::render('components/table', [
            'table_headers' => ListView::render('components/table-header', $tableHeaders) . View::render('components/table-header', ['title'=> 'Ações']),
            'table_rows'    => ListView::render(
                'components/table-row',
                array_map(
                    fn($item) => [
                        'table_datas' =>  ListView::render(
                            'components/table-data',
                            array_merge($renderDatas($item), [
                                ['data' => View::render('components/button', [
                                    'content' => 'Remover',
                                    'class' => 'btn-sm btn-error',
                                    'onclick' => "
                                        if (confirm('Deseja excluir?')) {
                                            const tr = this.closest('tr');
                                            fetch(window.location.href, { method: 'DELETE' })
                                            .then(res => res.ok ? tr.remove() : alert('Erro ao excluir no servidor.'));
                                        }
                                    ",
                                    'attrs' => 'data-id="'.($item['id'] ?? '').'"',
                                ])],
                            ]),
                        ) 
                    ],
                    $tableItems
                )
            ),
        ]);
    }
}
