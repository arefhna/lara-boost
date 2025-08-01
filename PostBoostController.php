<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class PostBoostController extends Controller
{
    public function boost(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        $post = Post::findOrFail($request->post_id);
        $now = Carbon::now();

        $post->is_boosted = true;
        $post->boost_start_at = $now;
        $post->boost_end_at = $now->copy()->addHours(24);
        $post->last_boosted_at = $now->copy()->subHours(8);
        $post->touch();
        $post->save();

        return redirect()->back()->with('success', 'Elan 24 saatlıq irəli çəkmə ilə aktiv edildi!');
    }
}
