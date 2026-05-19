<?php

namespace Database\Seeders;

use App\Models\EzepostTracking;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoTrackingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Use existing admin user as sender
        $sender = User::where('email', 'admin@example.com')->first();

        // Use existing test user as receiver
        $receiver = User::where('email', 'test@example.com')->first();

        if (!$sender || !$receiver) {
            $this->command->error('Admin or test user not found. Please run the main seeder first.');
            return;
        }

        // Demo tracking data from old SQL file (sampled and transformed)
        $demoData = [
            [
                'file_name' => 'Rust.pdf',
                'file_size' => 1572864, // 1.5 MB
                'status' => 'viewed',
                'transferred_at' => '2022-09-28 07:28:37',
                'viewed_at' => '2022-09-28 07:28:01',
            ],
            [
                'file_name' => 'dsa.pdf',
                'file_size' => 1363148, // 1.3 MB
                'status' => 'viewed',
                'transferred_at' => '2022-09-28 11:42:41',
                'viewed_at' => null,
            ],
            [
                'file_name' => 'PowerShellNotesForProfessionals.pdf',
                'file_size' => 1782579, // 1.7 MB
                'status' => 'viewed',
                'transferred_at' => '2022-09-28 11:43:25',
                'viewed_at' => null,
            ],
            [
                'file_name' => 'ReactNativeNotesForProfessionals.pdf',
                'file_size' => 1363148, // 1.3 MB
                'status' => 'viewed',
                'transferred_at' => '2022-09-28 11:44:06',
                'viewed_at' => null,
            ],
            [
                'file_name' => 'PerlNotesForProfessionals.pdf',
                'file_size' => 1258291, // 1.2 MB
                'status' => 'viewed',
                'transferred_at' => '2022-09-28 11:45:28',
                'viewed_at' => null,
            ],
            [
                'file_name' => 'BashNotesForProfessionals.pdf',
                'file_size' => 1782579, // 1.7 MB
                'status' => 'viewed',
                'transferred_at' => '2022-09-28 11:46:12',
                'viewed_at' => null,
            ],
            [
                'file_name' => 'MySQLNotesForProfessionals.pdf',
                'file_size' => 1992294, // 1.9 MB
                'status' => 'viewed',
                'transferred_at' => '2022-09-28 11:47:03',
                'viewed_at' => null,
            ],
            [
                'file_name' => 'ReactJSNotesForProfessionals.pdf',
                'file_size' => 1048576, // 1 MB
                'status' => 'viewed',
                'transferred_at' => '2022-09-28 11:48:06',
                'viewed_at' => null,
            ],
            [
                'file_name' => 'TypeScriptNotesForProfessionals.pdf',
                'file_size' => 1153433, // 1.1 MB
                'status' => 'viewed',
                'transferred_at' => '2022-09-28 11:48:40',
                'viewed_at' => null,
            ],
            [
                'file_name' => 'KotlinNotesForProfessionals.pdf',
                'file_size' => 1048576, // 1 MB
                'status' => 'sent',
                'transferred_at' => '2022-09-28 12:07:29',
                'viewed_at' => null,
            ],
            [
                'file_name' => 'HTML5NotesForProfessionals.pdf',
                'file_size' => 1363148, // 1.3 MB
                'status' => 'sent',
                'transferred_at' => '2022-09-28 12:09:31',
                'viewed_at' => null,
            ],
            [
                'file_name' => 'SQLNotesForProfessionals.pdf',
                'file_size' => 1468006, // 1.4 MB
                'status' => 'sent',
                'transferred_at' => '2022-09-28 12:10:11',
                'viewed_at' => null,
            ],
            [
                'file_name' => 'EntityFrameworkNotesForProfessionals.pdf',
                'file_size' => 1572864, // 1.5 MB
                'status' => 'received',
                'transferred_at' => '2022-09-29 08:38:51',
                'viewed_at' => '2022-09-29 08:38:12',
            ],
            [
                'file_name' => 'VBANotesForProfessionals.pdf',
                'file_size' => 2306867, // 2.2 MB
                'status' => 'received',
                'transferred_at' => '2022-09-29 09:10:51',
                'viewed_at' => null,
            ],
        ];

        // Insert demo data
        foreach ($demoData as $index => $data) {
            EzepostTracking::create([
                'sender_user_id' => $sender->id,
                'receiver_user_id' => $receiver->id,
                'transfer_reference' => 'UID-' . (1664349945488 + $index),
                'direction' => 'sent',
                'file_count' => 1,
                'file_names' => [$data['file_name']],
                'file_name' => $data['file_name'],
                'file_path' => 'transfers/' . $data['file_name'],
                'file_size' => $data['file_size'],
                'package_size' => $data['file_size'],
                'status' => $data['status'],
                'is_viewed' => $data['status'] === 'viewed',
                'transferred_at' => $data['transferred_at'],
                'viewed_at' => $data['viewed_at'],
                'controlstring' => \Illuminate\Support\Str::random(20),
                'notify_recipient' => true,
                'require_password' => false,
                'track_download' => true,
                'expires_at' => now()->addDays(7),
            ]);
        }

        $this->command->info('Demo tracking data seeded successfully!');
    }
}
