<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        // Old array syntax for Rector to catch
        $data = ['name' => 'John', 'age' => 30];

        // Weak typing for Larastan to catch
        $result = $this->calculate(10, '20');

        // Bad indentation & formatting for Pint/PHP_CodeSniffer to catch
        if ($result > 10) {
            return view('welcome', compact('data'));
        }

        return 'Done';
    }

    // Missing type declarations for Larastan
    public function calculate($a, $b)
    {
        return $a + $b;
    }
}
