<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(rand(3,8),true);
        $txt =  $this->faker->realText(rand(1000,4000));
        $isPublished = rand(1,5) > 1;

        return [
            'category_id' => rand(1,11),
            'user_id' => rand(1,5) == 5 ? 1 : 2,
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->text(rand(40,100)),
            'content_raw' => $txt,
            'content_html' => $txt,
            'is_published' => $isPublished,
            'published_at' => $isPublished ? $this->faker->dataTimeBetween('-2 months','-1 days') : null,
        ];
    }
}
