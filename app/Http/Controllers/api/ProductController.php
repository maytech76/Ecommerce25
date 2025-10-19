<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Products",
 *     description="Operaciones para gestionar productos"
 * )
 * 
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     required={"category_id", "brand_id", "name", "price", "stock", "status"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="category_id", type="integer", example=1),
 *     @OA\Property(property="brand_id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Smartphone X"),
 *     @OA\Property(property="slug", type="string", example="smartphone-x"),
 *     @OA\Property(property="description", type="string", nullable=true, example="Último modelo con cámara 108MP"),
 *     @OA\Property(property="price", type="number", format="float", example=999.99),
 *     @OA\Property(property="price2", type="number", format="float", nullable=true, example=899.99),
 *     @OA\Property(property="stock", type="integer", example=50),
 *     @OA\Property(property="image", type="string", nullable=true, example="smartphone-x.jpg"),
 *     @OA\Property(property="status", type="string", enum={"active", "inactive"}, example="active"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Listar todos los productos",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="category_id",
     *         in="query",
     *         description="Filtrar por ID de categoría",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="brand_id",
     *         in="query",
     *         description="Filtrar por ID de marca",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de productos obtenida exitosamente",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Product")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error del servidor"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        return response()->json($query->get());
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     summary="Crear un nuevo producto",
     *     tags={"Products"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"category_id", "brand_id", "name", "price", "stock", "status"},
     *             @OA\Property(property="category_id", type="integer", example=1),
     *             @OA\Property(property="brand_id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Smartphone X"),
     *             @OA\Property(property="slug", type="string", example="smartphone-x", nullable=true),
     *             @OA\Property(property="description", type="string", example="Último modelo con cámara 108MP", nullable=true),
     *             @OA\Property(property="price", type="number", format="float", example=999.99),
     *             @OA\Property(property="price2", type="number", format="float", example=899.99, nullable=true),
     *             @OA\Property(property="stock", type="integer", example=50),
     *             @OA\Property(property="image", type="string", example="smartphone-x.jpg", nullable=true),
     *             @OA\Property(property="status", type="string", enum={"active", "inactive"}, example="active")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Producto creado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/Product"),
     *             @OA\Property(property="message", type="string", example="Producto creado correctamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Error en los datos proporcionados"),
     *             @OA\Property(property="errors", type="object", example={
     *                 "name": {"El campo nombre es obligatorio"},
     *                 "price": {"El campo precio debe ser un número"}
     *             })
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:products,slug',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'price2' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $product = Product::create($data);

        return response()->json([
            'success' => true,
            'data' => $product,
            'message' => 'Producto creado correctamente'
        ], 201);
    }
}