<?php

namespace App\Views;

class FormView extends View {
    public static function render(
        $inputs = [],
        $selects = [],
        $actions = [],
        $method = "",
        $action = "/",
    )
    {
    	return parent::render('components/form', [
	       'content'=> ListView::render(
	           'components/label',
	           array_map(fn($item)=>['label'=>$item['label'], 'content'=>View::render('components/input', $item)], $inputs)
	       ) . ListView::render(
	            'components/label',
                array_map(fn($item) => ['label' => $item['label'], 'content' => View::render('components/select', $item)], $selects)
           ) . ListView::render('components/button', $actions),
           'method' => $method,
           'action' => $action,
	    ]);
    }
}
