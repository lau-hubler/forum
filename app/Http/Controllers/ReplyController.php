<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Thread $thread
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(Request $request, Thread $thread)
    {
        $request->validate([
            'body' => 'required',
            'thread_id' => 'required|exists:threads,id'
            ]);

        $thread->addReply(['body' => $request->body, 'user_id' => Auth::user()]);

        return redirect(route('threads.show', $thread));
    }

    /**
     * Display the specified resource.
     *
     * @param Reply $reply
     * @return Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Reply $reply
     * @return Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Reply $reply
     * @return Response
     */
    public function update(Request $request, Reply $reply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reply $reply
     * @return Response
     */
    public function destroy(Reply $reply)
    {
        //
    }
}
