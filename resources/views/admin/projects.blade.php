<x-layouts.admin title="Manage Projects">
    <!-- Add New Project Button -->
    <div class="mb-6 flex justify-between items-center">
        <p class="text-gray-600 dark:text-gray-400">Manage your portfolio projects</p>
        <button onclick="document.getElementById('addProjectModal').classList.remove('hidden')" class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-lg text-white font-medium hover:opacity-90 transition-opacity flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Add New Project
        </button>
    </div>

    <!-- Projects Table -->
    <div class="bg-white dark:bg-[#0f0f0f] border border-gray-200 dark:border-white/10 rounded-xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-white/5 border-b border-gray-200 dark:border-white/10">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">Project</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">Featured</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">Order</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-white/10">
                @forelse($projects as $project)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">{{ $project->emoji }}</span>
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $project->title }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($project->description, 50) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($project->category)
                                <span class="px-2 py-1 bg-emerald-500/10 border border-emerald-500/20 rounded text-xs text-emerald-400">
                                    {{ $project->category }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($project->featured)
                                <span class="px-2 py-1 bg-yellow-500/10 border border-yellow-500/20 rounded text-xs text-yellow-400">
                                    ⭐ Featured
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-gray-600 dark:text-gray-400">{{ $project->display_order }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button onclick="openEditModal({{ $project->id }}, '{{ addslashes($project->title) }}', '{{ addslashes($project->description) }}', '{{ $project->category }}', '{{ $project->emoji }}', '{{ $project->image_url }}', '{{ $project->external_url }}', '{{ is_array($project->tags) ? implode(', ', $project->tags) : '' }}', {{ $project->display_order }}, {{ $project->featured ? 'true' : 'false' }})" class="text-cyan-400 hover:text-cyan-300 transition-colors mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this project?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-600 dark:text-gray-400">
                            No projects yet. Add your first project!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Project Modal -->
    <div id="addProjectModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-[#0f0f0f] rounded-xl border border-gray-200 dark:border-white/10 max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 dark:border-white/10 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add New Project</h3>
                <button onclick="document.getElementById('addProjectModal').classList.add('hidden')" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form action="{{ route('admin.projects.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                    <input type="text" name="title" required class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                    <textarea name="description" required rows="3" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
                        <input type="text" name="category" placeholder="e.g., Survival, Minigame" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Emoji</label>
                        <input type="text" name="emoji" placeholder="🎮" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Image URL</label>
                    <input type="url" name="image_url" placeholder="https://example.com/image.jpg" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">External URL (BuiltByBit, etc.)</label>
                    <input type="url" name="external_url" placeholder="https://builtbybit.com/resources/..." class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tags (comma separated)</label>
                    <input type="text" name="tags" placeholder="Custom GUI, Optimized, Stats Tracking" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Display Order</label>
                        <input type="number" name="display_order" value="0" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    </div>
                    <div class="flex items-end">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="featured" class="w-5 h-5 text-emerald-500 bg-white dark:bg-white/5 border-gray-300 dark:border-white/10 rounded focus:ring-emerald-500">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Featured Project</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="document.getElementById('addProjectModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 dark:bg-white/5 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-white/10 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-lg text-white font-medium hover:opacity-90 transition-opacity">
                        Add Project
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Project Modal -->
    <div id="editProjectModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-[#0f0f0f] rounded-xl border border-gray-200 dark:border-white/10 max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 dark:border-white/10 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Project</h3>
                <button onclick="document.getElementById('editProjectModal').classList.add('hidden')" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form id="editProjectForm" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                    <input type="text" id="edit_title" name="title" required class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                    <textarea id="edit_description" name="description" required rows="3" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
                        <input type="text" id="edit_category" name="category" placeholder="e.g., Survival, Minigame" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Emoji</label>
                        <input type="text" id="edit_emoji" name="emoji" placeholder="🎮" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Image URL</label>
                    <input type="url" id="edit_image_url" name="image_url" placeholder="https://example.com/image.jpg" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">External URL (BuiltByBit, etc.)</label>
                    <input type="url" id="edit_external_url" name="external_url" placeholder="https://builtbybit.com/resources/..." class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tags (comma separated)</label>
                    <input type="text" id="edit_tags" name="tags" placeholder="Custom GUI, Optimized, Stats Tracking" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Display Order</label>
                        <input type="number" id="edit_display_order" name="display_order" value="0" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    </div>
                    <div class="flex items-end">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" id="edit_featured" name="featured" class="w-5 h-5 text-emerald-500 bg-white dark:bg-white/5 border-gray-300 dark:border-white/10 rounded focus:ring-emerald-500">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Featured Project</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="document.getElementById('editProjectModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 dark:bg-white/5 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-white/10 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-lg text-white font-medium hover:opacity-90 transition-opacity">
                        Update Project
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, title, description, category, emoji, image_url, external_url, tags, display_order, featured) {
            document.getElementById('editProjectForm').action = `/admin/projects/${id}`;
            document.getElementById('edit_title').value = title;
            document.getElementById('edit_description').value = description;
            document.getElementById('edit_category').value = category;
            document.getElementById('edit_emoji').value = emoji;
            document.getElementById('edit_image_url').value = image_url;
            document.getElementById('edit_external_url').value = external_url;
            document.getElementById('edit_tags').value = tags;
            document.getElementById('edit_display_order').value = display_order;
            document.getElementById('edit_featured').checked = featured;
            document.getElementById('editProjectModal').classList.remove('hidden');
        }
    </script>
</x-layouts.admin>

