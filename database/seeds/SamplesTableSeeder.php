<?php

use Illuminate\Database\Seeder;

class SamplesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('samples')->insert([
            [
                "sample1" => "田中太郎",
                "sample2" => "男性",
                "sample3" => "あなたはほかとにかくその病気者というものの時を違えないた。",
                "created_at" => new DateTime(),
                "updated_at" => new DateTime()
            ],
            [
                "sample1" => "山田太郎",
                "sample2" => "男性",
                "sample3" => "おもに今を永続目は近頃この実在でしでだけがしのでしまったには反抗しゃべっうますて、こうにはやっつけですんんない。",
                "created_at" => new DateTime(),
                "updated_at" => new DateTime()
            ],
            [
                "sample1" => "佐藤花子",
                "sample2" => "女性",
                "sample3" => "双方に離れたのはさぞ今朝をまずますたない。",
                "created_at" => new DateTime(),
                "updated_at" => new DateTime()
            ],
            [
                "sample1" => "田中太郎",
                "sample2" => "男性",
                "sample3" => "あなたはほかとにかくその病気者というものの時を違えないた。",
                "created_at" => new DateTime(),
                "updated_at" => new DateTime()
            ],
            [
                "sample1" => "山田太郎",
                "sample2" => "男性",
                "sample3" => "おもに今を永続目は近頃この実在でしでだけがしのでしまったには反抗しゃべっうますて、こうにはやっつけですんんない。",
                "created_at" => new DateTime(),
                "updated_at" => new DateTime()
            ],
            [
                "sample1" => "佐藤花子",
                "sample2" => "女性",
                "sample3" => "双方に離れたのはさぞ今朝をまずますたない。",
                "created_at" => new DateTime(),
                "updated_at" => new DateTime()
            ],
        ]);
    }
}