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
            ["category_id" => 1, "name" => "Paratusin", "price" => 19000, "description" => "obat untuk meringankan berbagai gejala flu seperti demam, hidung tersumbat, sakit kepala, bersin-bersin dan juga batuk.", "image" => "paratusin.jpg"],
            ["category_id" => 1, "name" => "Actifed Cough Sirup Merah", "price" => 74000, "description" => "Actifed Cough merupakan obat untuk meringankan gejala flu seperti hidung tersumbat dan bersin-bersin yang disertain batuk kering.", "image" => "actifed.jpg"],
            ["category_id" => 2, "name" => "Panadol Biru", "price" => 12000, "description" => "PANADOL BIRU TABLET 1 STRIP memiliki kandungan bahan aktif Paracetamol.", "image" => "panadolbiru.jpg"],
            ["category_id" => 1, "name" => "Rhinos Junior Sirup 60ml (per Botol)", "price" => 78000, "description" => "Rhinos Junior Sirup adalah obat flu anak yang efektif untuk meredakan gejala seperti bersin-bersin dan hidung tersumbat akibat pilek.", "image" => "rhinosjr.jpg"],
            ["category_id" => 2, "name" => "Vitacid 0.05% Sol 50ml (per Pcs)", "price" => 81000, "description" => "mengandung senyawa aktif asam retinoat yang digunakan untuk pengobatan jerawat.", "image" => "vitacid.png"],
            ["category_id" => 2, "name" => "Lacto B", "price" => 11000, "description" => "Lacto B Sachet merupakan probiotik dalam bentuk serbuk yang digunakan untuk mendukung kesehatan pencernaan.", "image" => "lactob.jpg"],
            ["category_id" => 3, "name" => "Benecheck Prime Cholesterol Strip", "price" => 260000, "description" => "strip untuk mengukur kadar kolesterol menggunakan sampel darah. Satu strip hanya dapat digunakan untuk satu orang dan satu kali penggunaan.", "image" => "benecek.jpg"],
            ["category_id" => 3, "name" => "Minyak Kayu Putih Lang 60ml (per Botol)", "price" => 24000, "description" => "Minyak kayu putih yang dapat memberikan rasa hangat, menjaga tubuh tetap hangat dan nyaman terutama pada saat cuaca dingin", "image" => "minyakputih.jpg"],
        ];
        Product::insert($data);
    }
}
