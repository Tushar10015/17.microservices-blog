<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-white">Post Management</h1>

    {{-- Form --}}
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form wire:submit.prevent="save" class="space-y-4">
            <div>
                <input type="text" wire:model="title" placeholder="Enter post title"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <textarea wire:model="content" placeholder="Write your post content here" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
            </div>
            <div class="flex space-x-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition duration-200">
                    {{ $postId ? 'Update Post' : 'Create Post' }}
                </button>
                @if($postId)
                <button type="button" wire:click="resetForm"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md transition duration-200">
                    Cancel
                </button>
                @endif
            </div>
        </form>
    </div>

    {{-- Posts List --}}
    <div class="bg-white rounded-lg shadow-md overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($posts as $post)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $post['id'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $post['title'] }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($post['content'], 50) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <button wire:click="edit({{ $post['id'] }})"
                            class="text-yellow-600 hover:text-yellow-900 hover:bg-yellow-100 px-3 py-1 rounded-md transition duration-200">
                            Edit
                        </button>
                        <button wire:click="delete({{ $post['id'] }})"
                            class="text-red-600 hover:text-red-900 hover:bg-red-100 px-3 py-1 rounded-md transition duration-200"
                            onclick="return confirm('Are you sure you want to delete this post?')">
                            Delete
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No posts found. Create your first post above!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>