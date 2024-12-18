<?php

declare(strict_types=1);

namespace App;


use App\Exceptions\ViewException;

class View
{
    public function __construct(
        protected string $view,
        protected array $params = []
    ) {
    }

    public static function make(string $view, array $params = []): static
    {
        return new static($view, $params);
    }

    /**
     * @throws ViewException
     */
    public function render(): string
    {
        $viewPath = VIEW_PATH.'/'.$this->view.'.php';

        if (!file_exists($viewPath)) {
            throw ViewException::viewNotFound();
        }

        foreach ($this->params as $key => $value) {
            $$key = $value;
        }

        ob_start();

        include $viewPath;

        return (string)ob_get_clean();
    }


    /**
     * @throws ViewException
     */
    public function __toString(): string
    {
        return $this->render();
    }

    public function __get(string $name)
    {
        return $this->params[$name] ?? null;
    }
}