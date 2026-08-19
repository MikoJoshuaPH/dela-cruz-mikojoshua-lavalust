<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['student_access'] = true;

        // Display student page
        $this->call->view('student_page');
    }

    public function profile() {
        // Create student associative array
        $student = [
            'student_id'    => 'MCC2024-00043',
            'name'          => 'Dela Cruz, Miko Joshua Austria',
            'course'        => 'BS Information Technology',
            'year'          => '3rd Year',
            'section'       => 'F1',
            'email'         => 'mikojoshuaph@gmail.com',
            'contact'       => '0981 222 7628',
            'address'       => 'Brgy. Tawagan, Calapan City, Oriental Mindoro',
            'status'        => 'Access Granted',
            'avatar_initials' => 'MJ'
        ];

        // Display student profile with data
        $this->call->view('student_profile', $student);
    }
}
?>
