<?php

namespace App\Livewire;

use Livewire\Component;

class BackupModal extends Component
{
    public $showModalA = false;
    public $showModalB = false;
    public $days;

    public function mount($days = null)
    {
        $this->days = $days;
    }

    public function toggleModalA()
    {
        $this->showModalA = !$this->showModalA;
    }

    public function toggleModalB()
    {
        $this->showModalB = !$this->showModalB;
    }

    public function render()
    {
        return view('livewire.backup-modal');
    }
}
