<?php

namespace App\Services;

use App\Services\Contracts\RenderServiceInterface;

class RenderService implements RenderServiceInterface
{
    protected $includingTypes = [
        'two_cols'
    ];

    public function render(string $content): string
    {
        $content = json_decode($content);
        if (is_array($content))
            return $this->renderAll($content);
        else
            return '';
    }

    protected function renderAll(array $content): string
    {
        $html = '';
        foreach ($content as $item) {
            if (in_array($item->type, $this->includingTypes) && isset($item->content) && $item->content) {
                $nested = [];
                foreach ($item->content as $nestedBlock) {
                    $nested[] = $this->renderBlock($nestedBlock);
                }
                $html .= $this->renderBlock($item, $nested);
            }
            else
                $html .= $this->renderBlock($item);
        }
        return $html;
    }

    protected function renderBlock(object $item, array $nested = null): string
    {
        if (view()->exists('dynamic.'.$item->type))
            return view('dynamic.'.$item->type, ['content' => $nested ?? $item->content])->render();
        else
            return '';
    }
}
