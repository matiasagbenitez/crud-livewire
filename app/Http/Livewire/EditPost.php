<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPost extends Component
{
    use WithFileUploads;

    public $open = false;
    public $post_id, $title, $content, $image;
    public $newImage;
    public $identifier;

    protected $rules = ['title' => 'required', 'content' => 'required', 'image' => 'required'];

    public function mount(Post $post)
    {
        $this->post_id = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->image = $post->image;

        $this->identifier = rand();
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->newImage) {
            $imagePath = $this->newImage->store('posts');
            $data['image'] = str_replace('posts/', '', $imagePath);
        }

        $post = Post::find($this->post_id);

        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->image = $data['image'] ?? $post->image;

        $post->save();

        $this->reset(['open', 'newImage']);
        $this->identifier = rand();
        $this->emitTo('show-posts', 'createdPost');

        $this->emit('alert', 'Post updated succesfully!');

    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
