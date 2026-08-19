<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentMiddleware
{
    /**
     * Handle the incoming request.
     *
     * @param Closure $next
     * @return mixed
     */
    public function handle(Closure $next)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['student_access']) && $_SESSION['student_access'] === true) {
            return $next();
        }

        // Display forbidden page if accessing student profile without proper access
        include APP_DIR . 'views/errors/error_forbidden.php';
        exit();
    }
}
