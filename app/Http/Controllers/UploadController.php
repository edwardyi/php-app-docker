<?php

namespace App\Http\Controllers;

use App\Models\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{
    public function store()
    {
        $images = request()->file('file');

        if (!is_dir(public_path('/images'))) {
            mkdir(public_path('/images', 0777));
        }

        $images = Collection::wrap(request()->file('file'));

        try {
            $images->each(function($image) {
    
                $basename = Str::random();
                //'abc.'.$image->getClientOriginalExtension()
                $original = $basename . '.'. $image->getClientOriginalExtension();
                $thumbnail = $basename .'_thumb.'.$image->getClientOriginalExtension();

                // dd($image->getSize());
                // dd($image, $original);

                $thumbnailPath = public_path('/images/'.$thumbnail);

                // echo "thumbnail:".$thumbnailPath;
    
                Image::make($image)
                    ->fit(250, 250)
                    ->save(public_path('/images/'.$thumbnail));
    
                $image->move(public_path('/images'), $original);
    
                ImageUpload::create([
                    'original' => '/images/'.$original,
                    'thumbnail' => '/images/'.$thumbnail
                ]);
                
            });
        } catch(\Exception $e) {
            // dd($e->getTraceAsString());
            dd($e->getMessage());
        }
    }
}
