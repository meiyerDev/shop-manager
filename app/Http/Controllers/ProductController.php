<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\ProductResourceCollection;
use App\Repositories\ProductRepositoryContract;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /** @var ProductRepositoryContract */
    private $productRepository;

    function __construct(ProductRepositoryContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Return all products
     */
    public function index(Request $request)
    {
        $products = $this->productRepository->getAllPaginated((int) $request->query('limit', 20));

        return $this->successResponse(
            new ProductResourceCollection($products),
        );
    }
}
