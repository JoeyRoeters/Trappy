<?php

namespace App\Helpers\Overview\ActionButton;

class ActionButton
{
    public function __construct(private string $icon, private string $url, private ?string $title = '')
    {
    }

    public static function create(string $icon, string $url, ?string $title = null): self
    {
        return new static($icon, $url, $title);
    }

    public function render(): string
    {
        return view(
            'templates/action_button',
            [
                'icon' => $this->icon,
                'url' => $this->url,
                'title' => $this->title
            ]
        )->render();
    }
}
