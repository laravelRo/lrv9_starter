<?php

namespace App\Http\Controllers\Staff;

use App\Models\Staf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\Staff\AddMemberRequest;
use App\Http\Requests\Staff\EditMemberRequest;

class StaffController extends Controller
{
    //afisam membrii Staff-ului
    public function listStaff()
    {

        if (request('blocked')) {
            $staf = Staf::onlyTrashed()->whereNot('id', 1)->orderBy('name')->paginate();
        } else {

            $staf = Staf::whereNot('id', 1)->orderBy('name')->paginate();
        }

        return view('staff.staf.staf-list')
            ->with('staf', $staf);
    }

    // ====================
    // Adaugarea unui nou membru staff
    // ====================

    //afisam formularul pentru adaugarea noului membru staff
    public function newStaff()
    {
        return view('staff.staf.staf-new');
    }

    //functia pentru adaugarea unui nou membru staff
    public function addStaff(AddMemberRequest $request)
    {
        $request->validate([
            'email' => 'unique:stafs,email',
        ]);
        $staf = new Staf;

        //incarcam imaginea daca exista
        if ($request->hasFile('photo')) {
            //obtinem extensia fisierului
            $extension = $request->file('photo')->getClientOriginalExtension();

            $photo_name = str_replace(' ', '', $request->name) . '_' . time() . '.' . $extension;
            //georgescu_263454328.jpg
            $request->file('photo')->move('images/staff', $photo_name);
            $staf->photo = $photo_name;
        }

        $staf->name = $request->name;
        $staf->email = $request->email;
        $staf->role = $request->role;
        $staf->phone = $request->phone;

        //verificam emailul daca avem bifata optiune
        if ($request->verified) {
            $staf->email_verified_at = now();
        }

        //setam parola
        $staf->password = bcrypt($request->password);

        $staf->save();

        return redirect()->route('staf.list.staf')->with('success', 'A fost creat un nou membru Staff - ' . $request->name);
    }

    // ====================
    // Editarea unui membru staff
    // ====================

    //functia pentru afisarea formularului de editare a unui membru staff
    public function editStaff($id)
    {
        $staf = Staf::findOrFail($id);
        return view('staff.staf.staf-edit')
            ->with('staf', $staf);
    }

    //actualizam datele curente pentru membrul staff selectat
    public function updateStaff(EditMemberRequest $request, $id)
    {
        $request->validate([
            'email' => 'unique:stafs,email,' . $request->id,
        ], [
            'email.unique' => 'Acest email este deja inregistrat in baza de date'
        ]);

        $staf = Staf::findOrFail($id);

        if ($request->hasFile('photo')) {
            //verificam daca utilizatorul are deja o imagine stocata
            if (!($staf->photo == 'user.png')) {
                if (File::exists($staf->photoPath())) {
                    File::delete($staf->photoPath());
                }
            }
            //obtinem extensia fisierului
            $extension = $request->file('photo')->getClientOriginalExtension();
            $photo_name = str_replace(' ', '', $request->name) . '_' . time() . '.' . $extension;
            //georgescu_263454328.jpg
            $request->file('photo')->move('images/staff', $photo_name);
            $staf->photo = $photo_name;
        }

        $staf->name = $request->name;
        $staf->email = $request->email;
        $staf->role = $request->role;
        $staf->phone = $request->phone;

        //verificam emailul daca avem bifata optiune
        if ($request->verified) {
            $staf->email_verified_at = now();
        } else {
            $staf->email_verified_at = null;
        }

        $staf->save();

        return redirect()->back()->with('success', 'Datele pentru - ' . $request->name . ' - au fost actualizate');
    }

    // ====================
    // Editarea unui membru staff
    // ====================
    public function updatePassStaff(Request $request, $id)
    {
        $request->validate(
            [
                'password' => ['required', 'confirmed', Password::min(8)->symbols()->mixedCase()],
            ],
            [
                'password.required' => 'Este necesar sa introduceti o noua parola cu minimum 8 caractere',
                'password.confirmed' => 'Confirmati parola in campul de mai jos',
            ]
        );

        $staf = Staf::findOrfail($id);

        $staf->password = bcrypt($request->password);

        $staf->save();
        return redirect()->back()->with('confirm-pass', 'Parola a fost schimbata! Noua parola este:  ' . $request->password);
    }

    // ====================
    // Blocarea unui membru staff
    // ====================

    public function blockStaff($id)
    {
        $staf = Staf::findOrFail($id);
        $staf_name = $staf->name;
        $staf->delete();
        return back()->with('success', 'Membrul staf - ' . $staf_name . ' - a fost blocat!');
    }

    // ====================
    // Stergerea definitiva a unui embru staff
    // ====================

    public function deleteStaff($id)
    {
        $staf = Staf::onlyTrashed()->findOrFail($id);

        $staf_name = $staf->name;
        $staf->forceDelete();
        //stergem imaginea utilizatorului
        if (!($staf->photo == 'user.png')) {
            if (File::exists($staf->photoPath())) {
                File::delete($staf->photoPath());
            }
        }


        return back()->with('success', 'Membrul staf - ' . $staf_name . ' - a fost sters definitiv din baza de date!');
    }

    public function restoreStaff($id)
    {
        $staf = Staf::onlyTrashed()->findOrFail($id);
        $staf_name = $staf->name;
        $staf->restore();
        return back()->with('success', 'Membrul staf - ' . $staf_name . ' - a fost reactivat!');
    }
}
