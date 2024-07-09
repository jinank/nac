<?php

use App\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions=[
            ['title'=>'Voting should be made easy for everybody (multiple days, polling locations, voting methods).'],
            ['title'=>'Voting should be free for everybody (zero cost).'],
            ['title'=>'Felons should be able to vote.'],
            ['title'=>'Undocumented people should be able to vote.'],
            ['title'=>'Children should be able to vote.'],
            ['title'=>'There should be tax incentives for voting participation.'],
            ['title'=>'Ranked choice voting should be universal.'],
            ['title'=>'Legislative outcomes reflect the will of the people.'],
        ];
        foreach ($questions as $key => $value) {

            Question::create($value);
        }

    }
}
