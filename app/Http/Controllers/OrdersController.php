<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use App\User;
use App\Shipments;
use App\LogShipmentStatus;
use App\Shops;
use Illuminate\Support\Facades\Auth;
use App;

class OrdersController extends Controller
{
    public function index()
    {
        $orders  =  Orders::select('orders.id','order_number','email','total_price','order_id','orders.tracking_number','shipments.shipment_status')->leftjoin('shipments','orders.id', 'shipments.fk_order')->get();
        return view('orders',compact('orders'));
    }

    public function show(Article $article)
    {
        //return $article;
    }

    public function store(Request $request)
    {
        $input = $request->all();
        // echo "<pre>";
        // print_r($input["ref"]);
        // exit;
        if (count($input) > 0){
          if ($input["ref"] == "shopify"){
              $input['line_items'] = json_encode($input['line_items']);
              $input['order_id'] = $input['id'];
              unset($input['id']);

              Orders::create($input);
              return response()->json('order placed');
            }else if($input["ref"] == "wordpress"){
              $input['line_items'] = json_encode($input['line_items']);
              $input['order_id'] = $input['id'];
              $input['email'] = $input['billing']['email'];

              $input['total_price'] = $input['total'];
              $input['total_tax '] = $input['total_tax'];
              $input['currency'] = $input['currency'];
              $input['financial_status'] = $input['status'];
              $input['name'] = $input['number'];
              $input['order_number'] = $input['number'];
              $input['source_url'] = $input['customer_user_agent'];
              $input['processing_method'] = $input['payment_method'];

              unset($input['id']);

              Orders::create($input);
              return response()->json('order placed');
            }
        }
    }

    public function accept(Request $request)
    {
      $user_id = Auth::user()->id;
      $shop = Shops::where(['fk_user'=>$user_id,'platform'=>'shopify'])->first();
      $shopify = App::make('ShopifyAPI', [
                     'API_KEY'       => $shop->api_key,
                     'API_SECRET'    => $shop->shared_key,
                     'SHOP_DOMAIN'   => $shop->site_address,
                     'ACCESS_TOKEN'  => $shop->secret_key
                ]);
        $input = $request->all();
        $tracking_number = rand(1000000,9999999);
        if($input['status'] != ""){
            $order = Orders::find($input['order_id']);
            if($order->tracking_number == ""){

                $call = $shopify->call(
                  ['URL' => 'admin/orders/' . $order->order_id . '/fulfillments.json',
                  'METHOD' => 'POST',
                  'DATA' => '{
                      "fulfillment": {
                        "tracking_number": "'.$tracking_number.'",
                        "tracking_urls": [
                          "http://localhost/boxee/public/track/'.$tracking_number.'",
                          "http://localhost/boxee/public/track/'.$tracking_number.'"
                        ],
                        "notify_customer": true,
                        "tracking_company":"boxee"
                      }
                    }']);

                $order->tracking_number = $tracking_number;
                $order->save();

                $shipment = Shipments::create([
                    'fk_order'        => $input['order_id'],
                    'tracking_number' => $tracking_number,
                    'shipment_status' => 'confirmed',
                    'fulfillment_id' => $call->fulfillment->id
                ]);
            }else{

                $shipment = Shipments::where('fk_order',$input['order_id'])->first();
                $shipment->shipment_status = $input['status'];
                $shipment->save();

                $call = $shopify->call(
                  ['URL' => 'admin/orders/' . $order->order_id . '/fulfillments/' . $shipment->fulfillment_id . '/events.json',
                  'METHOD' => 'POST',
                  'DATA' => '{
                        "event": {
                          "status": "'.$input['status'].'"
                        }
                    }']);



            }
            LogShipmentStatus::create([
                'fk_shipment'           => $shipment->id,
                'shipment_status_from'  => $shipment->shipment_status,
                'shipment_status_to'    => $input['status']
            ]);
            return back()->with('success','Shipment created successfully.');
        }else{
            return back()->with('error','Please select shipment status.');
        }
    }

    public function trackShipment($tracking_number)
    {
        $shipment = Shipments::where('tracking_number',$tracking_number)->first();
        $shipment_logs = [];
        if(count($shipment)>0){
           $shipment_logs = LogShipmentStatus::where('fk_shipment',$shipment->id)->orderBy('id','desc')->get();
        }
        return view('track-shipment',compact('tracking_number','shipment_logs'));

    }

    public function update(Request $request)
    {
        $input = $request->all();
        dd($input);
        //$article->update($request->all());

        //return response()->json($article, 200);
    }

    public function delete(Article $article)
    {
        //$article->delete();

        //return response()->json(null, 204);
    }

    public function showUserToken()
    {

        $users = User::all();
        return view('user',compact('users'));
    }
}
