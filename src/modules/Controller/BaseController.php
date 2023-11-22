<?php
namespace Modules\Controller;

// require $base_path . '\src\helpers.php';

class BaseController
{
    protected function render(array $context = null)
    {
        if ($context) {
            return json_encode($context);
        }
    }
}