<?php
namespace Modules\Controller;

// require $base_path . '\src\helpers.php';

class BaseController
{
    protected function render(array $context = null)
    {
        // global $path;
        // if (count($context) == 2) {
        //     return extract($context);
        // }

        if ($context) {
            return json_encode($context);
        }
    }
}