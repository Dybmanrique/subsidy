<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Livewire\Component;

class Form extends Component
{
    public $limit_postulations, $subsidy_link, $regulation_link, $cover_image, $unasam_link, $vicerrectorate_link;

    public function save()
    {
        $this->validate([
            'limit_postulations' => 'required|numeric|min:1|max:100',
            'subsidy_link' => 'required|string|max:800',
            'regulation_link' => 'required|string|max:800',
            'cover_image' => 'required|string|max:800',
            'unasam_link' => 'required|string|max:800',
            'vicerrectorate_link' => 'required|string|max:800',
        ]);

        Setting::where('key', 'limit_postulations')->first()->update(['value' => $this->limit_postulations]);
        Setting::where('key', 'subsidy_link')->first()->update(['value' => $this->subsidy_link]);
        Setting::where('key', 'regulation_link')->first()->update(['value' => $this->regulation_link]);
        Setting::where('key', 'cover_image')->first()->update(['value' => $this->cover_image]);
        Setting::where('key', 'unasam_link')->first()->update(['value' => $this->unasam_link]);
        Setting::where('key', 'vicerrectorate_link')->first()->update(['value' => $this->vicerrectorate_link]);
        $this->dispatch('message', code: '200', content: 'Se actualizaron los parámetros');
    }

    public function mount()
    {
        $this->limit_postulations = Setting::where('key', 'limit_postulations')->first()->value;
        $this->subsidy_link = Setting::where('key', 'subsidy_link')->first()->value;
        $this->regulation_link = Setting::where('key', 'regulation_link')->first()->value;
        $this->cover_image = Setting::where('key', 'cover_image')->first()->value;
        $this->unasam_link = Setting::where('key', 'unasam_link')->first()->value;
        $this->vicerrectorate_link = Setting::where('key', 'vicerrectorate_link')->first()->value;
    }

    public function render()
    {
        return view('livewire.admin.settings.form');
    }
}
