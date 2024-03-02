<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use SplFileObject;
use DateTime;

class UserController extends Controller
{
    public function create()
    {
        $created_users = User::all();
        return view('welcome', compact(['created_users']));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('csv')) {
            $file = $request->file('csv');
            $csv = new SplFileObject($file->getPathname());
            $csv->setFlags(SplFileObject::READ_CSV);

            $data = [];
            foreach ($csv as $row) {
                if (preg_match('/\d/', $row[0])) {
                    $user = User::firstOrCreate(
                        [
                            'name' => preg_split('/\s+/', $row[1])[0],
                            'lname' => preg_split('/\s+/', $row[1])[1],
                            'email' => "$row[1]@mail.ru",
                            'password' => '',
                            'phone_number' => "+$row[0]",
                            'birth_date' => DateTime::createFromFormat('d.m.y', $row[2])->format('Y-m-d')
                        ]
                    );
                }
            }
        } else {
            $user = User::firstOrCreate(
                [
                    'name' => $request->input('name'),
                    'lname' => $request->input('lname'),
                    'email' =>  $request->input('email'),
                    'password' =>  $request->input('password'),
                    'phone_number' => $request->input('phone_number'),
                    'birth_date' => $request->input('birth_date')
                ]
            );
        }


        return redirect()->route('welcome')->with('success', 'User created successfully');
    }
}
