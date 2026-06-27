<x-layouts.admin title="Dashboard">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Projects -->
        <div class="bg-white dark:bg-[#0f0f0f] border border-gray-200 dark:border-white/10 rounded-xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Projects</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $projectsCount }}</p>
                </div>
                <div class="w-12 h-12 bg-emerald-500/10 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Featured Projects -->
        <div class="bg-white dark:bg-[#0f0f0f] border border-gray-200 dark:border-white/10 rounded-xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Featured Projects</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $featuredProjectsCount }}</p>
                </div>
                <div class="w-12 h-12 bg-cyan-500/10 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Gallery Images -->
        <div class="bg-white dark:bg-[#0f0f0f] border border-gray-200 dark:border-white/10 rounded-xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Gallery Images</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $galleryCount }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-500/10 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white dark:bg-[#0f0f0f] border border-gray-200 dark:border-white/10 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('admin.projects') }}" class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-white/5 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                <div class="w-10 h-10 bg-emerald-500/10 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-900 dark:text-white">Add New Project</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Create a new portfolio project</p>
                </div>
            </a>

            <a href="{{ route('admin.gallery') }}" class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-white/5 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                <div class="w-10 h-10 bg-purple-500/10 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-900 dark:text-white">Add Gallery Image</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Upload new gallery screenshot</p>
                </div>
            </a>
        </div>
    </div>
</x-layouts.admin>
