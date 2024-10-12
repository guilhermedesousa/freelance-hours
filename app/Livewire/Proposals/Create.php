<?php

namespace App\Livewire\Proposals;

use App\Models\Project;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    public Project $project;
    public bool $modal = false;
    #[Rule(['required', 'email'])]
    public string $email = '';
    #[Rule(['required', 'integer', 'min:1'])]
    public int $hours = 0;

    public bool $agree = false;

    public function save() {
        $this->validate();

        if (!$this->agree) {
            $this->addError('agree', 'Você precisa aceitar os termos.');
            return;
        }

        $this->project->proposals()->updateOrCreate(
            ['email' => $this->email],
            ['hours' => $this->hours]
        );
        $this->modal = false;
    }

    public function render()
    {
        return view('livewire.proposals.create');
    }
}
