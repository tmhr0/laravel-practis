<?php

namespace Database\Factories;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            '総務部',
            '人事部',
            '広報部',
            '法務部',
            '財務部',
            '商品開発部',
            '企画開発部',
            'マーケティング部',
            '情報システム部',
            '研究開発部',
            '営業部',
            '技術部',
        ];
        //ToDo ランダム登録（データ重複）
        $name = $names[rand(0, count($names) - 1)];

        return [
            'name' => $name,
            'company_id' => function () {
                return Company::query()->inRandomOrder()->first()->id;
            },
        ];
    }
}
