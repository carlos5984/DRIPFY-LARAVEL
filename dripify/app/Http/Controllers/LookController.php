<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Clothing;
use App\Models\Look;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        switch($looks[0]){
            case "connection error":
                return redirect()->route('look.formAddLook')->with('error', 'API currently unavailable, please try again later.');
            case "api error":
                return redirect()->route('look.formAddLook')->with('error', 'Something went wrong, please try again later.');
            default:
                break;
        }

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


        return redirect()->route('look.formAddLook')->with('success', 'Look gerado com sucesso!');
    }

    // Função privada para pegar descrição da IA
    private function generateLookWithAI($prompt)
    {
        $url = "127.0.0.1:8000/GenerateLook/" . Auth::id() . "?prompt=" . $prompt;
        try {
            $response = Http::get($url);
        } catch (ConnectionException $e) {
            return ['connection error', $e->getMessage()];
        }

        if (!$response->successful()) {
            return ['api error', $response->getStatusCode()];
        }

        $data = json_decode( $response->json() , true);


        return  $data;
    }

    public function index()
    {
        $looks =  DB::table('looks')
            // justa looks c clothing usando o id como referencia
            ->join('clothing', 'looks.clothing_id', '=', 'clothing.id')
            //filtra so pros looks do usuario
            ->where('looks.user_id', Auth::id())
            //pega os looks e o caminhos pras roupas do look
            ->select('looks.look_id', 'clothing.clothing_path')

            ->get()

            //agrupa todos os looks usando o id do look
            ->groupBy('look_id')
            //transforma num array associativo onde a chave e o look_id e o avlor é um array c os caminhos
            ->map(function ($items) {
                return $items->pluck('clothing_path');
            });

        return view('looks/lookList', compact('looks'));
        //        return view('clothing.index', compact('clothes'));
    }

    public function delete($look_id){
        $clothing = Look::where('look_id', $look_id)->where('user_id', Auth::id());
        $clothing->delete();

        return redirect()->route('look.index')->with('success', 'look deletada com sucesso!');
    }
}
