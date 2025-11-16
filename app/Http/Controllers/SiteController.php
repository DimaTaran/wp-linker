<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sites = Site::with(['servers', 'cdns', 'wpCredentials'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('sites.index', compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('sites.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:sites,domain',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:active,suspended,archived',
        ]);

        $site = Site::create($validated);

        return redirect()
            ->route('sites.show', $site)
            ->with('success', 'Site created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Site $site): View
    {
        $site->load([
            'wpCredentials',
            'servers.credentials',
            'cdns.credentials',
        ]);

        return view('sites.show', compact('site'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site): View
    {
        return view('sites.edit', compact('site'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:sites,domain,' . $site->id,
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:active,suspended,archived',
        ]);

        $site->update($validated);

        return redirect()
            ->route('sites.show', $site)
            ->with('success', 'Site updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site): RedirectResponse
    {
        $siteName = $site->name;
        $site->delete();

        return redirect()
            ->route('sites.index')
            ->with('success', "Site '{$siteName}' deleted successfully.");
    }
}
