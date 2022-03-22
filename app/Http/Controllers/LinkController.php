<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\LinkExpiredMail;
use Illuminate\Support\Facades\Mail;

class LinkController extends Controller
{

    public function index()
    {
        $links = Link::where('user_id', auth()->id())->latest()->paginate(5);

        return view('links.index', compact('links'));
    }


    public function create()
    {
        return view('links.create');
    }


    public function store(Request $request)
    {
        //validate
        $data = $request->validate([
            'link' => 'required|url'
        ]);

        //generate shortcode
        $shortcode = Str::random(3);

        //store
        if(auth()->check()) //authenticated user
        {
            //check if link exists
            $links = auth()->user()->links->pluck('link')->toArray();

            if(in_array($data['link'], $links))
            {
                return back()->with('fail', "You already have this URL!");
            }

            //store new record
            $link = auth()->user()->links()->create([
                'link' => $data['link'],
                'shortcode' => $shortcode,
            ]);
        }

        else //unauthenticated user
        {
            $link = Link::create([
                'link' => $data['link'],
                'shortcode' => $shortcode,
            ]);
        }

        //redirect
        return to_route(auth()->check() ? 'links.index' : 'homepage')
                ->with('success', 'URL successfully shortened to: <a href ="' .
                     url("/" . $link->shortcode) . '" target="_blank">' . env('URL_DOMAIN', 'ellps.co') . '/' . $link->shortcode  .'</a>' );
    }

    public function show($code)
    {
        $link = Link::where('shortcode', $code)->firstOrFail();

        if ($link->user) {
            $this->authorize('view', $link);
        }

        if($link->disabled){
            return back()->with('fail', 'The URL is diabled!');
        }

        return view('links.show', compact('link'));
    }

    public function edit(Link $link)
    {
        $this->authorize('view', $link);

        return view('links.edit', compact('link'));
    }


    public function update(Request $request, Link $link)
    {

        $this->authorize('update', $link);

        $data = $request->validate([
            'link' => 'required|url',
            'disabled' => 'required',
        ]);

        $link->update($data);

        return to_route('links.index')->with('success', 'URL Updated Successfully');
    }


    public function destroy(Link $link)
    {
        $link->delete();

        return to_route('links.index')->with('success', 'Link Deleted Successfully!');
    }

}
