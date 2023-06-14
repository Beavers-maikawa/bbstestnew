<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\ContactToCommentRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Thread;
use App\Models\Comment;
use App\Mail\ContactSendmail;
use App\Mail\ContactCommentSendmail;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request)
    {
        $threads = Thread::with(['comments' => function ($query) {
            $query->orderBy('created_at', 'DESC');
        }])->select("*")->orderBy("created_at", "DESC")->paginate(5);

        //検索フォームで入力された値を取得する
        $search = $request->input('search');

        //クエリビルダ
        $query = Thread::query();

        if ($search) {
            $spaceConversion = mb_convert_kana($search, 's');
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            foreach ($wordArraySearched as $value) {
                $query->where(DB::raw('CONCAT(title,content,name)'), 'like', '%' . $value . '%');
                // $query = $query->whereHas('comments', function ($query) use ($value) {
                //     $query->where(DB::raw('CONCAT(title,commnet,name)'), 'like', '%' . $value . '%');
                // })->orWhere(function ($query) use ($value) {
                //     $query->where(DB::raw('CONCAT(title,content,name)'), 'like', '%' . $value . '%');
                // });
            }
            $threads = $query->orderBy('created_at', 'desc')->paginate(10);
        }
        //dd($threads);
        return view('index')->with([
            'threads' => $threads,
            'search' => $search,
        ]);
    }
    public function thread_store(Request $request)
    {
        $threads = new Thread();
        $threads->title = $request->title;
        $threads->name = $request->name;
        $threads->email = $request->email;
        $threads->content = $request->content;
        $threads->save();

        $request->session()->regenerateToken();

        return redirect(route('index'));
    }
    public function thread(Thread $thread)
    {
        $thread = Thread::where("id", $thread->id)->with(['comments' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])->firstOrFail();
        //dd($thread);
        return view('thread', ['thread' => $thread]);
    }
    public function comment_store(Request $request)
    {
        $comments = new Comment();
        $comments->thread_id = $request->thread_id;
        $comments->name = $request->name;
        $comments->email = $request->email;
        $comments->commnet = $request->comment;
        $comments->save();

        $request->session()->regenerateToken();

        return redirect(route('thread', ['thread' => $request->thread_id]));
    }
    public function sendMail(Thread $thread)
    {
        session()->put('toEmail', $thread->email);
        return view('contact', ['thread' => $thread]);
    }
    public function send(ContactRequest $contactRequest)
    {
        $contact = $contactRequest->all();
        $toEmail = session('toEmail');
        Mail::to($toEmail)->send(new ContactSendmail($contact));

        $contactRequest->session()->regenerateToken();

        return redirect(route('index'));
    }
    public function sendMailToComment(Comment $comment)
    {
        session()->put('toEmailComment', $comment->email);
        return view('contactcomment', ['comment' => $comment]);
    }
    public function sendComment(ContactToCommentRequest $contactToCommentRequest)
    {
        $contact = $contactToCommentRequest->all();
        $toEmailComment = session('toEmailComment');
        Mail::to($toEmailComment)->send(new ContactCommentSendmail($contact));

        $contactToCommentRequest->session()->regenerateToken();

        return redirect(route('index'));
    }
    public function delete_thread(Thread $thread){
        $threadId = $thread->id;
        $thread = Thread::where("id", $threadId)->firstOrFail();
        //dd($thread);
        $thread->delete();
        return redirect(route('index'));
    }
    public function delete_comment(Request $request)
    {
        $commentId = $request->comment_id;
        $comment = Comment::where("id", $commentId)->firstOrFail();
        $comment->delete();

        return redirect(route('thread', ['thread' => $request->thread_id]));
    }
}