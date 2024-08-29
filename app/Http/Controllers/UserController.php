<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index() {
        $allUser = User::all();

        $accessLevel = [
            '1' => 'Executive',
            '2' => 'Planning Director',
            '3' => 'Planning Officer',
            '4' => 'Agency Head',
            '5' => 'Agency Focal',
            '6' => 'User',
        ];

        $colorCode = [
            '1' => '#b8860b',
            '2' => '#708090',
            '3' => '#dc143c',
            '4' => '#008080',
            '5' => '#4b0082',
            '6' => 'black',
        ];
        return view('library.users.index', ['allUser' => $allUser, 'accessLevel' => $accessLevel, 'colorCode' => $colorCode]);
    }
    
    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'agency' => ['nullable'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'contact' => ['nullable'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['nullable', 'numeric'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'agency' => $request->agency,
            'email' => $request->email,
            'contact' => $request->contact,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect(route('user.index'));
    }

    /** 
    public function create() {
        return view('library.hnrda.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required'
        ]);

        $newHnrda = Hnrda::create($data);
        return redirect(route('hnrda.index'));
    }

    public function edit(Hnrda $hnrda){
        return view('library.hnrda.edit', ['hnrda' => $hnrda]);
    }

    public function update(Hnrda $hnrda, Request $request){
        $data = $request->validate([
            'title' => 'required'
        ]);

        $hnrda->update($data);

        return redirect(route('hnrda.index'));
    }

    public function destroy(Hnrda $hnrda){
        $hnrda->delete();
        return redirect(route('hnrda.index'));
    }
    
    **/
}
