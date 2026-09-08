<?php
class AuthController extends Controller
{
    public function register()
    {
        $this->call->library('auth');

        if ($this->io->method() == 'post') {
            $username = trim((string) $this->io->post('username'));
            $password = $this->io->post('password');
            $role = strtolower((string) ($this->io->post('role') ?? 'user'));
            $role = in_array($role, ['user', 'admin'], true) ? $role : 'user';
            $error = null;

            if (!preg_match('/^[A-Za-z0-9_]{3,30}$/', $username)) {
                $error = 'Username must be 3-30 characters and use only letters, numbers, or underscores.';
            } elseif (!is_string($password) || strlen($password) < 8) {
                $error = 'Password must be at least 8 characters.';
            } elseif ($this->auth->username_exists($username)) {
                $error = 'Username already exists. Try another username.';
            }

            if ($error === null && $this->auth->register($username, $password, $role)) {
                redirect('auth/login');
            }

            $this->call->view('auth/register', [
                'error' => $error ?: 'Registration failed. Please try again.',
                'username' => $username,
                'role' => $role,
            ]);
            return;
        }

        $this->call->view('auth/register');
    }

    public function login()
    {
        $this->call->library('auth');

        if ($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');

            if ($this->auth->login($username, $password)) {
                redirect('products');
            } else {
                echo 'Login failed!';
            }
        }

        $this->call->view('auth/login');
    }

    public function dashboard()
    {
        $this->call->library(['auth', 'session']);

        if (!$this->auth->is_logged_in()) {
            redirect('auth/login');
        }

        if (!$this->auth->has_role('admin')) {
            echo 'Access denied!';
            exit;
        }

        $this->call->view('auth/dashboard', ['session' => $this->session]);
    }

    public function logout()
    {
        $this->call->library('auth');
        $this->auth->logout();
        redirect('auth/login');
    }
}
?>