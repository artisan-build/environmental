<?php

namespace ArtisanBuild\Environmental\Livewire;

use ArtisanBuild\Environmental\Environment;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class EditEnvironmentFile extends Component implements HasForms
{
    use InteractsWithForms;
    use InteractsWithForms;

    public array $data = [];
    public array $original = [];
    public array $dirty = [];

    public string $file = '.env';

    public function mount(string $file = '.env')
    {

        $this->original = $this->data = Environment::where('id', $this->file)->first()->toArray();
        $this->file = $file;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(collect($this->data)->map(function ($value, $key) {
                return TextInput::make('data.' . $key)
                    ->default($value)
                    ->lazy()
                    ->label($key);
            })->except('id')->toArray());
    }

    public function updated($property): void
    {
        $this->getDirty();
    }

    public function getDirty(): void
    {
        $this->dirty = collect($this->data)->filter(function ($value, $key) {
            return $this->original[$key] !== $value;
        })->mapWithKeys(function($value, $key) {
            return [$key => ['original' => $this->original[$key], 'new' => $value]];
        })->toArray();
    }

    public function save()
    {
        // Show the diff, file name, and get confirmation to write the changes
        // Make a backup of the file
        // Write the new file
        // Update the metadata json
        // Purge any expired, extraneous backups
        // Tell the user the file was saved and present a refresh button to see the form with new data
    }

    public function render()
    {
        return view('environmental::edit')
            ->layout(config('environmental.form_layout'));
    }

}
