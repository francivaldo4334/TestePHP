<?php

namespace App\Views;

class ListView extends View {
    public static function render($view, $items = [])
    {
    	return implode('',array_map(fn($item) => View::render($view, $item), $items));
    }
}
