<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class XmlParserController extends Controller
{
    public $categories;

    public function __construct()
    {
        $this->categories = [
            'G1' => 'g1',
            'Brasil' => 'brasil',
            'Ciência e saúde' => 'ciencia-e-saude',
            'Economia' => 'economia',
            'Educação' => 'educacao',
            'Loterias' => 'loterias',
            'Natureza' => 'natureza',
            'Planeta Bizarro' => 'planeta-bizarro',
        ];

        View::share('categories', $this->categories);
    }

    public function index()
    {
        return redirect(route('home.category','g1'));
    }

    public function category($category)
    {
        $check = in_array($category,$this->categories);

        if($check == false){
            return abort(404);
        }

        if($category == 'g1'){
            $xml = simplexml_load_file('http://g1.globo.com/dynamo/rss2.xml');
        }else{
            $xml = simplexml_load_file('http://g1.globo.com/dynamo/'.$category.'/rss2.xml');
        }
        return view('index')
            ->with('xml', $xml)
            ->with('actualCategory', $category);
    }
}
