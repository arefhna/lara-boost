<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Carbon\Carbon;

class BoostPosts extends Command
{
    protected $signature = 'boost:posts';
    protected $description = 'Boosted elanları 8 saatdan bir irəli çəkir';

    public function handle()
    {
        $now = Carbon::now();

        $boosted = Post::where('is_boosted', true)
            ->where('boost_start_at', '<=', $now)
            ->where('boost_end_at', '>=', $now)
            ->get();

        foreach ($boosted as $post) {
            if ($post->last_boosted_at === null || $post->last_boosted_at->diffInHours($now) >= 8) {
                $post->touch();
                $post->last_boosted_at = $now;
                $post->save();
                $this->info("Post ID {$post->id} irəli çəkildi.");
            }
        }

        Post::where('is_boosted', true)
            ->where('boost_end_at', '<', $now)
            ->update([
                'is_boosted' => false,
                'boost_start_at' => null,
                'boost_end_at' => null,
                'last_boosted_at' => null,
            ]);
    }
}
