<?php

namespace App\Livewire\Postulation;

use App\Models\Announcement;
use App\Models\Postulation;
use App\Models\Setting;
use App\Models\Subsidy;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;

class SubventionsList extends Component
{
    public $subsidies;
    public $announcements;
    public $model_open = false;
    public $activity_items = [];

    public $announcement_selected;
    public $name, $budget, $activity_id, $adviser, $subsidy_id;

    public $limit_postulations;

    public function mount()
    {
        $this->limit_postulations = Setting::where('key', 'limit_postulations')->first()->value;
        $this->subsidies = Subsidy::where('status', 'activo')->get();
        $currentDate = now()->toDateString(); // Obtiene la fecha actual en formato "YYYY-MM-DD"
        $this->announcements = Announcement::whereDate('start', '<=', $currentDate)
            ->whereDate('end', '>=', $currentDate)
            ->get();
    }

    public function selectAnnouncement($announcement_id)
    {
        $this->announcement_selected = Announcement::find($announcement_id);
        $this->activity_items = Subsidy::find($this->announcement_selected->subsidy->id)->activities()->where('status', 'activo')->get();
    }

    public function postulate()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'budget' => 'required|numeric',
            'adviser' => 'nullable|string|max:255',
            'activity_id' => 'required|numeric',
        ]);

        $current_year = Carbon::now()->year;
        $student_id =auth()->user()->student->id;
        $number_of_postulations = Postulation::where('student_id', $student_id)
            ->whereYear('created_at', $current_year)
            ->whereDoesntHave('states', function($query){
                $query->where('state_id', '6'); // 6 == DENEGADO
            })
            ->count();
        
        if($number_of_postulations>=$this->limit_postulations){
            $this->dispatch('message', code: '500', content: 'Ya alcanzó el límite de postulaciones por este año o tiene postulaciones pendientes');
            return;
        }

        if (auth()->user()->is_admin) {
            $this->dispatch('message', code: '500', content: 'Los usuarios admin no pueden postular');
            return;
        }

        $adviser = (trim($this->adviser) == "") ? null : $this->adviser;

        $postulation = Postulation::create([
            'name' => $this->name,
            'budget' => $this->budget,
            'adviser' => $adviser,
            'uuid' => Str::uuid()->toString(),
            'activity_id' => $this->activity_id,
            'student_id' => auth()->user()->student->id,
            'announcement_id' => $this->announcement_selected->id,
        ]);

        $postulation->states()->attach(1); //Asigne el primer estado por defecto

        redirect()->route('postulations.postulate', $postulation);
    }

    public function render()
    {
        return view('livewire.postulation.subventions-list');
    }
}
