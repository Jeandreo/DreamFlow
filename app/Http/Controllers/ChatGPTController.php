<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatGPTController extends Controller
{
    /**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    // Substitua 'YOUR_API_KEY' pela sua chave de API OpenAI
    $apiKey = '';

    // Dados da solicitação para enviar ao serviço ChatGPT
    $data = [
        'messages' => [
            ['role' => 'user', 'content' => 'Com relação a tarefa criar um site, quais seriam subtarefas intereessantes?']
        ],
        'model' => 'gpt-3.5-turbo', // Modelo de ChatGPT
        'max_tokens' => 500, // Máximo de tokens (palavras) para gerar na resposta
        'temperature' => 0.7, // Temperatura da amostra (quanto maior, mais diversificada a resposta)
        'stop' => ['\n'], // Parar a geração de tokens em nova linha
    ];

    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . $apiKey,
    ])->post('https://api.openai.com/v1/chat/completions', $data);

    // Verificar se a solicitação foi bem-sucedida
    if ($response->successful()) {
        $responseData = $response->json();
        $reply = $responseData['choices'][0]['message']['content']; // A resposta gerada pelo ChatGPT
        // Faça o que você quiser com a resposta, por exemplo, exibi-la
        echo $reply;
    } else {
        // Se a solicitação não foi bem-sucedida, exiba uma mensagem de erro
        echo 'Erro ao fazer a solicitação para o serviço ChatGPT';
    }
}

}
