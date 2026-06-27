<x-layouts.app title="ItzRenzo - Minecraft Developer Portfolio">
    <!-- Hero Section -->
    <section id="about" class="min-h-screen flex items-center justify-center px-6 bg-gradient-to-b from-[#0a0a0a] via-[#0a0a0a] to-[#0f0f0f]">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6 fade-in">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500/10 border border-emerald-500/20 rounded-full text-sm text-emerald-400">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    Available for Projects
                </div>
                
                <h1 class="text-5xl md:text-7xl font-bold leading-tight">
                    Hi, I'm <span class="bg-gradient-to-r from-emerald-400 to-cyan-400 bg-clip-text text-transparent">ItzRenzo</span>
                </h1>
                
                <p class="text-xl text-gray-400 leading-relaxed">
                    I create high-quality <span class="text-white font-semibold">Minecraft server setups</span> and develop <span class="text-white font-semibold">custom plugins</span> designed for server owners who want a clean, optimized, and professional server experience. From gameplay mechanics and plugin development to polished menus and configurations, my work is crafted to ensure minimal hassle and maximum performance.
                </p>
                
                <div class="flex flex-wrap gap-4">
                    <a href="#projects" class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-lg font-medium hover:opacity-90 transition-opacity inline-flex items-center gap-2">
                        View Projects
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="#contact" class="px-6 py-3 bg-white/5 border border-white/10 rounded-lg font-medium hover:bg-white/10 transition-colors">
                        Get in Touch
                    </a>
                </div>
                
                <div class="flex items-center gap-6 pt-4">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white">{{ $totalProjects }}+</div>
                        <div class="text-sm text-gray-400">Projects</div>
                    </div>
                    <div class="h-12 w-px bg-white/10"></div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white">3+</div>
                        <div class="text-sm text-gray-400">Years Experience</div>
                    </div>
                    <div class="h-12 w-px bg-white/10"></div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white">20+</div>
                        <div class="text-sm text-gray-400">Clients</div>
                    </div>
                </div>
            </div>
            
            <div class="relative fade-in delay-200">
                <div class="relative w-full aspect-square max-w-lg mx-auto">
                    <!-- Animated gradient background -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-emerald-500/20 to-cyan-500/20 rounded-3xl blur-3xl animate-pulse"></div>
                    
                    <!-- Profile image -->
                    <div class="relative bg-gradient-to-br from-emerald-500 to-cyan-500 rounded-3xl p-1 shadow-2xl">
                        <div class="bg-[#0a0a0a] rounded-3xl p-8 h-full flex items-center justify-center">
                            <div class="text-center space-y-4">
                                <div class="w-48 h-48 mx-auto bg-gradient-to-br from-emerald-500/20 to-cyan-500/20 rounded-full overflow-hidden border-4 border-emerald-500/20">
                                    <img src="https://cdn.builtbybit.com/avatars/o/435/435252.jpg?1730998482" alt="ItzRenzo Profile" class="w-full h-full object-cover">
                                </div>
                                <div class="space-y-2">
                                    <h3 class="text-2xl font-bold text-white">Minecraft Developer</h3>
                                    <p class="text-gray-400">Server Setups & Plugin Development</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating elements -->
                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl backdrop-blur-sm flex items-center justify-center animate-bounce">
                        <span class="text-2xl">⚔️</span>
                    </div>
                    <div class="absolute -bottom-4 -left-4 w-20 h-20 bg-cyan-500/10 border border-cyan-500/20 rounded-2xl backdrop-blur-sm flex items-center justify-center animate-bounce" style="animation-delay: 0.2s;">
                        <span class="text-2xl">🎮</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-20 px-6 bg-[#0f0f0f]">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    Featured <span class="bg-gradient-to-r from-emerald-400 to-cyan-400 bg-clip-text text-transparent">Projects</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    Explore my collection of high-quality Minecraft server setups, each crafted with attention to detail and optimized for performance.
                </p>
            </div>

            @if($projects->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($projects as $index => $project)
                        <div class="group bg-white/5 border border-white/10 rounded-2xl overflow-hidden hover:border-emerald-500/50 transition-all duration-300 hover:-translate-y-2 fade-in" style="animation-delay: {{ $index * 0.1 }}s;">
                            <!-- Project Image -->
                            <div class="relative aspect-video overflow-hidden bg-gradient-to-br from-emerald-500/10 to-cyan-500/10">
                                @if($project->image_url)
                                    <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-6xl">
                                        {{ $project->emoji ?? '🎮' }}
                                    </div>
                                @endif
                                
                                @if($project->category)
                                    <div class="absolute top-4 left-4 px-3 py-1 bg-black/50 backdrop-blur-sm border border-white/10 rounded-lg text-xs font-medium">
                                        {{ $project->category }}
                                    </div>
                                @endif
                            </div>

                            <!-- Project Content -->
                            <div class="p-6 space-y-4">
                                <div class="flex items-start justify-between gap-4">
                                    <h3 class="text-xl font-bold text-white group-hover:text-emerald-400 transition-colors">
                                        {{ $project->emoji }} {{ $project->title }}
                                    </h3>
                                </div>

                                <p class="text-gray-400 text-sm leading-relaxed line-clamp-3">
                                    {{ $project->description }}
                                </p>

                                @if($project->tags)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($project->tags as $tag)
                                            <span class="px-2 py-1 bg-white/5 border border-white/10 rounded text-xs text-gray-400">
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                @if($project->external_url)
                                    <a href="{{ $project->external_url }}" target="_blank" class="inline-flex items-center gap-2 text-emerald-400 hover:text-emerald-300 transition-colors text-sm font-medium">
                                        View Project
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 bg-white/5 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-lg">No projects available yet. Check back soon!</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-20 px-6 bg-gradient-to-b from-[#0f0f0f] to-[#0a0a0a]">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    Skills & <span class="bg-gradient-to-r from-emerald-400 to-cyan-400 bg-clip-text text-transparent">Expertise</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    Specialized in Minecraft server development with expertise across multiple areas
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Frontend Skills -->
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 space-y-4 hover:border-emerald-500/50 transition-all fade-in">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500/20 to-cyan-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Frontend</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-400">✓</span> Menu UI Design (DeluxeMenus)
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-400">✓</span> Scoreboard & Tablist (TAB)
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-400">✓</span> Holograms (DecentHolograms)
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-400">✓</span> Custom Mobs & Skills (MythicMobs)
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-400">✓</span> Custom Items & Armors
                        </li>
                    </ul>
                </div>

                <!-- Backend Skills -->
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 space-y-4 hover:border-cyan-500/50 transition-all fade-in" style="animation-delay: 0.1s;">
                    <div class="w-12 h-12 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Backend</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center gap-2">
                            <span class="text-cyan-400">✓</span> Custom Plugin Development
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-cyan-400">✓</span> Plugin Configurations
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-cyan-400">✓</span> Game Balancing & Economy
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-cyan-400">✓</span> Server Optimization
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-cyan-400">✓</span> Game Design
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-cyan-400">✓</span> Minecraft Server Setup
                        </li>
                    </ul>
                </div>

                <!-- Tools & Platforms -->
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 space-y-4 hover:border-purple-500/50 transition-all fade-in" style="animation-delay: 0.2s;">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Tools & Platforms</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center gap-2">
                            <span class="text-purple-400">✓</span> IntelliJ IDEA
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-purple-400">✓</span> Visual Studio Code
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-purple-400">✓</span> GitHub
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-purple-400">✓</span> BuiltByBit
                        </li>
                    </ul>
                </div>

                <!-- Certifications -->
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 space-y-4 hover:border-yellow-500/50 transition-all fade-in" style="animation-delay: 0.3s;">
                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-500/20 to-orange-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Certifications</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center gap-2">
                            <span class="text-yellow-400">✓</span> MySQL Database (Certiport)
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-yellow-400">✓</span> Server Setup Expert
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-gray-600">⏳</span> HTML/CSS (Certiport)
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Preview Gallery Section -->
    <section id="gallery" class="py-20 px-6 bg-[#0a0a0a]">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    Preview <span class="bg-gradient-to-r from-emerald-400 to-cyan-400 bg-clip-text text-transparent">Gallery</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    Take a look at some screenshots from my Minecraft server setups and configurations
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($galleries as $index => $gallery)
                <!-- Gallery Image {{ $index + 1 }} -->
                <div class="group relative aspect-video rounded-2xl overflow-hidden bg-gradient-to-br from-emerald-500/10 to-cyan-500/10 border border-white/10 hover:border-emerald-500/50 transition-all duration-300 fade-in cursor-pointer" style="animation-delay: {{ $index * 0.1 }}s;">
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
                @empty
                <!-- No Gallery Images - Show placeholder -->
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">No gallery images available yet</p>
                </div>
                @endforelse

                <!-- View More Card -->
                @if($galleries->count() > 0)
                <a href="{{ route('gallery') }}" class="group relative aspect-video rounded-2xl overflow-hidden bg-gradient-to-br from-emerald-500/20 to-cyan-500/20 border-2 border-white/20 hover:border-emerald-500/50 transition-all duration-300 fade-in flex items-center justify-center cursor-pointer" style="animation-delay: 0.5s;">
                    <div class="text-center space-y-4 p-6">
                        <div class="w-16 h-16 mx-auto bg-white/10 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-2">Click to view</h3>
                            <p class="text-lg text-gray-300">More images</p>
                        </div>
                        <div class="inline-flex items-center gap-2 text-emerald-400 text-sm font-medium">
                            View Gallery
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                    </div>
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 px-6 bg-[#0f0f0f]">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12 fade-in">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    Get in <span class="bg-gradient-to-r from-emerald-400 to-cyan-400 bg-clip-text text-transparent">Touch</span>
                </h2>
                <p class="text-gray-400 text-lg">
                    Interested in collaborating, hiring, or just saying hello? Reach out below.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <a href="https://github.com/ItzRenzo" target="_blank" class="group bg-white/5 border border-white/10 rounded-2xl p-6 hover:border-emerald-500/50 transition-all hover:-translate-y-1 fade-in">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-emerald-500/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-white mb-1 group-hover:text-emerald-400 transition-colors">GitHub</h3>
                            <p class="text-gray-400 text-sm">View my repositories</p>
                        </div>
                    </div>
                </a>

                <a href="https://discord.gg/qTQGTNcApS" target="_blank" class="group bg-white/5 border border-white/10 rounded-2xl p-6 hover:border-cyan-500/50 transition-all hover:-translate-y-1 fade-in" style="animation-delay: 0.1s;">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-cyan-500/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-cyan-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515a.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0a12.64 12.64 0 0 0-.617-1.25a.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057a19.9 19.9 0 0 0 5.993 3.03a.078.078 0 0 0 .084-.028a14.09 14.09 0 0 0 1.226-1.994a.076.076 0 0 0-.041-.106a13.107 13.107 0 0 1-1.872-.892a.077.077 0 0 1-.008-.128a10.2 10.2 0 0 0 .372-.292a.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127a12.299 12.299 0 0 1-1.873.892a.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028a19.839 19.839 0 0 0 6.002-3.03a.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.956-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.955-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.946 2.418-2.157 2.418z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-white mb-1 group-hover:text-cyan-400 transition-colors">Discord</h3>
                            <p class="text-gray-400 text-sm">itzrenzo</p>
                        </div>
                    </div>
                </a>

                <a href="https://builtbybit.com/creators/itzrenzo.435252" target="_blank" class="group bg-white/5 border border-white/10 rounded-2xl p-6 hover:border-purple-500/50 transition-all hover:-translate-y-1 fade-in" style="animation-delay: 0.2s;">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-purple-500/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-white mb-1 group-hover:text-purple-400 transition-colors">BuiltByBit</h3>
                            <p class="text-gray-400 text-sm">View my resources</p>
                        </div>
                    </div>
                </a>

                <a href="https://www.youtube.com/@ItzRenzo" target="_blank" class="group bg-white/5 border border-white/10 rounded-2xl p-6 hover:border-red-500/50 transition-all hover:-translate-y-1 fade-in" style="animation-delay: 0.3s;">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-red-500/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-white mb-1 group-hover:text-red-400 transition-colors">YouTube</h3>
                            <p class="text-gray-400 text-sm">Plugin tutorials & showcases</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
</x-layouts.app>
