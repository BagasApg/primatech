<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["category_id" => 1, "name" => "Walgreens Children's Pain & Fever Chewable Tablets Grape", "price" => 24000, "description" => "Lorem ipsum dolor sit amet.", "image" => "1.jpg"],
            ["category_id" => 1, "name" => "Hyland's Naturals Baby Mucus + Cold Relief Day/Night Value Pack", "price" => 43000, "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nostrum, itaque?", "image" => "2.jpg"],
            ["category_id" => 1, "name" => "Children's Mucinex Chest Congestion and Cough Suppressant Mini-Melts Orange Creme", "price" => 35000, "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel soluta sequi facere, explicabo animi ipsam?", "image" => "3.jpg"],
            ["category_id" => 2, "name" => "Walgreens Maximum Strength Daytime and Nighttime Severe Cold & Flu Caplets", "price" => 34000, "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel soluta sequi facere, explicabo animi ipsam?", "image" => "4.jpg"],
            ["category_id" => 2, "name" => "TYLENOL Cold + Flu Severe Day & Night Caplets Combo Pack", "price" => 24000, "description" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quaerat quis vel numquam.", "image" => "5.jpg"],
            ["category_id" => 2, "name" => "MucinexDM 12 Hour Expectorant & Cough Suppressant Tablets", "price" => 23500, "description" => "Lorem, ipsum dolor.", "image" => "6.jpg"],
            ["category_id" => 3, "name" => "Walgreens Arthritis Pain Relieving Gel, Diclofenac Sodium Gel 1%", "price" => 31000, "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat accusamus at voluptatum ea vitae.", "image" => "8.jpg"],
            ["category_id" => 3, "name" => "Cortizone 10 Maximum Strength Anti-Itch Liquid With Aloe", "price" => 14700, "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nostrum, itaque?", "image" => "9.jpg"],
        ];
        Product::insert($data);
    }
}
