<?php

namespace App\Http\Controllers\Training;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrainingRequest;
use App\Models\Training;
use App\Utils\GeminiAIClient;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class TrainingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $trainings = Training::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('training.index', compact('trainings'));
    }

    public function store(StoreTrainingRequest $request)
    {
        $training = new Training();
        $training->user_id = auth()->id();
        $training->type = $request->input('type', 'pdf');
        // "keywords" llega como string separado por comas. Normalizamos y guardamos como array (json column)
        $keywordsString = $request->input('keywords');
        if (is_string($keywordsString) && trim($keywordsString) !== '') {
            $normalized = collect(explode(',', $keywordsString))
                ->map(fn($kw) => (string)$kw)
                ->map(function ($kw) {
                    $kw = \Illuminate\Support\Str::ascii($kw);
                    $kw = mb_strtolower($kw);
                    $kw = preg_replace('/[^\p{L}\p{N}\s\-]/u', ' ', $kw);
                    $kw = trim(preg_replace('/\s+/', ' ', $kw));
                    return $kw;
                })
                ->filter(fn($kw) => strlen($kw) >= 2)
                ->unique()
                ->values()
                ->all();
            $training->keywords = $normalized; // se serializa a JSON gracias al cast en el modelo
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('uploads', 'public');
            $training->file_path = $filePath;
            $training->name = $file->getClientOriginalName();

            $mimeType = $file->getMimeType();

            try {
                if (Str::contains($mimeType, 'pdf')) {
                    $parser = new Parser();
                    $pdf = $parser->parseFile(storage_path('app/public/' . $filePath));
                    $text = $pdf->getText();
                    $training->learn = Str::limit($text, 65535);
                }
            } catch (\Exception $e) {
                Log::error('Error procesando archivo: ' . $e->getMessage());
                $training->learn = 'Error al procesar el archivo';
            }
        }

        $training->save();

        return redirect()->route('trainings.index')->with('success', 'Entrenamiento creado satisfactoriamente.');
    }

    public function destroy($id)
    {
        $training = Training::findOrFail($id);
        $training->delete();

        return redirect()->back()->with('success', 'Entrenamiento eliminado con éxito.');
    }
}
