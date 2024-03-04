<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use SplFileObject;
use DateTime;
use Exception;

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
    $content = file_get_contents($file->getPathname());
    // Detect the current encoding of the CSV content
    $encoding = mb_detect_encoding($content, 'UTF-8, Windows-1251');

// Convert the CSV content to UTF-8 if it's not already in that encoding
    if ($encoding !== 'UTF-8') {
        $content = iconv($encoding, 'UTF-8', $content);
    }
    
    // Save the converted content back to the file
    file_put_contents($file->getPathname(), $content);
    
    // Open the file with the updated encoding

    $csv = new SplFileObject($file->getPathname(), 'r', false);
    $csv->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY);
    $delimiter = ',';
    if (strpos($csv, ';') !== false) {
        $delimiter = ';';
    }
    $csv->setCsvControl($delimiter, '"', '\\');
    $data = [];
    foreach ($csv as $row) {
        
        if (!is_bool(DateTime::createFromFormat('d.m.y', $row[2]))) {
            $birth_date = DateTime::createFromFormat('d.m.y', $row[2])->format('Y-m-d');
        } else {
            $timestamp = strtotime($row[2]);
            $birth_date = date('Y-m-d', $timestamp);
        }
        if (preg_match('/\d/', $row[0])) {
         try {
    $user = User::firstOrCreate([
        'name' => preg_split('/\s+/', $row[1])[0],
        'lname' => preg_split('/\s+/', $row[1])[1],
        'email' => "$row[1]@mail.ru",
        'password' => '',
        'phone_number' => "+$row[0]",
        'birth_date' => $birth_date
    ]);
} catch (\Illuminate\Database\QueryException $e) {
    if ($e->errorInfo[1] == 1062) { // MySQL error code for duplicate entry
        throw new Exception('Дублирующая запись');
    } else {
        throw $e; // Re-throw the exception if it's not a duplicate entry error
    }
}

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