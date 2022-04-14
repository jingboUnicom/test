<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Statamic\Facades\GlobalSet;

class ContactUs extends Component
{
    public $google;
    public $company;

    public function render()
    {
        $this->google = GlobalSet::findByHandle('google')->in('default')->data()->all();
        $this->company = GlobalSet::findByHandle('company')->in('default')->data()->all();

        return view('livewire.contact-us');
    }
}
