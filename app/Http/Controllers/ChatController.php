<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // TAMPIL CHAT
    public function index()
    {
        $chat = Chat::latest()->get();

        return view('chat.index', compact('chat'));
    }

    // KIRIM CHAT
    public function store(Request $request)
    {
        Chat::create([

            'nama_pengirim' => $request->nama_pengirim,

            'role' => $request->role,

            'pesan' => $request->pesan,

        ]);

        return back();
    }
}