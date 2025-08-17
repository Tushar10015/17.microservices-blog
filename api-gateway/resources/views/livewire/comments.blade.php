<div class="p-4 border rounded-lg mt-4">
    <h3 class="text-lg font-bold mb-2">Comments</h3>

    {{-- Comment List --}}
    <div class="space-y-2 mb-4">
        @forelse($this->comments as $comment)
        <div class="p-2 bg-gray-100 rounded">
            <strong>{{ $comment['user']['name'] ?? 'Unknown' }}</strong>:
            {{ $comment['content'] }}
        </div>
        @empty
        <p class="text-gray-500">No comments yet.</p>
        @endforelse
    </div>

    {{-- Add Comment Form --}}
    <form wire:submit.prevent="addComment" class="flex space-x-2">
        <input type="text" wire:model.defer="body" class="flex-1 border p-2 rounded" placeholder="Write a comment...">
        <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded">Send</button>
    </form>

    @error('body') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    @if (session()->has('message')) <p class="text-green-500 text-sm">{{ session('message') }}</p> @endif
    @if (session()->has('error')) <p class="text-red-500 text-sm">{{ session('error') }}</p> @endif
</div>