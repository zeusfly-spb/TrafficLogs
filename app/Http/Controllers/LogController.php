<?php

namespace App\Http\Controllers;

use App\Models\trafficLog;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * @param Request $request
     * @return void
     * Запись логов в БД
     */
    public function store(Request $request)
    {
        trafficLog::create([
            'message' => $request->input('message')
        ]);
    }
}
