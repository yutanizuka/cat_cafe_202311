<?php

namespace App\Http\Controllers;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactAdminMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    function sendMail(ContactRequest $request) {
        // $validated = $request->validate();

        // これ以降の行は入力エラーがなかった場合のみ実行されます
        // 登録処理(実際はメール送信などを行う)
        Mail::to('admin@example.com')->send(new ContactAdminMail());
        // Mail::to('admin@example.com')->send(new ContactAdminMail($validated));
        // Log::debug($validated['name']. 'さんよりお問い合わせがありました');
        return to_route('contact.complete');
    }

    public function complete()
    {
        return view('contact.complete');
    }
}
