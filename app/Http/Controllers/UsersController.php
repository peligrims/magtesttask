<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Realties;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use SpreadsheetReader;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia;
use function GuzzleHttp\Promise\all;
use Spatie\MediaLibrary\File;


class UsersController extends Controller
{
    public function create (Request $request)
    {
        if($request->hasFile('file')){
            $users = User::find(1);
            //Add to Collection
            $users->addMedia($request->file('file'))->toMediaCollection('images');
            //get from Collection
            $item = $users->getFirstMediaPath('images');
            //edit path to file for Windows
            $users->path = str_replace('\\', '/', $item);
            //Parse file
            $reader = new \SpreadsheetReader($users->path);
            //Save to DB
            foreach ($reader as $row) {
                Realties::updateOrCreate(['name' => $row[0]],
                    [
                        'price' => $row[1],
                        'bedroom' => $row[2],
                        'bathroom' => $row[3],
                        'storey' => $row[4],
                        'garage' => $row[5]
                    ]
                );
            }

        }
        return back()->with('success','Database updated!');
    }

}


