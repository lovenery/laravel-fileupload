<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Storage;
use File;
use App\Fileentry;
class FileEntryController extends Controller
{

    public function index(){
      $entries = Fileentry::all();

      return view('fileentries.index', compact('entries'));
    }

    public function add(Request $request) {

      $file = $request->file('filefield');
      $extension = $file->getClientOriginalExtension();
      Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
      $entry = new Fileentry();
      $entry->mime = $file->getClientMimeType();
      $entry->original_filename = $file->getClientOriginalName();
      $entry->filename = $file->getFilename().'.'.$extension;

      $entry->save();

      return redirect('fileentry');
      
    }

}