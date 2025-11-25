<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * API Authentication Filter
 *
 * Filter ini memvalidasi API Key untuk semua request ke endpoint API.
 * API Key harus dikirim melalui header 'X-API-Key' dan harus cocok
 * dengan nilai yang disimpan di file .env (API_KEY).
 */
class ApiAuth implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Ambil API Key dari environment
        $expectedApiKey = env('API_KEY');

        // Jika API_KEY tidak diset di .env, tolak semua request
        if (!$expectedApiKey) {
            return $this->unauthorizedResponse('API Key tidak dikonfigurasi di server');
        }

        // Ambil API Key dari header request
        $providedApiKey = $request->getHeaderLine('X-API-Key');

        // Jika header X-API-Key tidak ada atau kosong
        if (!$providedApiKey) {
            return $this->unauthorizedResponse('API Key tidak ditemukan di header X-API-Key');
        }

        // Validasi API Key (case-sensitive)
        if ($providedApiKey !== $expectedApiKey) {
            return $this->unauthorizedResponse('API Key tidak valid');
        }

        // Jika valid, lanjutkan request
        return;
    }

    /**
     * Returns the Response instance for unauthorized access
     *
     * @param string $message
     * @return ResponseInterface
     */
    private function unauthorizedResponse(string $message): ResponseInterface
    {
        $response = service('response');
        $response->setStatusCode(401);
        $response->setJSON([
            'status' => 'error',
            'message' => $message,
            'code' => 401
        ]);
        $response->setHeader('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada processing setelah request
    }
}
