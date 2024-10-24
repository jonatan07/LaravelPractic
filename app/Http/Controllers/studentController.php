<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Validators\StudentValidator;
use Illuminate\Http\Request;

/**
 *  @OA\Info(title="API Estudiantes", version="2.0")
*/
class studentController extends Controller
{
    /**
     *   @OA\get
     *     (
     *     path="/api/students",
     *     summary="Obtener lista de estudiantes",
     *     tags={"Estudiante"},
     *     @OA\Parameter(
     *         in="query",
     *         name="name",
     *         required=false
     *      ),
     *      @OA\Parameter(
     *         in="query",
     *         name="lastName",
     *         required=false
     *      ),
     *      @OA\Parameter(
     *         in="query",
     *         name="email",
     *         required=false
     *      ),
     *     @OA\Parameter(
     *         in="query",
     *         name="phone",
     *         required=false
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Una lista de estudiantes"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     )
     *  )
     */

    public function getAll(Request $request)
    {
        $query = Student::query();
        // Aplicar filtro.
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->get('name') . '%');
        }
        if ($request->has('lastName')) {
            $query->where('lastName', 'like', '%' . $request->get('lastName') . '%');
        }
        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->get('email') . '%');
        }
        if ($request->has('phone')) {
            $query->where('phone', 'like', '%' . $request->get('phone') . '%');
        }
        // Ejecutar la consulta y obtener los resultados
        $students = $query->get();
        if($students->isEmpty())
        {
            return response()->json(['message'=>'No hay estudiantes'],404);
        }
        return response()->json($students,200);
    }
    /**
     *   @OA\get
     *     (
     *     path="/api/student/{id}",
     *     summary="Obtener un estudiante",
     *     tags={"Estudiante"},
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
        $student = Student::find($id);
        if(!$student)
        {
            return response()->json(['message'=>'No hay estudiantes'],404);
        }
        return response()->json($student,200);
    }
    /**
     *   @OA\post
     *     (
     *     path="/api/student",
     *     summary="crear un estudiante",
     *     tags={"Estudiante"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Datos necesarios para crear un estudiante",
     *         @OA\JsonContent(
     *             required={"name", "lastName","email","phone","address"},
     *             @OA\Property(property="name", type="string", example="Laptop"),
     *             @OA\Property(property="lastName", type="string", example=1),
     *             @OA\Property(property="email", type="string", format="float", example=1200.50),
     *             @OA\Property(property="phone", type="string", example="Descripción opcional del producto"),
     *             @OA\Property(property="address", type="string", example="Descripción opcional del producto")
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

        $rule = StudentValidator::Valid($request);
        
        if($rule['isValid'])
        {
            $data = [
                'error'=> $rule['error'],
                'status'=> 422
            ];
            return response()->json($data,422);
        }

        $student = Student::create([
            'name' => $request->name,
            'lastName'=> $request->lastName,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'address'=> $request->address
        ]);

        if(!$student)
        {
            $data = [
                'message'=> 'Error al crear el estudiante',
                'status'=> 500
            ];
            return response()->json($data,500);
        }

        $data = [
            'student'=> $student,
            'status'=> 201
        ];

        return response()->json($data,201);
    }
    /**
     *   @OA\delete
     *     (
     *     path="/api/student/{id}",
     *     summary="eliminar un estudiante",
     *     tags={"Estudiante"},
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
    public function delete($id)
    {
        $student = Student::find($id);
        if(!$student)
        {
            return response()->json(['message'=>'No hay estudiantes'],404);
        }
        $student->delete();
        $data = [
            'message' => 'Estudiante eliminado',
            'status' => 200
        ];
        return response()->json($data,200);
    }
    /**
     *   @OA\put
     *     (
     *     path="/api/student/{id}",
     *     summary="actualizar un estudiante",
     *     tags={"Estudiante"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         description="Datos necesarios para actualizar un estudiante",
     *         @OA\JsonContent(
     *             required={"name", "lastName","email","phone","address"},
     *             @OA\Property(property="name", type="string", example="Laptop"),
     *             @OA\Property(property="lastName", type="string", example=1),
     *             @OA\Property(property="email", type="string", format="float", example=1200.50),
     *             @OA\Property(property="phone", type="string", example="Descripción opcional del producto"),
     *             @OA\Property(property="address", type="string", example="Descripción opcional del producto")
     *         )
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
    public function update($id,Request $request)
    {
        $student = Student::find($id);
        if(!$student)
        {
            return response()->json(['message'=>'No se encuentra al estudiante'],404);
        }
        $student->name = $request->name;
        $student->lastName = $request->lastName;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->save();
        $data = [
            'student'=> $student,
            'status'=> 200
        ];
    return response()->json($data, 200);
    }
}
