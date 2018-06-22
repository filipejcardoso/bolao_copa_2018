<?php
namespace App\Http\Controllers;
//-------------------------------------------------
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Participantes;
use App\Models\Jogos;
use App\Helpers\Rest;
use App\Helpers\Result;
use Response;
use Input;
//-------------------------------------------------
class JogosController extends Controller
{
    public function index(Request $request){
        try
        {

            $rest = new Rest();
            $rest->model = 'App\Models\Jogos';
            $rest->input = $request->toArray();

            $builder = $rest->getBuilder();
            // $builder->orderBy('ord','desc');
            $responseBd = $rest->getCollection('paginate', null);
            $result = $responseBd['result'];

            $response['records'] = [];
    
            foreach($responseBd['records'] as $j)
            {
                $jogo = json_decode($j);
                $jogo_aux['id'] = $jogo->id;
                $jogo_aux['status'] = $jogo->status;
                $jogo_aux['time1'] = $jogo->time1->sigla;
                $jogo_aux['time2'] = $jogo->time2->sigla;
                $jogo_aux['escore1'] = $jogo->escore1;
                $jogo_aux['escore2'] = $jogo->escore2;
                $jogo_aux['foto1'] = $jogo->time1->foto;
                $jogo_aux['foto2'] = $jogo->time2->foto;
                $jogo_aux['data'] = $jogo->data;

                array_push($response['records'], $jogo_aux);
            }
            
            $response['result'] = $result;

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
    public function update(Request $request, $id){
        $result = new Result();

        try
        {
            try
            {
                $recurso = Jogos::findOrFail($id);
                $newresource = $request->toarray();

                $rest = new Rest();
                $rest->model = 'App\Models\Jogos';
                $rest->input = $newresource;
                $rest->instance = $recurso;
                
                $response = $rest->renew();
                $result = $response['result'];

                return Response::json($response, $result->code);
            }

            catch(ModelNotFoundException $e)
            {
                $response = [];

                $result->setCode(404);
                $result->internalMessage = $e->getMessage();

                $response['result'] = $result;

                return Response::json($response, $response['result']->code);
            }
        }

        catch(ModelNotFoundException $e)
        {
            $response = [];

            $result->setCode(404);
            $result->internalMessage = $e->getMessage();

            $response['result'] = $result;

            return Response::json($response, $response['result']->code);
        }
    }
}