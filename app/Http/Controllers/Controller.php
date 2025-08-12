<?php

namespace App\Http\Controllers;
use App\Models\Diskusi;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    public function index()
    {
        $diskusi = Diskusi::with(['user', 'komentar.user'])->latest()->get();
        return view('diskusi.index', compact('diskusi'));
    }

    public function storeKomentar(Request $request, Diskusi $diskusi)
    {
        $request->validate([
            'teks' => 'required|string|max:1000'
        ]);

        Komentar::create([
            'diskusi_id' => $diskusi->id,
            'user_id' => Auth::id(),
            'teks' => $request->teks,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan');
    }
}
