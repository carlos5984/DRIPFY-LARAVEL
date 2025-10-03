<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Clothing;
use App\Models\Look;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class LookController extends Controller
{


    // Salva a roupa no banco
    public function store(Request $request)
    {
        // Validação básica
        $request->validate([
            'lookPrompt' => 'required',
        ]);

        // Upload da imagem
        $prompt = $request->lookPrompt;

        // Obter descrição da IA
        $looks = $this->generateLookWithAI($prompt);

        $look_id = Str::uuid()->toString();

        // Criar roupa
        foreach($looks as $clothingid) {
            $lookEntity = new Look();
            $lookEntity->id = Str::uuid()->toString();
            $lookEntity->look_id = $look_id;
            $lookEntity->user_id = Auth::id();
            $lookEntity->clothing_id = $clothingid;
            $lookEntity->tag = NULL;
            $lookEntity->save();
        }


        return redirect()->route('look.formAddLook')->with('success', 'Roupa adicionada com sucesso!');
    }

    // Função privada para pegar descrição da IA
    private function generateLookWithAI($prompt)
    {
        $url = "127.0.0.1:8000/GenerateLook/" . Auth::id() . "?prompt=" . $prompt;
        try {
            $response = Http::get($url);
        } catch (ConnectionException $e) {
            return "CONNECTION FAILED \n " . $e->getMessage();
        }

        if (!$response->successful()) {
            return 'DESCRIPTION NOT GENERATED';
        }

        $data = json_decode( $response->json() , true);


        return  $data;
    }

    public function index()
    {
    }
}
