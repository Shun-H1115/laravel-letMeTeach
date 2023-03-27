<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("csvファイルを読み込んでいます...");

        $categorySplFileObject = new \SplFileObject(__DIR__ . '/data/categories.csv');
        $categorySplFileObject->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );

        $count = 0;
        foreach ($categorySplFileObject as $key => $row) {
            if ($key === 0) {
                continue;
            }

            Category::create([
                'category_L' => mb_convert_encoding(trim($row[0]), 'UTF-8', 'SJIS'),
                'category_S' => mb_convert_encoding(trim($row[1]), 'UTF-8', 'SJIS'),
            ]);
            $count++;
        }

        $this->command->info("カテゴリを{$count}件、作成しました。");
    }
}
