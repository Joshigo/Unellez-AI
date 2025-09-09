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

        $imageContent = file_get_contents($file->getRealPath());
        $base64Image = base64_encode($imageContent);
        $mimeType = $file->getMimeType();

        $prompt = self::getPromptByType($type);
        $prompt .= "\nNo me retornes la información con comillas, apóstrofes, o algo que me dañe el template string. ni con un texto que diga algo como 'Respuesta:
            ' o 'Respuesta:'. Solo dame la información que te pido. tampoco me des la información en formato JSON, dame la información de forma natural,
            como si me la estuvieras diciendo a mí, no como si fuera un robot.
            No me des la información en formato de lista, ni con guiones, ni con números, ni con viñetas. Dame la información de forma natural, como si me la estuvieras diciendo a mí.";
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
                2. Periodo académico (ej: '2023-II-RG')
                3. Dame toda la información completa y detallada de cada curso en el horario, incluyendo:
                   - Código del curso
                   - Nombre del curso
                   - Créditos
                   - Tipo (obligatorio, electivo, etc.)
                   - Grupo
                   - Horario (días y horas)
                   - Aula
                   - Profesor(es)

                Organiza la información en un formato estructurado. Si algún dato no está disponible, indícalo como 'No disponible'.";

            default:
                return "Por favor extrae el texto completo de esta imagen preservando el formato original.";
        }
    }
}
