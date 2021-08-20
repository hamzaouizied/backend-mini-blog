<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllPosts()
    {
        try {
            $posts = Post::orderBy('created_at', 'desc')->paginate(6);
            return response()->json([
                'posts' => $posts,
                'status' => 200,
            ], 200);
        } catch (RouteNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPost(Request $request)
    {
        try {
            $post = Post::where('id', '=', $request->id)->with('comment')->get();
            return response()->json([
                'post' => $post,
                'status' => 200,
            ], 200);
        } catch (RouteNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addComment(Request $request)
    {
        $request->validate([
            'comment' => 'required|max:255'
        ]);

        try {

            $comment = Comment::create([
                'content' => $request->comment,
                'user_id' => $request->idUser,
                'post_id' => $request->id,
            ]);


            return response()->json([
                'data' => $comment,
                'status' => 200,
            ], 200);
        } catch (RouteNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPost(Request $request)
    {
        $request->validate([
            'title'   => 'required|unique:posts|max:255',
            'body'    => 'required',
        ]);

        try {
             Post::create([
                'title'   => $request->title,
                'content' => $request->body,
                'picture' => 'https://source.unsplash.com/random/200x200?sig=1',
                'user_id' => $request->userId,
            ]);

            return response()->json([
                'data'   => 'successfully added',
                'status' => 200,
            ], 200);
        } catch (RouteNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePost(Request $request)
    {
        try {
            $post = Post::find($request->id);
            $post->comment()->delete();
            $post->delete();
            return response()->json([
                'data' => 'Post deleted',
                'status' => 200,
            ], 200);
        } catch (RouteNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteComment(Request $request)
    {
        try {
            Comment::where('id', $request->id)->delete();
            return response()->json([
                'data' => 'comment deleted',
                'status' => 200,
            ], 200);
        } catch (RouteNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
