<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Question;
use Faker\Generator as Faker;


$factory->define(Question::class, function (Faker $faker) {

    $type = $faker->numberBetween(1, 3);

    if (!function_exists('gg')) {
        function gg(Faker $faker, $type)
        {
            $singleChoice = ['A', 'B', 'C', 'D'];
            $multipleChoice = array_merge($singleChoice, ['E', 'F']);
            $options = [];
            $initAsciiNumber = 65;


            switch ($type) {
                case Question::SINGLE_CHOICE:
                    $answer = chr(rand(65, 68));
                    $options = array_map(function ($value) use (&$initAsciiNumber) {
                        $selectOptions = chr($initAsciiNumber);
                        $initAsciiNumber++;
                        return $selectOptions . ' ' . $value;
                    }, $faker->sentences(4));
                    break;
                case Question::JUDGE:
                    $answer = chr(rand(65, 66));
                    $options = ['对', '错'];
                    break;
                case Question::MULTIPLE_CHOICE:
                    $options = $faker->sentences(mt_rand(4, 6));
                    $answer = implode('', \Illuminate\Support\Arr::random($multipleChoice, mt_rand(1, count($options))));

                    array_walk($options, function (&$value, $index) use (&$initAsciiNumber) {
                        $selectOptions = chr($initAsciiNumber);
                        $value = $selectOptions . ' ' . $value;
                        $initAsciiNumber++;
                    });
                    break;
            }
            return [
                'answer' => $answer,
                'options' => $options
            ];
        }
    }


    $generator = gg($faker, $type);


    return [
        'title' => $faker->sentence,
        'answer' => $generator['answer'],
        'level' => $faker->numberBetween(1, 3),
        'type' => $type,
        'subject_id' => \App\Models\Subject::inRandomOrder()->first()->id,
        'options' => $generator['options']
    ];


});
