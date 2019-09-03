<?php

namespace App\Services;

use App\Services\Contracts\RenderServiceInterface;

class RenderService implements RenderServiceInterface
{
    protected $includingTypes = [
        'two_cols'
    ];

    public function render(?string $content, string $type = null): string
    {
        $content = json_decode($content);
        return is_array($content) ? $this->renderAll($content, $type) : '';
    }

    protected function renderAll(array $content, $type = null): string
    {
        $html = '';
        foreach ($content as $item) {
            if (in_array($item->type, $this->includingTypes) && !empty($item->content)) {
                $nested = [];
                foreach ($item->content as $nestedBlock) {
                    $nested[] = $this->renderBlock($nestedBlock, null, $type);
                }

                $html .= $this->renderBlock($item, $nested, $type);
            } else {
                $html .= $this->renderBlock($item, null, $type);
            }
        }

        return $html;
    }

    protected function renderBlock($item, array $nested = null, $type = null): string
    {
        $view = 'builder.';
        $view .= $type ? $type . '.' : '';
        $view .= $item->type;
        return view()->exists($view) ? view($view, ['content' => $nested ?? $item->content])->render() : '';
    }
}
