<?php

namespace App\Http\Controllers;
use App\Models\Projects;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
  // Add To cart function

  public function addToCart(Request $request , $id)
  {
     $request->validate([
      'denoate'=>'required|numeric|min:1'
    ]);
      $project = Projects::find($id);
      $oldcart = \Session::has('cart') ?  \Session::get('cart') : null;
      $cart = new Cart($oldcart);
      $cart->add($project,$project->projectId);
      $request->session()->put('cart',$cart);
      if($request->has('zakat'))
      {
        if($request->zakat=="true")
          return redirect()->route('zakat');
      } 
      else if($request->has('customproject'))
      {
        if($request->customproject=="true")
          return redirect()->route('customProjectDetail');
      } 
      else if($request->has('projectDetail'))
      {
        if($request->projectDetail=="true")
          return redirect()->route('projectDetail',$request->pid);
      } 
      else
      {

        return redirect()->route('home');
      }

  }
  
   public function addToCartNow(Request $request , $id)
  {
    $request->validate([
      'dnow'=>'required|numeric|min:1'
    ]);
      $project = Projects::find($id);
      $oldcart = \Session::has('cart') ?  \Session::get('cart') : null;
      $cart = new Cart($oldcart);
      $cart->add($project,$project->projectId);
      $request->session()->put('cart',$cart);

        return redirect()->route('cart');

  }
  

  public function destory ($id)
  {
    if (session()->has('cart'))
    {
      $cartobj = new Cart(session()->get('cart'));
      $cartobj->remove($id);
      if($cartobj->totalQty <=0 )
      {
        session()->forget('cart');
      }
      else
      {
        session()->put('cart',$cartobj);
      }

        // print_r($cartobj);
    }
      return redirect()->route('cart')->With('success','تم حذف المشروع من السلة بنجاح');
  }
}
