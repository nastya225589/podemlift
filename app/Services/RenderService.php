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
        return is_array($content) ? $this->renderAll($content) : '';
    }

    protected function renderAll(array $content): string
    {
        $html = '';
        foreach ($content as $item) {
            if (in_array($item->type, $this->includingTypes) && !empty($item->content)) {
                $nested = [];
                foreach ($item->content as $nestedBlock)
                    $nested[] = $this->renderBlock($nestedBlock);

                $html .= $this->renderBlock($item, $nested);
            } else {
                $html .= $this->renderBlock($item);
            }
        }

        return $html;
    }

    protected function renderBlock($item, array $nested = null): string
    {
        $view = 'builder.' . $item->type;
        return view()->exists($view) ? view($view, ['content' => $nested ?? $item->content])->render() : '';
    }
}
