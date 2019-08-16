<?php

namespace App\Services\Contracts;

interface RenderServiceInterface
{
    public function render(string $content): string;
}
