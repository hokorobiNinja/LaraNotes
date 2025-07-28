<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Note;
use App\Models\Category;

class SearchNotes extends Component
{
    use WithPagination;

    public $keyword = '';
    public $selectedCategory = '';
    public $categories = [];

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        $query = Note::with(['user', 'category'])
            ->withCount('likes')
            ->latest();

        if($this->keyword) {
            $keywords = preg_split('/[\s　]+/u', $this->keyword, -1, PREG_SPLIT_NO_EMPTY);
            
            $query->where(function($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->Where('title', 'like', '%' . $word . '%')
                      ->orWhere('body', 'like', '%' . $word . '%');
                }
            });
        }

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        $notes = $query->paginate(10);

        return view('livewire.search-notes', [
            'notes' => $notes,
            'categories' => $this->categories,
        ]);
    }
}
