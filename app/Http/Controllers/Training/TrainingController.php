<?php

namespace App\Http\Controllers\Training;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $trainigs = Training::where('userid', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('training.index', compact('trainigs'));
    }
}
