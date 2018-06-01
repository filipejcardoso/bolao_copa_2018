<?php
namespace App\Http\Controllers;
//-------------------------------------------------
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Participantes;
use App\Models\Apostas;
use App\Helpers\Rest;
use App\Helpers\Result;
use Response;
use Input;
//-------------------------------------------------
class ApostasController extends Controller
{
    public function index(Request $request, $participante){
        try
        {
            Participantes::findOrFail($participante);

            $rest = new Rest();
            $rest->model = 'App\Models\Apostas';
            $rest->input = $request->toArray();
            $rest->relation = false;

            $builder = $rest->getBuilder();
            $builder = $builder->where('participante_id',$participante);

            $response = $rest->getCollection('paginate', null);
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
    public function update(Request $request, $participante, $id){
        $result = new Result();

        try
        {
            Participantes::findOrFail($participante);

            try
            {
                $recurso = Apostas::findOrFail($id);
                $newresource = $request->toarray();

                // dd($newresource);
                
                $rest = new Rest();
                $rest->model = 'App\Models\Apostas';
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