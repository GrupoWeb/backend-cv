<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ContactController
 * @package App\Http\Controllers
 */
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/contacto",
     *     description="Get List",
     *     tags={"Contacto"},
     *     @OA\Response(
     *          response=200,
     *          description="Listado de Contactos de Emergencia"
     *      ),
     * )
     */

    public function index()
    {
        $contacts = Contact::with('user')->get();

        return response()->json($contacts, Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */

    /**
     * @OA\Post (
     *     path="/api/contacto",
     *     description="Store a newly created resource in database",
     *     tags={"Contacto"},
     *     @OA\RequestBody(
     *     required = true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema (
     *                  @OA\Property(
     *                      property = "contact_name",
     *                      description = "Nombre del Contacto",
     *                      type = "string",
     *                  ),
     *                  @OA\Property(
     *                      property = "number",
     *                      description = "Número de Teléfono",
     *                      type = "integer",
     *                  ),
     *                  @OA\Property(
     *                      property = "relationship",
     *                      description = "Parentesco",
     *                      type = "string",
     *                  ),
     *                  @OA\Property(
     *                      property = "user_id",
     *                      description = "Identificación del Usuario",
     *                      type = "integer",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *      response=202,
     *      description="Crear un contacto",
     *     )
     * )
     */
    public function store(Request $request)
    {
        request()->validate(Contact::$rules);

        $contact = Contact::create($request->all());

        return response()->json($contact, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/contacto/{id}",
     *     description="Get a record of contact",
     *     tags={"Contacto"},
     *     @OA\Parameter (
     *      name="id",
     *      in="path",
     *      description="id for contact",
     *      required=true,
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Obtener un contacto",
     *      )
     * )
     */
    public function show(int $id)
    {
        $contact = Contact::find($id);

        return response()->json($contact, Response::HTTP_OK);
    }


    /**
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/contacto/usuario/{id}",
     *     description="Get contact by ID",
     *     tags={"Contacto"},
     *     @OA\Parameter (
     *      name="id",
     *      in="path",
     *      description="user_id",
     *      required=true,
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Obtener la información de un contacto por su id",
     *      )
     * )
     */

    public function showByUserId(int $id){
        $contact = Contact::selectRaw('id, contact_name, number, relationship')
            ->where(['user_id'    =>  $id])->get();
        return response()->json($contact, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Contact $contact
     * @param $id
     * @return Response
     */

    /**
     * @OA\Put (
     *     path="/api/contacto/{id}",
     *     description="Update a contact",
     *     tags={"Contacto"},
     *     @OA\Parameter (
     *          name="id",
     *          in="path",
     *          description="id",
     *          required = true,
     *      ),
     *     @OA\RequestBody(
     *          required = true,
     *          @OA\MediaType(
     *              mediaType = "application/json",
     *              @OA\Schema (
     *                  @OA\Property(
     *                      property = "contact_name",
     *                      description = "nombre del contacto",
     *                      type = "string",
     *                  ),
     *                  @OA\Property(
     *                      property = "number",
     *                      description = "número de teléfono de contacto",
     *                      type = "integer",
     *                  ),
     *                  @OA\Property(
     *                      property = "relationship",
     *                      description = "Parentesco",
     *                      type = "string",
     *                  ),
     *                  @OA\Property(
     *                      property = "user_id",
     *                      description = "Identificación del usuario",
     *                      type = "integer",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="Actualizar un contacto",
     * ),
     * )
     */
    public function update(Request $request, Contact $contact, $id)
    {
        request()->validate(Contact::$rules);

        $contact->find($id)->update($request->all());

        return response()->json('Actualizado correctamente',Response::HTTP_OK);
    }

    /**
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Delete (
     *     path="/api/contacto/{id}",
     *     description="Delete a single contact on the ID supplied",
     *     tags={"Contacto"},
     *     @OA\Parameter (
     *      description = "ID of contact to delete",
     *      in = "path",
     *      name = "id",
     *      required = true,
     *     ),
     *     @OA\Response(
     *     response=204,
     *     description="Eliminar un contacto",
     * )
     * )
     */
    public function destroy(int $id)
    {
        $contact = Contact::find($id)->delete();

        return response()->json($contact, Response::HTTP_NO_CONTENT);
    }
}
