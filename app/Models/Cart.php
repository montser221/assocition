<?php

namespace App\Models;

class Cart
{
    public $items;
    public $totalQty;
    // public $totalPrice =0;
    public $denote =[];

    public function __construct($oldCart)
    {
      if ($oldCart)
      {
          $this->items = $oldCart->items;
          $this->totalQty = $oldCart->totalQty;
      }
      else
      {
        $this->items = [];
        $this->totalQty = 0;
      }
    }

    public function add($item ,$id)
    {
       $storedItem = [
         'qty'=>0,
         'projectId'=>$item->projectId ,
         'projectName'=>$item->projectName ,
         'project'=>$item ,
         'den'=> request()->input('denoate') ?? request()->input('dnow'),
        //  ['deno'][$item->projectId] => request()->input('denoate'),
         ];

       if($this->items)
       {
         if(array_key_exists($id , $this->items) )
         {
           $storedItem = $this->items[$id];
           $storedItem['qty']++;

         }
       }

       if ($storedItem['qty'] >= 1)
       {
          \Session::flash('cart-message','لقد أضفت هذا المشروع مسبقا الى السلة');
       }
       else
       {
         $this->items[$id] = $storedItem;
         $this->totalQty++;
       }
    }


    public function remove($id)
    {
      if (array_key_exists($id,$this->items))
      {
        $this->totalQty--;
        unset($this->items[$id]);
      }

    }
}
