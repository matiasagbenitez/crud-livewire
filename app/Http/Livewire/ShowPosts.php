<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'id';
    public $direction = 'DESC';
    public $count = '10';

    protected $listeners = ['createdPost' => 'render'];
    protected $queryString = [
        'count' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'DESC'],
        'search' => ['except' => '']
    ];

    public function order($sort)
    {
        if ($this->sort === $sort) {
            if ($this->direction == 'ASC') {
                $this->direction = 'DESC';
            } else {
                $this->direction = 'ASC';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'ASC';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $posts = Post::where('title', 'LIKE', '%' . $this->search . '%')->
                orwhere('content', 'LIKE', '%' . $this->search . '%')->
                orderBy($this->sort, $this->direction)->paginate($this->count);

        return view('livewire.show-posts', compact('posts'));
    }
}
