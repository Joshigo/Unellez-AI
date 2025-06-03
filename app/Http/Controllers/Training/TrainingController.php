<?php

namespace App\Http\Controllers\Training;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrainingRequest;
use App\Models\Training;
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

        if ($request->hasFile('pdf')) {
            $pdfFile = $request->file('pdf');
            $pdfPath = $pdfFile->store('pdfs', 'public');
            $training->pdf_path = $pdfPath;
            $training->name = $pdfFile->getClientOriginalName();

            try {
                $parser = new Parser();
                $pdf = $parser->parseFile(storage_path('app/public/' . $pdfPath));
                $text = $pdf->getText();

                $training->learn = Str::limit($text, 65535);
            } catch (\Exception $e) {
                Log::error('Error procesando PDF: ' . $e->getMessage());
                $training->learn = 'Error al extraer texto del PDF';
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
