<?php

namespace App\Utils;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiAIClient
{
    public static function getInfoByImage($file, $type)
    {
        $apiKey = env('GEMINI_API_KEY');
        $model = env('GEMINI_MODEL', 'gemini-2.5-flash-preview-05-20');

        if (!$apiKey) {
            throw new \Exception('GEMINI_API_KEY no está configurada en .env');
        }

        // Leer y codificar la imagen
        $imageContent = file_get_contents($file->getRealPath());
        $base64Image = base64_encode($imageContent);
        $mimeType = $file->getMimeType();

        // Construir payload según el tipo
        $prompt = self::getPromptByType($type);

        $payload = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt],
                        [
                            'inline_data' => [
                                'mime_type' => $mimeType,
                                'data' => $base64Image
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

        try {
            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->timeout(60)
                ->post($url, $payload);

            $responseData = $response->json();

            if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
                return $responseData['candidates'][0]['content']['parts'][0]['text'];
            }

            Log::error('Error en respuesta de Gemini: ' . json_encode($responseData));
            return 'Error: No se pudo extraer texto de la imagen';
        } catch (\Exception $e) {
            Log::error('Error llamando a Gemini API: ' . $e->getMessage());
            return 'Error: Fallo en comunicación con API';
        }
    }

    private static function getPromptByType($type)
    {
        switch ($type) {
            case 'schedule':
                return "Por favor analiza esta imagen de horario universitario y extrae:
                1. Semestre (ej: 'II Semestre')
                2. Carrera (ej: 'Ingeniería en Informática')
                3. Periodo académico (ej: '2023-II-RG')
                4. Listado de clases con:
                   - Día de la semana
                   - Hora de inicio y fin
                   - Nombre de la materia
                   - Nombre del profesor
                   - Correo electrónico del profesor
                   - Teléfono del profesor (si está disponible)

                Organiza la información en un formato estructurado. Si algún dato no está disponible, indícalo como 'No disponible'.";

                // Agregar más tipos según sea necesario
            default:
                return "Por favor extrae el texto completo de esta imagen preservando el formato original.";
        }
    }
}
