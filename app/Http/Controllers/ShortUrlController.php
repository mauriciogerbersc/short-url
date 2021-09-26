<?php
  
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Str;
use App\Http\Resources\ShortUrl as ShortUrlResource;
use App\Http\Requests\ShortRequest;

class ShortUrlController extends Controller
{
    public function store(ShortRequest $request)
    {
        $short_url = new ShortUrl;
        $short_url->link = $request->link;
        $short_url->code = $request->code;
        $short_url->expiration_date = $request->expiration_date;


        if( $short_url->expiration_date!=''){
            $short_url->expiration_date = implode('-', array_reverse(explode('/', $short_url->expiration_date )));
        }else{
            $short_url->expiration_date = date('Y-m-d',strtotime("+7 day", time()));
        }

        if($short_url->code!=''){
          
            $findCode = ShortUrl::where('code',$short_url->code)->first();
         
            if($findCode){
                return response()->json([
                    'success' => false,
                    'message' => 'Código já cadastrado'
                ], 404);
            }
        }else{
            $short_url->code = Str::random(6);
        }

        if( $short_url->save()){
            
            return response()->json([
                'url'  => $short_url->code
            ], 201);
        }
       
    }

    public function list(){
        $links = ShortUrl::all();

        if( $links ){
            return new ShortUrlResource($links);
        }
    }

    public function update(ShortRequest $request){

        $short_url = ShortUrl::findOrFail($request->id);

        $short_url->link = $request->input('link');

        if($short_url->code!=''){
          
            $findCode = ShortUrl::where('code',$short_url->code)->first();
         
            if($findCode){
                return response()->json([
                    'success' => false,
                    'message' => 'Código já cadastrado'
                ], 404);
            }

        }else{
            $short_url->code = Str::random(6);
        }
        

        if( $short_url->save() ){

            return response()->json([
                'url'  => $short_url->code
            ], 201);

        }
    }

    public function destroy(Request $request){
        $short_url = ShortUrl::findOrFail($request->id);
    
        if( $short_url->delete() ){
            return response()->json([
                'success'=>true,
                'message' => 'Registro deletado com sucesso'
            ], 204);
        }else{
            return response()->json([ 'error' => 'Registro não pode ser deletado'], 500);
        }
    }

    public function shorten(Request $request){
        
        $find = ShortUrl::where('code', $request->code)->first();
        $today = date('Y-m-d');

        if(!$find){
            return back()->withErrors(['URL' => 'Url não encontrada: ' . $find->code]);
        }

        if($today > $find->expiration_date){
            return back()->withErrors(['Link' => 'Link expirado: ' . $find->code]);
        }
    
        return redirect($find->link);

    }
}