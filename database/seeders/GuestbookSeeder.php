<?php

namespace Database\Seeders;

use App\Models\Guestbook;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuestbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["sender" => "John Doe", "message" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corrupti dolor debitis adipisci at expedita eius!", "date" => Carbon::parse("2025-09-23 09:30:00")],
            ["sender" => "Jane Doe", "message" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corrupti dolor debitis adipisci at expedita eius!", "date" => Carbon::parse("2025-09-23 12:30:00")],
            ["sender" => "Rico En", "message" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corrupti dolor debitis adipisci at expedita eius!", "date" => Carbon::parse("2025-09-23 10:30:00")]
        ];

        Guestbook::insert($data);
    }
}
