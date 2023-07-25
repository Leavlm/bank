<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class transactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Achat alimentaire',
            'Facture d\'électricité',
            'Essence',
            'Restaurant',
            'Shopping',
            'Voyage',
            'Salaire',
            'Loyer',
            'Assurance',
            'Divertissement',
            'Remboursement',
            'Cadeaux',
        ];

        for ($i = 0; $i < 1000; $i++) {
            $category = $this->getRandomCategory($categories);
            $amount = $this->getRandomAmountForCategory($category);
            DB::table('transactions')->insert([
                'name' => $category,
                'amount' => $amount,
                'date_transaction' => $this->getRandomDate(),
            ]);
        }
    }

    private function getRandomCategory(array $categories)
    {
        return $categories[array_rand($categories)];
    }

    private function getRandomAmountForCategory($category)
    {
        // Define the category-amount mapping based on your desired logic
        $categoryAmounts = [
            'Achat alimentaire' => rand(-20000, -500) / 100,
            'Facture d\'électricité' => rand(-5000, -200) / 100,
            'Essence' => rand(-3000, -100) / 100,
            'Restaurant' => rand(-10000, -300) / 100,
            'Shopping' => rand(-50000, -1000) / 100,
            'Voyage' => rand(-100000, -5000) / 100,
            'Salaire' => rand(50000, 100000) / 100,
            'Loyer' => rand(-50000, -2000) / 100,
            'Assurance' => rand(-10000, -500) / 100,
            'Divertissement' => rand(-20000, -1000) / 100,
            'Remboursement' => rand(1000, 50000) / 100,
            'Cadeaux' => rand(-5000, -100) / 100,
        ];

        return $categoryAmounts[$category] ?? 0; // If category not found in the mapping, use 0 as the default amount
    }

    private function getRandomDate()
    {
        $startDate = strtotime('-1 year');
        $endDate = time();
        return date('Y-m-d H:i:s', rand($startDate, $endDate));
    }
}