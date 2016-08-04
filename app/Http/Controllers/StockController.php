<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Stock;
use App\Common\Utility;

class StockController extends Controller
{
    public function getAll()
    {
        return Stock::all();


    }

    /*
     * store A New Stock
     * @param Takes Input from Ajax Json
     * @return Successful (0 or 1)
     */

    public function store(Request $request)
    {
        Utility::stripXSS(); //prevent xss , should be called before server side validation so as validation is done on safe data

        $rules = array(
            'product_name'       => 'required',
            'selling_price'      => 'required',
        );
        $validator = Validator::make(Input::all(), $rules); //validate input according to rule above
        $stock = new Stock(Input::get());
        //As data was  send with Dataname that correspond to that in Db ,no need to precise what input goes in what table field(row),(laravel Figure it out)
        $stock->save();
        return  array("successful"=>true, "message"=>"stock was created");
    }

    /*
     * get Customer Detail with id X
     * **return Details of Customer With id X
     */


    public function get($id)
    {

        try {
            return Stock::find($id);

        }
        catch (\Illuminate\Database\QueryException $e){
            return "error";
        }
    }




    public function update($id)
    {
        Utility::stripXSS(); //prevent xss , should be called before server side validation so as validation is done on safe data
        $rules = array(
            'product_name'       => 'required',
            'selling_price'      => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        $stock = Stock::find($id);
        $stock->update(Input::all());
        return  array("successful"=>true, "message"=>"Stock item was updated");

    }


    public function destroy($id)
    {
        //Delete A Stock with id X
        try {
            $stock = Stock::find($id); //get Customer with id X
            $stock->delete($id); //delete the Customer
            return  array("successful"=>true, "message"=>"Stock item was deleted");
        }

        catch (\Illuminate\Database\QueryException $ex){
            return  array("successful"=>false, "message"=>"An error Db");
        }


    }
}