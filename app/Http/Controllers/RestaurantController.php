<?php

namespace App\Http\Controllers;

use App\Restaurant;
use App\Comment;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    
    public function index()
    {
        //
        $restaurants = Restaurant::paginate(10);
//        $restaurants = Restaurant::all();
//        return Restaurant::all();
        return view('restaurants.index')->with('restaurants', $restaurants);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request->input('latitude');
        $this->validate($request, [
            'name' => 'required',
            'review' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'rating' => 'integer|max:5',
            'cover_image' => 'image|nullable|max:1999'

        ]);
        
        if($request->hasFile('cover_image')){
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $restaurant = new Restaurant();
        $restaurant->name = $request->input('name');
        $restaurant->review = $request->input('review');
        $restaurant->user_id = auth()->user()->id;
        $restaurant->latitude = $request->input('latitude');
        $restaurant->longitude = $request->input('longitude');
        $restaurant->lat = $request->input('latitude');
        $restaurant->lng = $request->input('longitude');
        $restaurant->address = $request->input('address');
        $restaurant->rating = $request->input('rating');
        
        $restaurant->cover_image = $fileNameToStore;

        $restaurant->save();

        return redirect('/restaurants')->with('success', 'Restaurant Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
        $restaurant = Restaurant::find($id);
        return view('restaurants.show')->with('restaurant', $restaurant);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $restaurant = Restaurant::find($id);
        $comments = Comment::where('restaurant_id', $id)->delete();
        $restaurant->delete();

        return redirect('/restaurants')->with('success', 'Restaurant Removed');
    }

    public function search($name){
        $restaurants = Restaurant::where('name', 'LIKE', "%$name%")->get();
    }
    
}
