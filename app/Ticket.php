<?php

namespace App;
use App\Customer;
use Illuminate\Database\Eloquent\Model;
use App\TxtFieldData;
Use App\TxtField;
use App;
use HipsterJazzbo\Landlord\BelongsToTenant;
class Ticket extends Model
{
    use BelongsToTenant;
    protected $table='tickets';
    protected  $fillable= array('customer_id', 'model', 'make','problem_type','problem_definition');

    //ticket belong to A Customer
    public function customer(){
        return $this->belongsTo('App\Customer','customer_id','id');

    }

    public function  invoice(){
        //foreign key,then Local key
        return $this->hasOne('App\Invoice','ticket_id','id');
    }


    function stock(){
        //2nd arg is pivot table name
        return $this->belongsToMany('App\Stock','stock_ticket','ticket_id','stock_id');
    }
    function employee(){
        //2nd arg is pivot table name
        return $this->belongsToMany('App\Employee');
    }



    public function fieldDetails($ticketId){

        $formFields=App\TxtField::where('form_name', '=', 'ticket')->get();
        $out=array();
        foreach ($formFields as $formField){
            $fieldData=App\TxtFieldData::where('entity_id','=',$ticketId)->where('field_id','=',$formField->id);

           array_push($out,array('data'=>$fieldData->get(),'properties'=>$formField));
        }
        return $out;
    }

    public function fieldPropertyInfo($field_id){
    $fieldInfo=App\TxtFieldData::find($field_id)->property()->get();
        //echo  $fieldInfo;
    return $fieldInfo;

}

}
/*
 * php artisan tinker
 */