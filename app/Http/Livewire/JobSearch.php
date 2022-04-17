<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Location;
use Statamic\Facades\Entry;
use Statamic\Facades\GlobalSet;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class JobSearch extends Component
{
    public $content;
    public $classifications;
    public $locations;

    public $keyword;
    public $classification;
    public $location;

    public function mount(): void
    {
        $this->content = GlobalSet::findByHandle('job_board')->in('default')->data()->all();
        $this->classifications = Category::orderBy('name', 'asc')->get(['id', 'name'])->pluck('name', 'id')->all();
        $this->locations = Location::orderBy('name', 'asc')->get(['id', 'name'])->pluck('name', 'id')->all();
    }

    public function submit(): mixed
    {
        Session::flash('keyword', $this->keyword);
        Session::flash('classification', $this->classification);
        Session::flash('location', $this->location);

        return redirect(Entry::find(explode('::', $this->content['link_search'])[1])->toArray()['url']);
    }

    public function render(): View
    {
        return view('livewire.job-search');
    }
}
