<?php
namespace App\Controllers;

class ErrorController extends Controller
{
    public function notFound()
    {
        http_response_code(404);

        return $this->render('error/404');
    }
}