<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use RuntimeException;

class TasksDemoSeeder extends Seeder
{
    public function run()
    {
        $this->seedTasks();
        $this->replaceUsersWithDemo();
    }

    private function seedTasks(): void
    {
        $rows = $this->db->table('tasks')
            ->select('task_date')
            ->get()
            ->getResultArray();
        $existingDates = array_fill_keys(array_column($rows, 'task_date'), true);
        $today = Time::today();
        $createdAt = Time::now()->toDateTimeString();
        $seedRows = [];

        $requiredDates = [
            [$today->toDateString(), "Plan today's priorities"],
            [$today->subDays(1)->toDateString(), 'Review yesterday’s notes'],
            [$today->subDays(2)->toDateString(), 'Organize project files'],
        ];

        foreach ($requiredDates as [$date, $title]) {
            if (! isset($existingDates[$date])) {
                $seedRows[] = [
                    'title'      => $title,
                    'status'     => 'pending',
                    'task_date'  => $date,
                    'created_at' => $createdAt,
                ];
                $existingDates[$date] = true;
            }
        }

        $remaining = max(0, 8 - count($rows) - count($seedRows));
        $additionalTitles = [
            'Complete web systems reading',
            'Check upcoming task deadlines',
            'Prepare a weekly study plan',
            'Update project notes',
            'Review the task management pages',
            'Plan the next study session',
            'Organize the daily checklist',
            'Review completed work',
        ];

        for ($index = 0; $index < $remaining; $index++) {
            $seedRows[] = [
                'title'      => $additionalTitles[$index % count($additionalTitles)],
                'status'     => 'pending',
                'task_date'  => $today->toDateString(),
                'created_at' => $createdAt,
            ];
        }

        if ($seedRows !== []) {
            $this->db->table('tasks')->insertBatch($seedRows);
        }
    }

    private function replaceUsersWithDemo(): void
    {
        if (! $this->db->tableExists('users')) {
            throw new RuntimeException('The users table is missing. Run database migrations before seeding.');
        }

        if (! $this->db->tableExists('users_archive')) {
            $this->db->query('CREATE TABLE users_archive LIKE users');
        }

        if (! $this->db->fieldExists('email', 'users_archive')) {
            $this->db->query(
                "ALTER TABLE users_archive ADD COLUMN email VARCHAR(100) NOT NULL DEFAULT '' AFTER full_name"
            );
        }

        if (! $this->db->transBegin()) {
            throw new RuntimeException('Could not start a transaction for the demo user update.');
        }

        $archiveCopy = $this->db->query(
            'INSERT IGNORE INTO users_archive (id, username, full_name, email, created_at)
             SELECT id, username, full_name, email, created_at FROM users'
        );

        if ($archiveCopy === false || ! $this->db->transStatus()) {
            $this->db->transRollback();
            throw new RuntimeException('Could not copy live users into the archive.');
        }

        $archiveCheck = $this->db->query(
            'SELECT COUNT(*) AS count
             FROM users AS live
             LEFT JOIN users_archive AS archived ON archived.username = live.username
             WHERE archived.username IS NULL'
        );
        $missingArchivedUsers = $archiveCheck === false ? null : $archiveCheck->getRowArray();

        if ($missingArchivedUsers === null || (int) $missingArchivedUsers['count'] > 0) {
            $this->db->transRollback();
            throw new RuntimeException('Could not verify the users archive; live users were not replaced.');
        }

        $this->db->table('users')->emptyTable();
        $this->db->table('users')->insert([
            'username'   => 'demo_user',
            'full_name'  => 'Demo User',
            'email'      => 'demo@example.com',
            'created_at' => Time::now()->toDateTimeString(),
        ]);

        if (! $this->db->transStatus()) {
            $this->db->transRollback();
            throw new RuntimeException('Could not create the demo user.');
        }

        if ($this->db->table('users')->countAllResults() !== 1) {
            $this->db->transRollback();
            throw new RuntimeException('Could not create exactly one demo user.');
        }

        if (! $this->db->transCommit()) {
            throw new RuntimeException('Could not commit the demo user update.');
        }
    }
}
