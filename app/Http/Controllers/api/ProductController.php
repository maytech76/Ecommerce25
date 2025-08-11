<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Products",
 *     description="Gestione con productos"
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
     *         description="Lista de productos",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="category_id", type="integer"),
     *                 @OA\Property(property="brand_id", type="integer"),
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="slug", type="string"),
     *                 @OA\Property(property="description", type="string", nullable=true),
     *                 @OA\Property(property="price", type="number", format="float"),
     *                 @OA\Property(property="price2", type="number", format="float", nullable=true),
     *                 @OA\Property(property="stock", type="integer"),
     *                 @OA\Property(property="image", type="string", nullable=true),
     *                 @OA\Property(property="status", type="string"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     )
     * )
     */
    public function index(Request $request){
        
        $query = Product::query();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        return response()->json($query->get());
    }
}