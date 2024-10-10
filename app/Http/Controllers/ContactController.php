<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->has('nameS')) {
            $search = $request->input('nameS');
            $query->where('name', 'like',   "%{$search}%");
        }
        if ($request->has('emailS')) {
            $search = $request->input('emailS');
            $query->where('email', 'like', "%{$search}%");
        }
        if ($request->has('phoneS')) {
            $search = $request->input('phoneS');
            $query->where('phone', 'like', "%{$search}%");
        }

        $contacts = $query->orderBy('created_at', 'DESC')->paginate(10);

        return view('contacts.index', compact('contacts'));
    }

    // public function index()
    // {
    //     $contacts = Contact::all();
    //     return view('contacts.index', compact('contacts'));
    // }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:contacts',
            'phone' => ['required', 'regex:/^[0-9]{10}$/'],
        ]);

        Contact::create($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required|max:255',
            // 'email' => 'required'/*|email|unique:contacts,email,' . $contact->id*/,
            'phone' => 'required',
        ]);
        //    $contact = Contact::find($id);
        $vasl = $contact->update($request->all());
        return redirect()->route('contacts.index');
    }

    public function destroy(Contact $contact)
    {
        // echo "<pre>";
        // print_r($contact->toArray());
        // die;
        if ($contact->delete())
            return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }

    public function modal(Request $request)
    {
        // echo "$request->id";

        $contact = Contact::findOrFail($request->id);
        if (!empty($contact))
            return response()->json(['contact' => $contact], 200);
        else
            return response()->json(['message' => 'Contact not found'], 404);
    }
    // public function search(Request $request)
    // {
    //     /* 
    //    $search = $request->search;
    //     $brand = Brand::where('name', 'like', "%{$search}%")
    //         ->orWhere('id', 'like', "{$search}")
    //         ->get();
    //     return response()->json($brand, 200);
    //     */

    //     // $query = $request->input('s');
    //     // $brand = Brand::where('name', 'like', "%{$query}%")
    //     //     ->orwhere('brand_code', 'like', "%{$query}%")
    //     //     ->get();
    //     // return response()->json($brand, 200);
    // }

    // Another method
    // public function search(Request $request)
    // {


    //     $query = Brand::query();
    //     if ($request->filled('id')) {
    //         $query->where('id', $request->id);
    //     }
    //     if ($request->filled('name')) {
    //         $query->where('name', 'LIKE', "%{$request->name}%");
    //     }
    //     if ($request->filled('brand_code')) {
    //         $query->where('brand_code', 'LIKE', "%{$request->brand_code}%");
    //     }

    //     if ($request->filled('company_id')) {
    //         $query->where('company_id', $request->company_id);
    //     }

    //     if ($request->filled('c_primary_email')) {
    //         $query->where('c_primary_email', 'LIKE', "%{$request->c_primary_email}%");
    //     }
    //     if ($request->filled('status')) {
    //         $query->where('status', 'LIKE', "%{$request->status}%");
    //     }


    //     $brands = $query->get();

    //     if ($brands->isEmpty()) {
    //         return response()->json(['message' => 'No results found for the search criteria.'], 404);
    //     }
    //     return response()->json($brands);
    // }

}
