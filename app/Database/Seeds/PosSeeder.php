<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PosSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('customers')->insertBatch([
            ['full_name' => 'Juan Dela Cruz', 'email' => 'juan@example.com', 'phone' => '09171234567', 'created_at' => '2026-10-02 09:00:00'],
            ['full_name' => 'Maria Santos', 'email' => 'maria@example.com', 'phone' => '09181234567', 'created_at' => '2026-10-02 09:05:00'],
            ['full_name' => 'Pedro Reyes', 'email' => 'pedro@example.com', 'phone' => '09191234567', 'created_at' => '2026-10-02 09:10:00'],
            ['full_name' => 'Angela Garcia', 'email' => 'angela@example.com', 'phone' => '09201234567', 'created_at' => '2026-10-02 09:15:00'],
            ['full_name' => 'Carlo Mendoza', 'email' => 'carlo@example.com', 'phone' => '09211234567', 'created_at' => '2026-10-02 09:20:00'],
        ]);

        $this->db->table('users')->insertBatch([
            ['username' => 'admin01', 'full_name' => 'Anna Cruz', 'created_at' => '2026-10-02 09:00:00'],
            ['username' => 'cashier01', 'full_name' => 'Mark Santos', 'created_at' => '2026-10-02 09:05:00'],
            ['username' => 'cashier02', 'full_name' => 'Liza Reyes', 'created_at' => '2026-10-02 09:10:00'],
            ['username' => 'manager01', 'full_name' => 'John Garcia', 'created_at' => '2026-10-02 09:15:00'],
            ['username' => 'staff01', 'full_name' => 'Paolo Mendoza', 'created_at' => '2026-10-02 09:20:00'],
        ]);
    }
}