<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
//    public function collection()
//    {
////        return
//    }

    public $users;

    public function __construct($users)
    {
        $this->users = $users;
    }


    public function view(): View
    {
        return view('files.excel_file', [
            'users' => $this->users
        ]);
    }
}
