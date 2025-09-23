<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Guestbook;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GuestbookController extends Controller
{
    public function index()
    {
        $gbooks = Guestbook::get();
        $carbon = new Carbon();

        return view('admin.guestbook.index', compact('gbooks', 'carbon'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sender' => 'required',
            'message' => 'required',
        ]);

        $gbook = new Guestbook();
        $gbook->sender = $request->sender;
        $gbook->message = $request->message;
        $gbook->date = Carbon::now();

        $gbook->save();

        return redirect()->route('product.index');
    }

    public function delete($id)
    {
        $gbook = Guestbook::find($id);

        // dd($gbook);

        $gbook->delete();

        return redirect()->route('admin.guestbook.index');
    }
}
