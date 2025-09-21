<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Database;

class VisitorCounter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $db = Database::connect();
        $builder = $db->table('visitors');

        $today = date('Y-m-d');
        $visitor = $builder->where('visit_date', $today)->get()->getRow();

        if ($visitor) {
            // Jika ada data untuk hari ini, tingkatkan jumlahnya
            $builder->set('count', 'count+1', false)
                    ->where('visit_date', $today)
                    ->update();
        } else {
            // Jika belum ada data untuk hari ini, buat catatan baru
            $builder->insert([
                'visit_date' => $today,
                'count' => 1,
            ]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak diperlukan untuk after
    }
}
