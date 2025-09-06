<?php

namespace App\Http\Controllers;

use App\Models\Princesas;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PrincesasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
        $registros = Princesas::all();
        $contador = $registros->count();
        if ($contador > 0) {
            return response( )->json([
                'success' => true,
                'message' => 'Princesas encontradas com sucesso!',
                'data' => $registros,
                'total' => $contador
            ], 200);
        } else {
            return response( )->json([
                'success' => false,
                'message' => 'Nenhuma princesa encontrada',
            ], 400);
        }
    }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         
        $validator = Validator::make($request->all( ), [
            'nome' => 'required',
            'idade' => 'required',
            'principe' => 'required',
            'ano_de_criacao' => 'required', 
        ]);
        if ($validator->fails()) {
            return response( )->json([
                'success' => false,
                'message' => 'Princesa invalida',
                'errors' => $validator->errors( )
            ], 400);
        }

    $registros = Princesas::create($request->all());
    if ($registros) {
        return response ( ) ->json([
            'successs' => true,
            'message' => 'Princesas cadastrada com sucesso!',
            'data' => $registros
        ], 201);
    } else {
        return response( )->json([
            'success' => false,
            'message' => 'Erro ao cadastar princesa'
        ], 500);
    
    }
}


    public function show($id)
    {
        $registros = Princesas::find($id);
        
        if($registros) {
            return response ( )->json([
                'success' => true, 
                'message' => 'Princesa encontrada com sucesso!',
                'data' => $registros    
            ], 200);
        }else {
            return response ( )->json([
                'success' =>false,
                'Message' => "Princesa não localizada.",
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id )
    {
        $validator = Validator::make($request->all( ),[
            'nome' => 'required',
            'idade' => 'required',
            'principe' => 'required',
            'ano_de_criacao' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'success'=> false,
                'message'=>'Registro inválido',
                'errors'=> $validator->erros()
            ], 400);
        }

        $registrosBanco = Princesas::find($id);

        if (!$registrosBanco) {
            return response() ->json([
                'success' => false,
                'message' => 'Princesa não encontrada'
            ], 404);
        }
        $registrosBanco->nome = $request ->nome;
        $registrosBanco->idade = $request->idade;
        $registrosBanco->principe = $request->principe;
        $registrosBanco->ano_de_criacao = $request->idade;

        if($registrosBanco->save()) {
            return response()->json([
                'success'=> true, 
                'message' => 'Princesa atualizada com sucesso!',
                'data' => $registrosBanco   
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar a princesa'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registros = Princesas::find($id);

        if (!$registros) {
            return response ()->json([
                'success' => false,
                'message' => 'Princesa não encontrada'
            ], 404);
        }
        if ($registros->delete()){
            return response()->json([
                'success' => true,
                'message' => 'Princesa deletada com sucesso!'
            ], 200);
        }
        return response ( )->json([
            'sucess' => false,
            'message'=> 'Erro ao deletar uma princesa'
        ], 500);
    }
}
