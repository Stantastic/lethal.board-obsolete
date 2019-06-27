<?php

use Illuminate\Database\Seeder;

use App\Forum;
use App\Category;
use App\Topic;
use App\User;
use App\Post;

class BoardDefaultsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'lethal.board', 'description' => 'You can categorize forums.', 'type' => 'category', 'order' => '1']);
        Category::create(['name' => 'lethal.board@GitHub', 'description' => 'Categories can also act as link!', 'type' => 'link', 'order' => '2', 'url' => 'https://github.com/Stantastic/lethal.board']);

        Forum::create(['name' => 'My Forum', 'description' => 'This is the first forum.', 'category' => '1', 'order' => '1']);

        Topic::create(['title' => 'Posting is easy as 1, 2, 3...', 'content' => 'Summernote is a really nice WYSIWYG editor!', 'forum' => '1', 'author' => '1']);

        Post::create(['content' => 'Also check the other open source projects used in this forum!', 'topic' => '1', 'author' => '1']);

        User::create(['display_name' => 'admin', 'email' => 'admin@lethal.board', 'password' => Hash::make('password')])->assignRole('root');

    }
}
