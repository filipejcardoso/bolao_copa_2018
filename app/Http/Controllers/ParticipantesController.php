<?php
namespace App\Http\Controllers;
//-------------------------------------------------
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Participantes;
use App\Models\Jogos;
use App\Models\Apostas;
use App\Helpers\Rest;
use App\Helpers\Result;
use App\Helpers\Helper;
use Response;
use Input;
use Illuminate\Support\Collection;
//-------------------------------------------------
class ParticipantesController extends Controller
{

    public function index(Request $request){
        $rest = new Rest();
        $rest->model = 'App\Models\Participantes';
        $rest->input = $request->toArray();

        $builder = $rest->getBuilder();
        $responseBd = $rest->getCollection('paginate', null);
        $result = $responseBd['result'];

        $classificacao = [];

        $participante = [];
        foreach($responseBd['records'] as $p)
        {
            $participante['id'] = $p['id'];
            $participante['nome'] = $p['nome'];
            $participante['p'] = 0;
            $participante['pc'] = 0;
            $participante['pv'] = 0;
            $participante['pp'] = 0;
            $participante['av'] = 0;

            foreach($p['aposta'] as $aposta)
                if( $aposta['jogo']['status']>0)
                {
                    //PONTOS
                    $participante['p'] = $participante['p'] + $this->getPontos($aposta['escore1'], $aposta['escore2'], $aposta['jogo']['escore1'], $aposta['jogo']['escore2']);

                    //DESEMPATE
                    //placar em cheio
                    if($aposta['escore1'] == $aposta['jogo']['escore1'] && $aposta['escore2'] == $aposta['jogo']['escore2'])
                        $participante['pc']++;
                    
                    //escore dos vencedores
                    if(($aposta['jogo']['escore1'] > $aposta['jogo']['escore2']) && $aposta['escore1'] == $aposta['jogo']['escore1'])
                        $participante['pv']++;
                    else if(($aposta['jogo']['escore2'] > $aposta['jogo']['escore1']) && $aposta['escore2'] == $aposta['jogo']['escore2'])
                        $participante['pv']++;

                    //escore dos perdedores
                    if(($aposta['jogo']['escore1'] < $aposta['jogo']['escore2']) && $aposta['escore1'] == $aposta['jogo']['escore1'])
                        $participante['pp']++;
                    else if(($aposta['jogo']['escore2'] < $aposta['jogo']['escore1']) && $aposta['escore2'] == $aposta['jogo']['escore2'])
                        $participante['pp']++;

                    //acerto vencedores
                    if($aposta['escore1']>$aposta['escore2'] && $aposta['jogo']['escore1'] > $aposta['jogo']['escore2'])
                        $participante['av']++;
                    else if($aposta['escore1']<$aposta['escore2'] && $aposta['jogo']['escore1'] < $aposta['jogo']['escore2'])
                        $participante['av']++;
                }

            array_push($classificacao, $participante);
        }

        $cSort = Helper::sortCollectionDesc($classificacao, ['p','pc','pv','pp','av']);
        $response['records'] = $cSort;
        $response['result'] = $responseBd['result'];

        return Response::json($response, $result->code);
	}
//-------------------------------------------------
    public function show(Request $request, $id){
        $responseBd = Participantes::with('aposta.jogo.time1','aposta.jogo.time2')->find($id);

        $participante['nome'] = $responseBd['nome'];
        $participante['apostas'] = [];

        foreach($responseBd['aposta'] as $a)
        {
            $jogo = json_decode($a['jogo']);
            $aposta['id'] = $a['id'];
            $aposta['time1'] = $jogo->time1->sigla;
            $aposta['time2'] = $jogo->time2->sigla;
            $aposta['escore1'] = $a['escore1'];
            $aposta['escore2'] = $a['escore2'];
            $aposta['foto1'] = $jogo->time1->foto;
            $aposta['foto2'] = $jogo->time2->foto;
            $aposta['data'] = $jogo->data;
            
            /* 
            STATUS DA APOSTA

             0 - Jogo Pendente
             1 - 0 Pontos
             2 - 10 Pontos
             3 - 25 Pontos
            */
            
            $aposta['status'] = 0;

            if($jogo->status > 0)
            {
                $pontos = $this->getPontos($a['escore1'], $a['escore2'], $jogo->escore1, $jogo->escore2);
                
                if($pontos == 25)
                    $aposta['status'] = 3;   
                else if($pontos == 10)
                    $aposta['status'] = 2;   
                else if($pontos == 0)
                    $aposta['status'] = 1;   
            }

            array_push($participante['apostas'], $aposta);
        }

        $response['records'] = $participante;

        $result = new Result();
        $result->internalMessage = "Apostas carregadas";
        $result->setCode(200);

        $response['result'] = $result;

        return Response::json($response, $result->code);
    }
    public function getPontos($aposta1,$aposta2,$jogo1,$jogo2)
    {
        if($aposta1 == $jogo1 && $aposta2 == $jogo2)
            return 25;
        else if($aposta1>$aposta2 && $jogo1 > $jogo2)
            return 10;
        else if($aposta1<$aposta2 && $jogo1 < $jogo2)
            return 10;
        else if($aposta1==$aposta2 && $jogo1 == $jogo2)
            return 10;
        else
            return 0;
    }
//-------------------------------------------------
public function store(Request $request){
    $recurso = new Participantes();
    $newresource = $request->toarray();
    
    $rest = new Rest();
    $rest->model = 'App\Models\Participantes';
    $rest->input = $newresource;
    $rest->instance = $recurso;

    $response = $rest->insert();
    $result = $response['result'];

    $id = $response['records']['id'];
    $jogos = Jogos::all();

    foreach($jogos as $jogo)
    {
        $aposta  = new Apostas();

        $aposta->participante_id = $id;
        $aposta->jogo_id = $jogo->id;

        $aposta->save();
    }

    return Response::json($response, $result->code);
}
//-------------------------------------------------
public function update(Request $request, $id){ 
    try
    {
        $recurso = Participantes::findOrFail($id);
        $newresource = $request->toarray();
        
        $rest = new Rest();
        $rest->model = 'App\Models\Participantes';
        $rest->input = $newresource;
        $rest->instance = $recurso;
        
        $response = $rest->renew();
        $result = $response['result'];

        return Response::json($response, $result->code);
    }

    catch(ModelNotFoundException $e)
    {
        $response = [];

        $result = new Result();
        $result->setCode(404);
        $result->internalMessage = $e->getMessage();

        $response['result'] = $result;

        return Response::json($response, $response['result']->code);
    }
}
//-------------------------------------------------
public function destroy($id){
    $result = new Result();
    $response = [];

    try
    {
        $recurso = Participantes::findOrFail($id);
        $recurso->delete();
            
        $result->setCode(200);
        $result->internalMessage = 'Record deleted successfully';

        $response['result'] = $result;

        return Response::json($response, $response['result']->code);
    }

    catch(ModelNotFoundException $e)
    {
        $result->setCode(404);
        $result->internalMessage = $e->getMessage();

        $response['result'] = $result;


        return Response::json($response, $response['result']->code);
    }

    catch (Exception $e)
    {
        $result->setCode(500);
        $result->internalMessage = $e->getMessage();

        $response['result'] = $result;

        return Response::json($response, $response['result']->code);
    }
}
}