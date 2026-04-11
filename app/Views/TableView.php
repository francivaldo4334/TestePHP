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
