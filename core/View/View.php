<?php

namespace Core\View;

class View
{
    public function __construct(private string $path,private ?array $data = null)
    {
    }
    public function render()
    {
        $path = $this->path;
        $data = $this->data;
        return $this->renderLayout($this->renderView($path, $data));
    }
    private function renderLayout($content)
    {
        if (file_exists(__DIR__.'/../../app/Views/Components/layout.php')) {
            ob_start();
            include __DIR__.'/../../app/Views/Components/layout.php';
            return ob_get_clean();
        } else {
            throw new \Exception('app/Views/Components/layout.php not found');
        }
    }
    private function renderView(string $path,?array $data)
    {
        if (file_exists(__DIR__.'/../../app/Views/'.$path.'.php')) {
            ob_start();
            if ($data) {
                extract($data);
            }
            include __DIR__.'/../../app/Views/'.$path.'.php';
            return ob_get_clean();
        } else {
            throw new \Exception("View $path not found");
        }
    }
}