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

        $message = 'Access denied. Please open the student page first to continue to the profile.';
        $_SESSION['redirect_message'] = $message;

        $redirect_url = '/lavalust/student?message=' . urlencode($message);
        header('Location: ' . $redirect_url);
        exit();
    }
}
