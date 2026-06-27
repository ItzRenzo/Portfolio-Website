<x-layouts.admin title="Manage Gallery">
    <!-- Add New Gallery Image Button -->
    <div class="mb-6 flex justify-between items-center">
        <p class="text-gray-600 dark:text-gray-400">Manage your preview gallery images</p>
        <button onclick="document.getElementById('addGalleryModal').classList.remove('hidden')" class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-lg text-white font-medium hover:opacity-90 transition-opacity flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Add Gallery Image
        </button>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($galleries as $gallery)
            <div class="bg-white dark:bg-[#0f0f0f] border border-gray-200 dark:border-white/10 rounded-xl overflow-hidden group">
                <!-- Image -->
                <div class="relative aspect-video overflow-hidden bg-gray-100 dark:bg-white/5">
                    <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-3 left-3 right-3">
                            <p class="text-white font-semibold text-sm">{{ $gallery->title }}</p>
                            @if($gallery->description)
                                <p class="text-gray-300 text-xs">{{ $gallery->description }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Info & Actions -->
                <div class="p-4 flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $gallery->title }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Order: {{ $gallery->display_order }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="openEditModal({{ $gallery->id }}, '{{ addslashes($gallery->title) }}', '{{ addslashes($gallery->description ?? '') }}', '{{ $gallery->image_url }}', {{ $gallery->display_order }})" class="text-cyan-400 hover:text-cyan-300 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white dark:bg-[#0f0f0f] border border-gray-200 dark:border-white/10 rounded-xl p-12 text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 dark:bg-white/5 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="text-gray-600 dark:text-gray-400 mb-2">No gallery images yet</p>
                <p class="text-sm text-gray-500 dark:text-gray-500">Add your first screenshot to the gallery!</p>
            </div>
        @endforelse
    </div>

    <!-- Add Gallery Modal -->
    <div id="addGalleryModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-[#0f0f0f] rounded-xl border border-gray-200 dark:border-white/10 max-w-2xl w-full">
            <div class="p-6 border-b border-gray-200 dark:border-white/10 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add Gallery Image</h3>
                <button onclick="document.getElementById('addGalleryModal').classList.add('hidden')" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form action="{{ route('admin.gallery.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title *</label>
                    <input type="text" name="title" required placeholder="e.g., Server Lobby Hub" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                    <input type="text" name="description" placeholder="e.g., Custom designed spawn area" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Image URL *</label>
                    <input type="url" name="image_url" required placeholder="https://example.com/screenshot.jpg" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">Upload your image to a hosting service like Imgur, then paste the direct image URL here</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Display Order</label>
                    <input type="number" name="display_order" value="0" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">Lower numbers appear first</p>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="document.getElementById('addGalleryModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 dark:bg-white/5 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-white/10 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-lg text-white font-medium hover:opacity-90 transition-opacity">
                        Add Image
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Gallery Modal -->
    <div id="editGalleryModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-[#0f0f0f] rounded-xl border border-gray-200 dark:border-white/10 max-w-2xl w-full">
            <div class="p-6 border-b border-gray-200 dark:border-white/10 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Gallery Image</h3>
                <button onclick="document.getElementById('editGalleryModal').classList.add('hidden')" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form id="editGalleryForm" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title *</label>
                    <input type="text" id="edit_title" name="title" required placeholder="e.g., Server Lobby Hub" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                    <input type="text" id="edit_description" name="description" placeholder="e.g., Custom designed spawn area" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Image URL *</label>
                    <input type="url" id="edit_image_url" name="image_url" required placeholder="https://example.com/screenshot.jpg" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">Upload your image to a hosting service like Imgur, then paste the direct image URL here</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Display Order</label>
                    <input type="number" id="edit_display_order" name="display_order" value="0" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-300 dark:border-white/10 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">Lower numbers appear first</p>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="document.getElementById('editGalleryModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 dark:bg-white/5 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-white/10 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-lg text-white font-medium hover:opacity-90 transition-opacity">
                        Update Image
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, title, description, image_url, display_order) {
            document.getElementById('editGalleryForm').action = `/admin/gallery/${id}`;
            document.getElementById('edit_title').value = title;
            document.getElementById('edit_description').value = description;
            document.getElementById('edit_image_url').value = image_url;
            document.getElementById('edit_display_order').value = display_order;
            document.getElementById('editGalleryModal').classList.remove('hidden');
        }
    </script>
</x-layouts.admin>
