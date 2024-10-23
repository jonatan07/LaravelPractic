<?php
namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Models\School;
use Exception;

class SchoolController extends Controller
{
    /**
     *   @OA\get
     *     (
     *     path="/api/school",
     *     summary="Obtener lista de colegios",
     *     tags={"Colegio"},
     *     @OA\Parameter(
     *         in="query",
     *         name="name",
     *         required=false
     *      ),
     *      @OA\Parameter(
     *         in="query",
     *         name="description",
     *         required=false
     *      ),
     *     
     *     @OA\Response(
     *         response=200,
     *         description="Una lista de profesores"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     )
     *  )
    */
     public function getAll(Request $request)
     {
 
         $schools =School::name($request->name)->description($request->description)->get();
         
         if($schools->isEmpty())
         {
             return response()->json(['message'=>'No hay escuelas'],404);
         }
         return response()->json($schools,200);
     }
    /**
     *   @OA\get
     *     (
     *     path="/api/school/classroom/{id}",
     *     summary="Obtener lista de aulas en el colegio",
     *     tags={"Colegio"},
     *     @OA\Parameter(
      *         in="path",
      *         name="id",
      *         required=true
      *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Una lista de aulas"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     )
     *  )
    */
     public function getAllClassroom($id)
     {
        //return "hola";
        /*
            try{
        */
            //throw new Exception("Se jodio");
            $classrooms = School::find($id)->classroom;
        /*    
            }
            catch(Exception $e)
            {
                throw $e;
                
                return response() -> json(
                    [
                        'success'=> false,
                        'message'=> 'Ocurrio un error, comuniquese con su Administrador',
                        'error' => $e->getMessage()
                    ],500
                );
                
            }
        */
        if(!$classrooms)
        {
            return response()->json(['message'=>'No hay aulas'],404);
        }
         return response()->json($classrooms,200); 
     }
     /**
      *   @OA\get
      *     (
      *     path="/api/school/{id}",
      *     summary="Obtener un escuelas",
      *     tags={"Colegio"},
      *     @OA\Parameter(
      *         in="path",
      *         name="id",
      *         required=true
      *      ),
      *     @OA\Response(
      *         response=200,
      *         description="Una estudiante"
      *     ),
      *     @OA\Response(
      *         response="default",
      *         description="Ha ocurrido un error"
      *     )
      *  )
      */
     public function get($id)
     {
         $schools = School::find($id);
         if(!$schools)
         {
             return response()->json(['message'=>'No hay escuelas'],404);
         }
         return response()->json($schools,200);
     }
     /**
      *   @OA\post
      *     (
      *     path="/api/school",
      *     summary="crear una escuela",
      *     tags={"Colegio"},
      *     @OA\RequestBody(
      *         required=true,
      *         description="Datos necesarios para crear una escuela",
      *         @OA\JsonContent(
      *             required={"name", "description"},
      *             @OA\Property(property="name", type="string", example="Gregorio luperon"),
      *             @OA\Property(property="description", type="string", example="Escuela publica"),
      *         )
      *     ),
      *     @OA\Response(
      *         response=200,
      *         description="Crea un estudiante"
      *     ),
      *     @OA\Response(
      *         response="default",
      *         description="Ha ocurrido un error"
      *     )
      *  )
      */
     public function create(Request $request)
     {
        /*
            $rule = StudentValidator::Valid($request);
         
            if(!$rule['isValid'])
            {
                $data = [
                    'error'=> $rule['error'],
                    'status'=> 422
                ];
                return response()->json($data,422);
         }
        */
       
        $school = School::create([
             'name' => $request->name,
             'description'=> $request->description
        ]);
        if(!$school)
        {
            $data = [
                 'message'=> 'Error al crear una escuela',
                 'status'=> 500
            ];
            return response()->json($data,500);
        }
 
        $data = [
             'student'=> $school,
             'status'=> 201
        ];
 
        return response()->json($data,201);
     }
     /**
      *   @OA\delete
      *     (
      *     path="/api/school/{id}",
      *     summary="eliminar un escuela",
      *     tags={"Colegio"},
      *     @OA\Parameter(
      *         in="path",
      *         name="id",
      *         required=true
      *      ),
      *     @OA\Response(
      *         response=200,
      *         description="Una Escuela"
      *     ),
      *     @OA\Response(
      *         response="default",
      *         description="Ha ocurrido un error"
      *     )
      *  )
      */
     public function delete($id)
     {
         $school = School::find($id);
         if(!$school)
         {
             return response()->json(['message'=>'No hay escuela'],404);
         }
         $school->delete();
         $data = [
             'message' => 'Escuela eliminada',
             'status' => 200
         ];
         return response()->json($data,200);
     }
     /**
      *   @OA\put
      *     (
      *     path="/api/school/{id}",
      *     summary="actualizar una escuela",
      *     tags={"Colegio"},
      *     @OA\Parameter(
      *         in="path",
      *         name="id",
      *         required=true
      *      ),
      *      @OA\RequestBody(
      *         required=true,
      *         description="Datos necesarios para actualizar un estudiante",
      *         @OA\JsonContent(
      *             required={"name", "description"},
      *             @OA\Property(property="name", type="string", example="Laptop"),
      *             @OA\Property(property="description", type="string", example=1),
      *             )
      *     ),
      *     @OA\Response(
      *         response=200,
      *         description="Una estudiante"
      *     ),
      *     @OA\Response(
      *         response="default",
      *         description="Ha ocurrido un error"
      *     )
      *  )
      */
     public function update(Request $request,$id)
     {
        
        $school = School::findOrFail($id);
        
        if(!$school)
        {
            return response()->json(['No se encontro la escuela']);
        }
         
         $school->name = $request->name;
         $school->description = $request->description;

         $school->save();
         $data = [
             'school'=> $school,
             'status'=> 200
         ];
         return response()->json($data, 200);
     }
}
