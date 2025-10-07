<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

use App\Models\Clothing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClothingController extends Controller
{
    // Mostra o formulário de criação


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
        $response = $this->getDescriptionFromAI($path);
        switch($response[0])
        {
            case "connection error":
                return redirect()->route('look.formAddLook')->with('error', 'API currently unavailable, please try again later.');

            case "api error":
                return redirect()->route('look.formAddLook')->with('error', 'Something went wrong, please try again later.');
            default:
                break;
        }
        $name = array_key_first($response);
        $description = $response[$name]['description'];

        // Criar roupa
        $clothing = new Clothing();
        $clothing->id = Str::uuid();
        $clothing->user_id = Auth::id();
        $clothing->clothing_name = $name; // Mantemos nome fixo
        $clothing->clothing_path = $path;
        $clothing->clothing_description = $description;
        $clothing->available = true;
        $clothing->save();

        return redirect()->route('clothing.create')->with('success', 'Roupa adicionada com sucesso!');
    }

    // Função privada para pegar descrição da IA
    private function getDescriptionFromAI($filePath)
    {
        $url = "127.0.0.1:8000/describe/" . basename($filePath); // ajusta para sua rota de IA
        try {
            $response = Http::get($url);
        } catch (ConnectionException $e) {
            return ["connection error", $e->getMessage()];
        }

        if (!$response->successful()) {
            return ["api error", $response->getStatusCode()];
        }

        $data = json_decode( $response->json() , true);


        return  $data;
    }

        public function index()
    {
        // Pegando só as roupas do usuário logado
        $user = auth()->user();
        $clothes = $user->clothes()->get();

        return view('clothing.index', compact('clothes'));
    }

        public function toggleAvailable(Clothing $clothing)
        {
            $clothing->available = !$clothing->available;
            $clothing->save();

            return back();
        }

        public function destroy($id)
        {
            $clothing = Clothing::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
            $clothing->delete();

            return redirect()->route('clothing.index')->with('success', 'Roupa deletada com sucesso!');
        }


}
