<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        // Get all social networks
        $socialNetworks = \App\Models\SocialNetwork::orderBy('name')->get();
        $user = $request->user();
        $user->load('socialNetworks.socialNetwork');
        return Inertia::render('Profile/Edit', compact('user', 'socialNetworks'));
    }

    /**
     * Display the password change form.
     */
    public function changePassword(Request $request): Response
    {
        return Inertia::render('Profile/ChangePassword', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's photos.
     */
    public function uploadAsset(Request $request): HttpResponse
    {
        $user = $request->user();

        $request->validate([
            'banner_picture' => ['nullable', 'image', 'max:16384'],
            'profile_picture' => ['nullable', 'image', 'max:16384'],
            'logo' => ['nullable', 'image', 'max:16384'],
            'icon' => ['nullable', 'image', 'max:2048'],
            'file' => ['nullable', 'file', 'max:16384', 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip'],
        ]);
        
        if ($request->hasFile('banner_picture')) {
            $user->banner_picture = Storage::url($request->file('banner_picture')->store('public'.DIRECTORY_SEPARATOR.$user->id.DIRECTORY_SEPARATOR.'banners'));
            $url = $user->banner_picture;
        } elseif ($request->hasFile('profile_picture')) {
            $manager = new ImageManager(Driver::class);
            $scaled_image = $manager->read($request->file('profile_picture'));
            $scaled_image->cover(400, 400);
            $user->profile_picture = Storage::url($request->file('profile_picture')->store('public'.DIRECTORY_SEPARATOR.$user->id.DIRECTORY_SEPARATOR.'profile_pictures'));
            $scaled_image->save(storage_path().'/app'.str_replace('storage', 'public', $this->getResizedFileName($user->profile_picture)));
            $url = $user->profile_picture;
        } elseif ($request->hasFile('logo')) {
            $manager = new ImageManager(Driver::class);
            $scaled_image = $manager->read($request->file('logo'));
            $scaled_image->resize(400, 400);
            $user->logo = Storage::url($request->file('logo')->store('public'.DIRECTORY_SEPARATOR.$user->id.DIRECTORY_SEPARATOR.'logos'));
            $scaled_image->save(storage_path().'/app'.str_replace('storage', 'public', $this->getResizedFileName($user->logo)));
            $url = $user->logo;
        } elseif ($request->hasFile('icon')) {
            $url = Storage::url($request->file('icon')->store('public'.DIRECTORY_SEPARATOR.$user->id.DIRECTORY_SEPARATOR.'icons'));
        } elseif ($request->hasFile('file')) {
            $url = Storage::url($request->file('file')->store('public'.DIRECTORY_SEPARATOR.$user->id.DIRECTORY_SEPARATOR.'files'));
        }

        $user->save();

        return $request->wantsJson()
                    ? new HttpResponse(['message' => 'Uploaded Successfully', 'url' => $url], 200)
                    : back()->with('status', 'profile-photo-updated');
    }

    public function getResizedFileName($path)
    {
        return strrev(str_replace('.', '.004_', strrev($path)));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): HttpResponse
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'max:255', 'alpha_dash', 'unique:users,username,'.$request->user()->id],
            'email' => ['required', 'email'],
            'custom_tnc' => ['nullable', 'max:5000', 'string'],
            'bio' => ['nullable', 'max:500'],
            'phone' => ['nullable', 'max:255'],
            'website' => ['nullable', 'max:255'],
            'social_networks' => ['nullable', 'array'],
            'social_networks.*.id' => ['nullable', 'integer'],
            'social_networks.*.custom_icon_url' => ['nullable', 'string'],
            'social_networks.*.social_network_id' => ['required', 'integer'],
            'social_networks.*.url' => ['required', 'max:255'],
            'social_networks.*.name' => ['required', 'max:255'],
        ]);


        $request->user()->fill($request->all());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        $socialNetworks = $request->input('social_networks');
        $user = $request->user();
	    $existingSocialNetworks = $user->socialNetworks()->pluck('id')->toArray();

        // Remove social networks that were deleted
        $user->socialNetworks()->whereNotIn('id', array_column($socialNetworks, 'id'))->delete();

        foreach ($socialNetworks as $order => $socialNetwork) {
            $social_network_id = $socialNetwork['social_network_id'];
            $url = $socialNetwork['url'];
            $name = $socialNetwork['name'];
            $custom_icon_url = $socialNetwork['custom_icon_url'] ?? null;

            $data = compact('social_network_id', 'url', 'name', 'order', 'custom_icon_url');

            if (isset($socialNetwork['id']) && in_array($socialNetwork['id'], $existingSocialNetworks)) {
                // Update existing social network
                $user->socialNetworks()->where('id', $socialNetwork['id'])->update($data);
            } else {
                // Create new social network
                $user->socialNetworks()->create($data);
            }
	}
        $user->load('socialNetworks.socialNetwork');

        return $request->wantsJson()
                    ? new HttpResponse(['message' => 'Profile Updated Successfully', 'user' => $user], 200)
                    : back()->with('status', 'profile-information-updated');

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function publicProfile($username)
    {
        $user = \App\Models\User::where('username', $username)->with('socialNetworks.socialNetwork')->firstOrFail();
        return $this->renderProfileView($user);
    }

    public function publicProfileId($id)
    {
        $user = \App\Models\User::find($id);
        if(!$user)
        {
            return redirect()->route('home');
        }
        if($user->username)
        {
            return redirect()->route('public_profile', $user->username);
        }
        return $this->renderProfileView($user);
    }

    public function renderProfileView($user)
    {

        if($user->profile_picture)
        {
            $user->profile_picture_base64 = base64_encode(Storage::get(str_replace('storage', 'public', $this->getResizedFilename($user->profile_picture))));
        }
        if($user->logo)
        {
            $user->logo_base64 = base64_encode(Storage::get(str_replace('storage', 'public', $this->getResizedFilename($user->logo))));
        }
        event(new \App\Events\ProfileVisited($user->id));
        $networks = \App\Models\SocialNetwork::all();
        return Inertia::render('PublicProfile', compact('user', 'networks'));
    }

    public function deleteAsset($type, Request $request)
    {
        $user = $request->user();
        switch($type)
        {
            case 'profile_picture':
                Storage::delete(str_replace('storage', 'public', $user->profile_picture));
                $user->profile_picture = null;
                break;
            case 'logo':
                Storage::delete(str_replace('storage', 'public', $user->logo));
                $user->logo = null;
                break;
            case 'banner_picture':
                Storage::delete(str_replace('storage', 'public',$user->banner_picture));
                $user->banner_picture = null;
                break;
        }
        $user->save();

        return $request->wantsJson()
                    ? new HttpResponse(['message' => ucwords(str_replace('_', ' ',$type)).' Deleted Successfully'], 200)
                    : back()->with('status', 'banner-deleted');
    }

    public function connectRequest(Request $request)
    {

        $request->validate([
            'user_id' => ['required', 'integer'],
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'max:255'],
            'company_name' => ['nullable', 'max:255'],
            'title' => ['nullable', 'max:255'],
            'message' => ['nullable', 'max:500'],
            'terms' => ['required', 'accepted'],
        ], [
            'terms.accepted' => 'Please fill out all required fields.',
            'email.required' => 'Please fill out all required fields.',
            'name.required' => 'Please fill out all required fields.',
            'phone.required' => 'Please fill out all required fields.',
        ]);

        // store the request as a ContactRequest and email the user about it

        $contactRequest = new \App\Models\ContactRequest($request->all());
        $contactRequest->save();

        $user = \App\Models\User::find($request->user_id);
        if(!isset($user->customization['connect_email_notificaions']) || boolval($user->customization['connect_email_notificaions']))
        {
            event(new \App\Events\ContactRequestReceived($user, $contactRequest));
        }

        return $request->wantsJson()
                    ? new HttpResponse(['message' => 'Connection saved successfully!', 'success' => true], 200)
                    : back()->with('status', 'request-sent');

    }

    public function storeChangePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password),
        ]);

        return $request->wantsJson()
                    ? new HttpResponse(['message' => 'Password Changed Successfully'], 200)
                    : back()->with('status', 'password-updated');

    }

    public function clickTracker($network, Request $request)
    {
        event(new \App\Events\LinkClicked($network));

        return $request->wantsJson()
                    ? new HttpResponse(['message' => 'Click Tracked Successfully', 'success' => true], 200)
                    : back()->with('status', 'click-tracked');
    }

}
