<main class="container mx-auto p-4 md:p-8 max-w-7xl">
    <div class="mb-8 p-6 bg-white rounded-xl shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
        <div>
            <label for="category" class="block text-sm font-medium text-gray-700">カテゴリ</label>
            <select wire:model.live="selectedCategory" id="category" name="category" class="mt-1 block w-full pl-3 pr-10 py-2 text-base rounded-md border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="">すべて</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>  
            @endforeach
            </select>
        </div>
        <div class="md:col-span-2">
            <label for="keyword" class="block text-sm font-medium text-gray-700">キーワード</label>
            <div class="mt-1 rounded-md shadow-sm">
                <input wire:model.live.debounce.300ms="keyword" type="text" name="keyword" id="keyword" class="block w-full py-2 rounded-md sm:text-sm border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="記事を検索...">
            </div>
        </div>
        </div>
    </div>

    <ul class="space-y-6">
        @foreach($notes as $note)
            <li wire:key="{{ $note->id }}" class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">
                        <a href="#" class="hover:text-indigo-600">{{ $note->title }}</a>
                    </h2>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-sm text-gray-500 space-x-4">
                            <span>カテゴリ: <a href="#" class="font-medium text-indigo-500 hover:underline">{{ $note->category->name }}</a></span>
                            <span>投稿者: <a href="#" class="font-medium text-indigo-500 hover:underline">{{ $note->user->name }}</a></span>
                            <span>投稿日: {{ $note->created_at }}</span>
                        </div>
                        <button class="flex items-center space-x-2 text-gray-500 hover:text-red-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span class="font-medium">{{ $note->likes_count }}</span>
                        </button>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</main>

