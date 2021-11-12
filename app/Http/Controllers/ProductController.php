<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Validator;
use DB;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Http\Requests\StoreProductRequest;
use App\Services\ProductService;
use App\Http\Requests\UpdateProductRequest;
use App\Services\LogService;
use App\Http\Resources\ProductCollection;

class ProductController extends Controller
{
    /**
     * @var ProductService
     * @var LogService
     */
    private $productService;
    private $logService;

    /**
     * ProductController constructor.
     * @param ProductService $productService
     */
    public function __construct(
        ProductService $productService,
        LogService $logService
    ) {
        $this->productService = $productService;
        $this->logService = $logService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(15);

        return new ProductCollection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $this->productService->storeNewProduct(
            $request->sku,
            $request->name, 
            $request->stock,
            $request->price
        );

        $this->logService->storeLog(
            $request,
            [
                'Adicionou novo produto, SKU: '.$request->sku
            ],
            'new'
        );

        return response()->json([
            'message' => 'Produto registrado!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $changes = array_diff($request->toArray(), $product->toArray());

        $this->logService->storeLog(
            $product,
            $changes,
            'edit'
        );

        $this->productService->updateProduct(
            $product,
            $request,
        );

        return response()->json([
            'message' => 'Produto atualizado!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        $this->logService->storeLog(
            $product,
            [
                'Removeu um produto, SKU: '.$product->sku
            ],
            'new'
        );

        $product->delete();

        return response()->json([
            'message' => 'Produto excluído!',
        ]);
    }
}
