<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Siswa;
use App\Pembayaran;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $siswa = Siswa::all();
        $user = User::all();
        $data = [
            'user' => User::find(auth()->user()->id),
            'pembayaran' => Pembayaran::orderBy('id', 'desc')->paginate(3),

        ];

        return view('dashboard.index',$data ,compact('siswa','user',));
      }
}
