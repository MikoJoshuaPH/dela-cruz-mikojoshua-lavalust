<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['student_access'] = true;

        $message = $_GET['message'] ?? ($_SESSION['redirect_message'] ?? 'Welcome to the student page.');
        unset($_SESSION['redirect_message']);

        // Display student page
        $this->call->view('student_page', ['message' => $message]);
    }

    public function profile() {
        // Display student profile
        $this->call->view('student_profile');
    }
}
?>
