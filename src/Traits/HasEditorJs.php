<?php

namespace BCleverly\Backend\Traits;


trait HasEditorJs
{
    public function buildContent(string $column = 'body')
    {
        $data = json_decode($this->attributes[$column]);
        $html = '';
        foreach($data->blocks as $block){
            $viewName = 'backend::editorjs.' . $block->type;
//            dump($viewName, $block->data);
            if (view()->exists($viewName)) {
                $html .= view()->make($viewName)->with((array)$block->data);
            }
        }
        return $html;
    }
}