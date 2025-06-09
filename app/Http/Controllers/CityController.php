<?php

namespace App\Http\Controllers;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
   
    public function index()
    {
        $cities = City::all();
        return view('cities.index', compact('cities'));
    }

  
    public function create(Request $request)
    {
        // get path where it' request come.
        $referrer = $request->headers->get('referer');
        //Log::info($referrer);
        if($referrer){
            $referrerPath = parse_url($referrer, PHP_URL_PATH);
          //  Log::info($referrerPath);
            session(['referrerPathCity' => $referrerPath]);
        }

       return view('cities.create');   
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'city_name' => 'required|unique:cities', 
        //     'delivery_charge' => 'required|numeric', 
        //     'status' => 'required'
        // ]);
        $request->merge([
             'status' => $request->status == 'Active' ? 'Y' : 'N',
        ]);
        City::create($request->all());
        
        // After get redirect path remove it.
        $referrerPath = session('referrerPathCity');
        session()->forget('referrerPathCity');
        //Log::info($referrerPath);

        if ($referrerPath && strpos($referrerPath, '/customers/create') !== false) {
            return redirect()->route('customers.create')->with('success', 'City created successfully.');
        } else {
            return redirect()->route('cities.index')->with('success', 'City created successfully.');
        }
    }

    public function edit($id)
    {
        $city = City::findOrFail($id);
        return view('cities.edit', compact('city'));
    }
   
    public function update(Request $request, City $city) 
      {
         $request->validate([
            'city_name' => 'required|string|unique:cities,city_name,' . $city->id,
            'delivery_charge' => 'required|numeric', 
            'status' => 'required'
        ]);
        
        $request->merge([
            'status' => $request->status == 'Active' ? 'Y' : 'N',
        ]);
        $city->update($request->all());
        return redirect()->route('cities.index')->with('success', 'City updated successfully.');
      }
    public function destroy(City $city) 
    {
        $city->delete();
        return redirect()->route('cities.index')->with('success', 'City deleted successfully.');
    }
}
