<?php

namespace App\Frontend\Controller;

class NotFoundController extends AbstractRenderController
{
    public function error_404()
    {
        http_response_code(404);

        $this->render('notFound', []);
    }
}
