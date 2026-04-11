<?php

namespace App\Views;

class TableWithDeleteActionView extends TableView {
    public static function render($tableHeaders = [], $tableItems = [], $renderDatas = null, $style='')
    {
        return parent::render(
            array_merge($tableHeaders, [['title'=>'Ações']]),
            $tableItems,
            fn($item)=> array_merge($renderDatas($item), [
                [
                    'data' => View::render('components/button', [
                        'content' => 'Remover',
                        'class' => 'btn-sm btn-error',
                        'onclick' => "
                            if (confirm('Deseja excluir?')) {
                                const tr = this.closest('tr');
                                const id = '" . $item->getId() . "';
                                fetch(window.location.href + '?id=' + id, { method: 'DELETE' })
                                .then(res => {
                                    if (res.ok) return tr.remove();

                                    if (res.status < 500) {
                                        return res.text().then(msg => alert(msg));
                                    }

                                    alert('Erro ao excluir no servidor.');
                                });
                            }
                        ",
                    ])
                ]
            ]),
            $style,
        );
    }
}
