<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FetchUserData extends Command
{
    protected $signature = 'fetch:userdata';
    protected $description = 'Fetch user data from reqres.in API and store it in the database';

    private $apiUrl = 'https://reqres.in/api/users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $page = 1;
        $totalPages = 1;

        do {
            $response = Http::get($this->apiUrl, ['page' => $page]);

            if ($response->successful()) {
                $data = $response->json();
                $this->storeData($data['data']);

                // Update totalPages based on the API response
                $totalPages = $data['total_pages'];
                $page++;
            } else {
                $this->error('Failed to fetch data from API');
                break;
            }
        } while ($page <= $totalPages);

        $this->info('Data fetching complete.');
    }

    private function storeData($users)
    {
        foreach ($users as $userData) {
            if (isset($userData['email'], $userData['first_name'], $userData['last_name'])) {
                $fullName = $userData['first_name'] . ' ' . $userData['last_name'];
                User::updateOrCreate(
                    ['email' => $userData['email']],
                    [
                        'name' => $fullName,
                        'password' => bcrypt('defaultpassword'),
                        'avatar' => $userData['avatar'],
                    ]
                );

                Log::info('User stored/updated', ['email' => $userData['email'], 'avatar' => $userData['avatar']]);
            } else {
                Log::warning('Missing required user data', ['userData' => $userData]);
            }
        }
    }
}
