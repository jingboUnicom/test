<?php

namespace App\Http\Livewire;

use App\Models\State;
use App\Models\Vacancy;
use Livewire\Component;
use App\Models\Category;
use App\Models\Location;
use Statamic\Facades\Entry;
use Statamic\Facades\GlobalSet;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Jobs extends Component
{
    public $content;
    public $classifications;
    public $locations;

    public $keyword;
    public $classification;
    public $location;

    public $total;
    public $per_page;
    public $per_page_increase;
    public $can_load_more;

    public function mount(): void
    {
        $this->content = GlobalSet::findByHandle('job_board')->in('default')->data()->all();
        $this->classifications = Category::get(['id', 'name'])->pluck('name', 'id')->all();
        $this->locations = Location::get(['id', 'name'])->pluck('name', 'id')->all();

        $this->keyword = Session::get('keyword');
        $this->classification = Session::get('classification');
        $this->location = Session::get('location');

        $this->per_page = 2;
        $this->per_page_increase = 1;
        $this->can_load_more = true;
    }
    public function getVacanciesProperty(): LengthAwarePaginator
    {
        $vacancies = Vacancy::where('status', Vacancy::STATUS_SYNCED)
            ->whereHas('state', fn ($query) => $query->where('name', State::STATE_CURRENT))
            ->when(
                $this->keyword,
                fn ($query, $value) =>
                $query->where(function ($query) use ($value) {
                    foreach (explode(' ', $value) as $value) {
                        $query->orWhere('job_title', 'LIKE', "%{$value}%");
                        // $query->orWhere('short_description', 'LIKE', "%{$value}%");
                        // $query->orWhere('job_description', 'LIKE', "%{$value}%");
                    }
                })
            )
            ->when($this->classification, fn ($query, $value) => $query->whereHas('category', fn ($query) => $query->where('id', $value)))
            ->when($this->location, fn ($query, $value) => $query->whereHas('location', fn ($query) => $query->where('id', $value)))
            ->with(['work', 'category', 'location']);

        $this->total = $vacancies->get()->count();

        return  $vacancies->paginate($this->per_page);
    }

    public function loadMore(): void
    {
        $this->per_page += $this->per_page_increase;
        $this->can_load_more = $this->per_page > $this->vacancies->total() ? false : true;
    }

    public function resetFilters()
    {
        $this->mount();
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
        return view('livewire.jobs', [
            'vacancies' => $this->vacancies,
        ]);
    }
}
