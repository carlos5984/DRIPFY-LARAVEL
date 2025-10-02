<?php

namespace App\Http\Controllers;

use App\Models\Clothing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClothingController extends Controller
{
    // Mostra o formulário de criação
    public function create()
    {
        return view('clothing.create'); // view: resources/views/clothing/create.blade.php
    }

    // Salva a roupa no banco
    public function store(Request $request)
    {
        // Validação básica
        $request->validate([
            'clothing_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload da imagem
        $path = $request->file('clothing_path')->store('images', 'public');

        // Obter descrição da IA
        $description = $this->getDescriptionFromAI($path);

        // Criar roupa
        $clothing = new Clothing();
        $clothing->id = Str::uuid();
        $clothing->user_id = Auth::id();
        $clothing->clothing_name = 'Roupa Automática'; // Mantemos nome fixo
        $clothing->clothing_path = $path;
        $clothing->clothing_description = $description;
        $clothing->available = true;
        $clothing->save();

        return redirect()->route('clothing.create')->with('success', 'Roupa adicionada com sucesso!');
    }

    // Função privada para pegar descrição da IA
    private function getDescriptionFromAI($filePath)
    {
        $url = url("describe/" . basename($filePath)); // ajusta para sua rota de IA
        $response = @file_get_contents($url);

        if (!$response) {
            return 'Descrição automática';
        }

        $data = json_decode($response, true);
        $clothingName = array_key_first($data);

        return $data[$clothingName]['description'] ?? 'Descrição automática';
    }
}
