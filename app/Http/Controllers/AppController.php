<?php

namespace App\Http\Controllers;
use App\Models\Products as Products;
use App\Models\Sellers as Sellers;
use App\Models\QueryModel as QueryModel;
use Illuminate\Http\Request;

class AppController extends Controller
{
    protected $Sellers;
    protected $Products;
    protected $QueryModel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->Sellers = new Sellers();
      $this->Products = new Products();
      $this->QueryModel = new QueryModel();
    }
    /**
     * Hello world
     *
     * @return void
     */
    function helloWorld()
    {
      return [
        'Project' => 'WeSellCars',
      ];
    }

    function validateError( $validate )
    {
      if(isset($validate["code"])) return response( ['errors' => $validate['errors']] , $validate["code"]);
      return false;
    }
    /**
     * Get a sellers
     *
     * @return void
     */
    function getSeller(Request $Request)
    {
      return response( $this->QueryModel->query($this->Sellers, $Request ) , 200);
    }
    /**
     * Create a new seller
     *
     * @return void
     */
    function createSeller(Request $Request)
    {
      $validate = $this->Sellers->validateCreateSeller($Request->input());
      if(isset($validate["code"])) return response( ['errors' => $validate['errors']] , $validate["code"]);
      $this->Sellers->create( $Request->input() );
      return response( ['result' => 'success'] , 200);
    }
    /**
     * Get a products
     *
     * @return void
     */
    function getProduct(Request $Request)
    {
      return response( $this->QueryModel->query($this->Products, $Request ) , 200);
    }
    /**
     * Create a new product
     *
     * @return void
     */
    function createProduct(Request $Request)
    {
      $validate = $this->Products->validateNewProduct($Request->input());
      if(isset($validate["code"])) return response( ['errors' => $validate['errors']] , $validate["code"]);
      return ['result' => 'success'];
    }
}
