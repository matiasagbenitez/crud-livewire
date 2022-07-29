<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $open = false;
    public $title, $content, $image, $identifier;
    protected $rules = ['title' => 'required', 'content' => 'required', 'image' => 'required|image|max:1024'];

    public function mount()
    {
        $this->identifier = rand();
    }

    public function save()
    {
        $data = $this->validate();

        // Almacenamos la imagen
        $imagePath = $this->image->store('posts');
        $data['image'] = str_replace('posts/', '', $imagePath);

        Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'image' => $data['image']
        ]);

        $this->reset(['open', 'title', 'content', 'image']);
        $this->emitTo('show-posts', 'createdPost');
        $this->emit('alert', 'Post created succesfully!');

        $this->identifier = rand();
    }

    // Validación en tiempo real
    // public function updated($fieldName)
    // {
    //     $this->validateOnly($fieldName);
    // }

    public function render()
    {
        return view('livewire.create-post');
    }
}
