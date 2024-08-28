<?php

namespace App\Http\Controllers\Admin;

use App\Models\Portfolio;
use Symfony\Component\HttpFoundation\File\File;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller
{
    public function getList()
    {
        $portfolios = Portfolio::all();
        return response()->json(['images' => $portfolios], 200);
    }

    public function remove(string $portfolio_id)
    {
        Portfolio::where('id', '=', $portfolio_id)->delete();

        return response()->json(true, 200);
    }

    public function create(Request $request)
    {
        if($request->file()) {
            $file_name = $request->file('file')->getClientOriginalName();
            $file = new File($request->file('file')->getPathname());
            $file->move(public_path().'/images/portfolio/',$file_name);
            Portfolio::create([
                'image' => $file_name,
            ]);
        }

        return response()->json(true, 200);
    }
}
