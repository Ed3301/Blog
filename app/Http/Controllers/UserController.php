<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\FollowNotification;
use App\Notifications\UnfollowNotification;


class UserController extends Controller
{
    public function userPosts($id)
    {
    	$user = User::with('posts')->find($id);

    	$posts = $user->posts()->orderBy('created_at', 'desc')->paginate(4);

    	return view('posts.user-posts', compact('user', 'posts'));
    }

    public function userCountry($id)
    {
    	$country = Country::where('id', $id)->with('posts')->first();

        $posts = $country->posts()->orderBy('created_at', 'desc')->paginate(4);

    	return view('posts.user-country', compact('country', 'posts'));
    }

    public function follow($id)
    {

        Auth::user()->follows()->attach($id);

        $user = User::find($id);

        //$user->notify(new FollowNotification(Auth::user()->name));

        return redirect()->back();
    }

    public function unfollow($id)
    {
        Auth::user()->follows()->detach($id);

        $user = User::find($id);

        //$user->notify(new UnfollowNotification(Auth::user()->name));

        return redirect()->back();
    }

    public function showFollows()
    {

    $auth_id = auth()->id();

    $user = User::where('id', $auth_id)->first();

    $follows_id_list = $user->follows_id->push($auth_id)->toArray();

    $posts = Post::whereIn('user_id', $follows_id_list)->orderBy('created_at', 'desc')->paginate(4);
       
        return view('posts.followedUsersPosts', compact('posts'));
    }
}
