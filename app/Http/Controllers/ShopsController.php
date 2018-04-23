<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shops;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Woocommerce;
use App;

class ShopsController extends Controller
{
    public function index()
    {
        $shops  =  Shops::all();
        return view('shops.index',compact('shops'));
    }

    public function show(Article $article)
    {
        //return $article;
    }

    public function create()
    {
        return view('shops.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        if($input['platform'] == 'shopify'){


            $input['fk_user'] = Auth::user()->id;
            $shop = Shops::create($input);
            $shopify = App::make('ShopifyAPI', [
                     'API_KEY'       => $shop->api_key,
                     'API_SECRET'    => $shop->shared_key,
                     'SHOP_DOMAIN'   => $shop->site_address,
                     'ACCESS_TOKEN'  => $shop->secret_key
                ]);

            $api_token = Auth::user()->api_token;
            $url = "http://647ce01b.ngrok.io/dropshipper/public/orders/create?ref=shopify&api_tokens=$api_token";

            $call = $shopify->call(
                  ['URL' => 'admin/webhooks.json',
                  'METHOD' => 'POST',
                  'DATA' => '{
                        "webhook": {
                            "topic": "orders/create",
                            "address": "'.$url.'",
                            "format": "json"
                        }
                    }']);

            $shop->response = json_encode($call);
            $shop->update();

            return Redirect::to('shops')->with('success','Shop created successfully.');
        }else if($input['platform'] == 'wordpress'){


            $input['fk_user'] = Auth::user()->id;
            $shop = Shops::create($input);

            $api_token = Auth::user()->api_token;
            $url = "http://647ce01b.ngrok.io/dropshipper/public/orders/create?ref=wordpress&api_tokens=$api_token";


            $data = [
                'name' => 'Order created',
                'topic' => 'order.created',
                'delivery_url' => $url,
              ];
            $call = Woocommerce::post('webhooks',$data);
            $shop->response = json_encode($call);
            $shop->update();

            return Redirect::to('shops')->with('success','Shop created successfully.');
        }else{
            return Redirect::back()->withInput()->with('error',strtoupper($input['platform']).' will be launching soon.');
        }
    }

    public function edit($id) {
        $edit_section  =  Shops::where('shop_id',$id)->first();
        return view('shops.create',compact('edit_section','id'));
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $shop = Shops::where('shop_id',$input['id'])->first();
        $shop->update($input);
        return Redirect::to('shops')->with('success','Shop updated successfully.');
    }

    public function destroy($id)
    {
        $package = Shops::where('shop_id',$id)->first();
        $package->delete();
        return Redirect::to('shops')->with('success','Shop deleted successfully.');
    }
}
