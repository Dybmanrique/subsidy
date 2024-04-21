<?php

namespace App\Livewire\Admin\Postulations;

use App\Models\BlackList as ModelsBlackList;
use Livewire\Component;

class BlackList extends Component
{
    public $postulation;
    public $black_list;
    public $email, $reason;
    public $id_item_selected, $reason_item_selected;

    public function save() {
        $this->validate([
            'email' => 'required|email|max:255|unique:black_list,email|regex:/^.*@unasam\.edu\.pe$/',
            'reason' => 'required|string',
        ]);
        
        try {
            $item = ModelsBlackList::create($this->only(['email','reason']));
            $this->reset(['email','reason']);
            $this->dispatch('message', code: '200', content: 'Hecho');
            $this->dispatch('email_saved', email: $item->email, id: $item->id);
        } catch (\Exception $ex) {
            $this->dispatch('message', code: '500', content: 'Algo salió mal');
        }
    }

    public function show_reason(){
        try {
            $item = ModelsBlackList::find($this->id_item_selected);
            if($item){
                $this->reason_item_selected = $item->reason;
            }
        } catch (\Exception $ex) {
            $this->dispatch('message', code: '500', content: 'Algo salió mal');
        }
    }
    
    public function mount(){
        $this->black_list = ModelsBlackList::all();
    }

    public function render()
    {
        return view('livewire.admin.postulations.black-list');
    }
}
