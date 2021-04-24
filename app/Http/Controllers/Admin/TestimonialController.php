<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    protected $paginate_count = 15;

    public function index()
    {
        $testimonials = Testimonial::simplePaginate($this->paginate_count);
        return view('admin.testimonials', compact('testimonials'));
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.edit-testimonial', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial) {
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        
        if (isset($request->thumbnail)) {
            $request->validate([
                'thumbnail' => 'required|file|image|mimes:jpg,png,jpeg|max:2048',
            ]);

            $file = $request->file('thumbnail');
            $filename = Str::slug($request->type, '-') . time().'.'.$file->extension();

            $path = $file->storeAs(
                'testimonials', $filename
            );
            if (!is_null($testimonial->thumbnail)) {
                // Delete the previous image from the server
                $initialpath = $testimonial->thumbnail;
                Storage::delete($initialpath);
            }
            $testimonial->thumbnail = $path;
            $testimonial->save();
        }

        
        $testimonial->update($request->except('thumbnail'));

        return back()->with('success', 'Testimonial updated successfully!');
    }

    public function create() {
        return view('admin.create-testimonial');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'thumbnail' => 'nullable|file|image|mimes:jpg,png,jpeg|max:2048',
        ]);
        
        $path = "";
        if (isset($request->thumbnail)) {
            $file = $request->file('thumbnail');
            $filename = Str::slug($request->type, '-') . time().'.'.$file->extension();
    
            $path = $file->storeAs(
                'testimonials', $filename
            );
        }
        
        $data = array("name" => $request->name, "message" => $request->message, "thumbnail" => $path);
        $testimonial = Testimonial::create($data);

        return redirect()->route('admin.testimonials')->with('success', 'Testimonial created successfully!');
    }
    
    public function destroy(Testimonial $testimonial) {
        $testimonial->delete();

        return redirect()->route('admin.testimonials')->with('success', 'Testimonial deleted successfully!');
    }
}