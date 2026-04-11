<?php

namespace App\Views;

class TableView extends View {
    public static function render(
        $tableHeaders = [],
        $tableItems = [],
        $renderDatas = null,
        $style = '',
    ) {
        $renderDatas = $renderDatas ?? fn($item) => [];
        return parent::render('components/table', [
            'attrs'=>!empty($style) ? 'style="'.$style.'"' : '',
            'table_headers' => ListView::render('components/table-header', $tableHeaders),
            'table_rows'    => ListView::render(
                'components/table-row',
                array_map(
                    fn($item) => [
                        'table_datas' =>  ListView::render(
                            'components/table-data',
                            $renderDatas($item),
                        ) 
                    ],
                    $tableItems
                )
            ),
        ]);
    }
}
