<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['レストラン', 'カフェ', 'キャンプ', 'ドッグラン', 'ドッグスクール', 'ペットホテル', '海', '公園・広場'];
        foreach ($tags as $tag) App\Tag::create(['name' => $tag]);
    }
}
