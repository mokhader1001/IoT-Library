<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CardIdFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // ✅ Allow user if already logged in (has session)
        if (session()->has('user_id')) {
            return; // allow to proceed
        }

        // ❌ If user is not logged in, block access
        return redirect()->to(base_url(''));
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No post-response logic needed
    }
}
