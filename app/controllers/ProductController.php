<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: ProductController
 * 
 * Automatically generated via CLI.
 */
class ProductController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('ProductModel');
        $this->call->library('auth');
    }

    public function index()
    {
        if (!$this->auth->is_logged_in()) {
            redirect('auth/register');
        }

        $products = $this->call->model('ProductModel')->all();
        $this->call->view('products', [
            'products' => $products,
            'is_admin' => $this->auth->has_role('admin'),
        ]);
    }

    public function create()
    {
        $this->require_admin();

        if($this->request->is_post()){
            $this->ProductModel->insert([
                'product_name' => $this->request->post('product_name'),
                'description' => $this->request->post('description'),
                'price' => $this->request->post('price'),
                'quantity' => $this->request->post('quantity'),
                'created_by' => date('Y-m-d H:i:s')

            ]);
            $this->session->set_flashdata('success', 'Product created successfully.');
            redirect('products');
        }

        $products = $this->ProductModel->all();
        $this->call->view('products', ['products' => $products, 'is_admin' => true]);
    }

    public function update($id)
    {
        $this->require_admin();

        if($this->request->is_post()){
            $this->ProductModel->update($id, [
                'product_name' => $this->request->post('product_name'),
                'description' => $this->request->post('description'),
                'price' => $this->request->post('price'),
                'quantity' => $this->request->post('quantity'),
                'created_by' => date('Y-m-d H:i:s'),
            ]);
            $this->session->set_flashdata('success', 'Product updated successfully.');
            redirect('products');
        }

        $product = $this->ProductModel->find($id);
        $products = $this->ProductModel->all();
        $this->call->view('products', [
            'products' => $products,
            'product' => $product,
            'is_admin' => true,
        ]);
    }

    public function delete($id)
    {
        $this->require_admin();

        $this->ProductModel->delete($id);
        $this->session->set_flashdata('success', 'Product deleted successfully.');
        redirect('products');
    }

    private function require_admin()
    {
        if (!$this->auth->is_logged_in()) {
            redirect('auth/register');
        }

        if (!$this->auth->has_role('admin')) {
            http_response_code(403);
            echo 'Access denied.';
            exit;
        }
    }
}