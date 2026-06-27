<x-layouts.app title="Gallery - ItzRenzo">
    <!-- Gallery Header -->
    <section class="py-20 px-6 bg-gradient-to-b from-[#0a0a0a] via-[#0a0a0a] to-[#0f0f0f]">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 fade-in">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">
                    Preview <span class="bg-gradient-to-r from-emerald-400 to-cyan-400 bg-clip-text text-transparent">Gallery</span>
                </h1>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    Browse through all screenshots from my Minecraft server setups and configurations
                </p>
                <a href="{{ route('home') }}#gallery" class="inline-flex items-center gap-2 text-emerald-400 hover:text-emerald-300 transition-colors mt-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Home
                </a>
            </div>

            @if($galleries->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($galleries as $index => $gallery)
                        <div class="group relative aspect-video rounded-2xl overflow-hidden bg-gradient-to-br from-emerald-500/10 to-cyan-500/10 border border-white/10 hover:border-emerald-500/50 transition-all duration-300 fade-in cursor-pointer" style="animation-delay: {{ $index * 0.05 }}s;">
                            <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="absolute bottom-4 left-4 right-4">
                                    <p class="text-white font-semibold text-sm">{{ $gallery->title }}</p>
                                    @if($gallery->description)
                                        <p class="text-gray-300 text-xs">{{ $gallery->description }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 bg-white/5 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-lg mb-2">No gallery images available yet</p>
                    <p class="text-gray-500 text-sm">Check back soon for screenshots!</p>
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>
