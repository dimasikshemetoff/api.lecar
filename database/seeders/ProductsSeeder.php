<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                "articul" => $this->generateArticul(1),
                "title" => "Конкор 2.5мг",
                "category" => "Сердечные",
                "image" => "concor25.jpg",
                "manufactured" => "MERCK",
                "description" => "Конкор предназначен для сердца",
                "newprice" => 1000,
                "isfavorite" => false,
                "oldprice" => 1500
            ],
            [
                "articul" => $this->generateArticul(2),
                "title" => "Конкор 5мг",
                "category" => "Сердечные",
                "image" => "concor5.jpg",
                "manufactured" => "MERCK",
                "description" => "50 таблеток Конкор предназначен для сердца",
                "newprice" => 1200,
                "isfavorite" => false,
                "oldprice" => null
            ],
            [
                "articul" => $this->generateArticul(3),
                "title" => "Кардиол 5мг",
                "category" => "Сердечные",
                "image" => "cardiol5.jpg",
                "manufactured" => "Bayer",
                "description" => "30 таблеток для поддержки сердца",
                "newprice" => 1100,
                "isfavorite" => false,
                "oldprice" => null
            ],
            [
                "articul" => $this->generateArticul(4),
                "title" => "Бисопролол 5 мг",
                "category" => "Сердечные",
                "image" => "bisoprolol5.jpg",
                "manufactured" => "Pfizer",
                "description" => "50 таблеток, снижает давление",
                "newprice" => 1150,
                "isfavorite" => true,
                "oldprice" => 1300
            ],
            [
                "articul" => $this->generateArticul(5),
                "title" => "Корвитол 5 мг",
                "category" => "Сердечные",
                "image" => "corvitol5.jpg",
                "manufactured" => "Novartis",
                "description" => "40 таблеток, улучшает работу сердца",
                "newprice" => 1200,
                "isfavorite" => false,
                "oldprice" => null
            ],
            [
                "articul" => $this->generateArticul(6),
                "title" => "Биол 5 мг",
                "category" => "Сердечные",
                "image" => "biol5.jpg",
                "manufactured" => "Sanofi",
                "description" => "60 таблеток, стабилизирует пульс",
                "newprice" => 1000,
                "isfavorite" => true,
                "oldprice" => 1250
            ],
            [
                "articul" => $this->generateArticul(7),
                "title" => "Кардиосан 5 мг",
                "category" => "Сердечные",
                "image" => "cardiosan5.jpg",
                "manufactured" => "AstraZeneca",
                "description" => "50 таблеток, профилактика аритмии",
                "newprice" => 1200,
                "isfavorite" => false,
                "oldprice" => null
            ],
            [
                "articul" => $this->generateArticul(8),
                "title" => "Бисокард 5 мг",
                "category" => "Сердечные",
                "image" => "bisocard5.jpg",
                "manufactured" => "Teva",
                "description" => "30 таблеток, снижает нагрузку на сердце",
                "newprice" => 900,
                "isfavorite" => true,
                "oldprice" => 1100
            ],
            [
                "articul" => $this->generateArticul(9),
                "title" => "Нормокард 5 мг",
                "category" => "Сердечные",
                "image" => "normocard5.jpg",
                "manufactured" => "Gedeon Richter",
                "description" => "50 таблеток, нормализует давление",
                "newprice" => 1020,
                "isfavorite" => true,
                "oldprice" => 1200
            ],
            [
                "articul" => $this->generateArticul(10),
                "title" => "Кардиомагнил 5 мг",
                "category" => "Сердечные",
                "image" => "cardiomagnyl5.jpg",
                "manufactured" => "Takeda",
                "description" => "28 таблеток, профилактика тромбозов",
                "newprice" => 1200,
                "isfavorite" => false,
                "oldprice" => null
            ],
            [
                "articul" => $this->generateArticul(11),
                "title" => "Бисопролол-Тева 5 мг",
                "category" => "Сердечные",
                "image" => "bisoprolol-teva5.jpg",
                "manufactured" => "Teva",
                "description" => "50 таблеток, аналог Конкора",
                "newprice" => 1150,
                "isfavorite" => true,
                "oldprice" => 1400
            ],
            [
                "articul" => $this->generateArticul(12),
                "title" => "Кардионорм 5 мг",
                "category" => "Сердечные",
                "image" => "cardionorm5.jpg",
                "manufactured" => "KRKA",
                "description" => "30 таблеток, поддерживает сердце",
                "newprice" => 950,
                "isfavorite" => false,
                "oldprice" => null
            ],
            [
                "articul" => $this->generateArticul(13),
                "title" => "Бипрол 5 мг",
                "category" => "Сердечные",
                "image" => "biprol5.jpg",
                "manufactured" => "Stada",
                "description" => "50 таблеток, снижает риск инфаркта",
                "newprice" => 1100,
                "isfavorite" => true,
                "oldprice" => 1300
            ],
            [
                "articul" => $this->generateArticul(14),
                "title" => "Аритмокор 5 мг",
                "category" => "Сердечные",
                "image" => "aritmocor5.jpg",
                "manufactured" => "Egis",
                "description" => "40 таблеток, от аритмии",
                "newprice" => 1250,
                "isfavorite" => false,
                "oldprice" => 1500
            ],
            [
                "articul" => $this->generateArticul(15),
                "title" => "Кардиовит 5 мг",
                "category" => "Сердечные",
                "image" => "cardiovit5.jpg",
                "manufactured" => "Berlin-Chemie",
                "description" => "50 таблеток, укрепляет сердце",
                "newprice" => 1200,
                "isfavorite" => false,
                "oldprice" => null
            ],
            [
                "articul" => $this->generateArticul(16),
                "title" => "Бисогамма 5 мг",
                "category" => "Сердечные",
                "image" => "bisogamma5.jpg",
                "manufactured" => "Wörwag Pharma",
                "description" => "30 таблеток, контроль давления",
                "newprice" => 1050,
                "isfavorite" => true,
                "oldprice" => 1200
            ],
            [
                "articul" => $this->generateArticul(17),
                "title" => "Корданум 5 мг",
                "category" => "Сердечные",
                "image" => "cordanum5.jpg",
                "manufactured" => "Servier",
                "description" => "50 таблеток, улучшает кровообращение",
                "newprice" => 1300,
                "isfavorite" => false,
                "oldprice" => null
            ]
        ];

        DB::table('products')->insert($products);
    }

    /**
     * Генерирует артикул в формате 000001, 000002 и т.д.
     */
    private function generateArticul(int $number): string
    {
        return str_pad($number, 6, '0', STR_PAD_LEFT);
    }
}