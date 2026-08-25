<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(auth()->user()->isPhotographer())
                    <div class="mb-8 rounded-x1 border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="mb-4 text-lg font-semibold text-slate-600"> Área do fotógrafo: Nova publicação</h3>

                        <form action="{{ route('photos.store') }}" method="post" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <div>
                                <label for="title">Titulo da Foto</label>
                                <input type="text" name="title" id="title" placeholder="EX: vista ao mar" class="w-full rounded-lg border-slate-300 px-3 py-2 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus-outline-none focus:ring-1 focus:ring-indigo-500">
                            </div> 
                            <div>
                                <label for="photo" class="mb-1 block text-sm font-medium text-slate-700">
                                        Escolha a Foto
                                    </label>
                                    <input
                                        type="file"
                                        name="photo"
                                        id="photo"
                                        required
                                        class="w-full text-sm text-slate-500 file:mr-4 file:rounded-md file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100"
                                    >
                                </div>


                                <button
                                    type="submit"
                                    class="w-full rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                                >
                                    Publicar Foto
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif

                    
                    @forelse($photos as $photo)
                        @if($loop->first)
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @endif
                                <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm transition-all hover:shadow-md">
                                    <div class="aspect-4/3 w-full bg-slate-100">
                                        <img
                                            src="{{ asset('storage/' . $photo->image_path) }}"
                                            alt="{{ $photo->title }}"
                                            class="h-full w-full object-cover"
                                        >
                                    </div>
                                
                                    <div class="p-4">
                                        <h4 class="font-semibold text-slate-800 line-clamp-1">
                                            {{ $photo->title ?? 'Sem título' }}
                                        </h4>
                                        <p class="mt-1 text-xs text-slate-500">
                                            Foto por: <span class="font-medium text-slate-700">{{ $photo->user->name }}</span>
                                        </p>

                                    </div>

                                    <form action="{{ route('photos.like', $photo) }}" method="POST">
                                        @csrf

                                        @php
                                            $liked = $photo->likes()
                                                ->where('user_id', auth()->id())
                                                ->exists();
                                        @endphp

                                        <button type="submit">
                                            {{ $liked ? '❤️' : '♡' }}
                                        </button>

                                        <span>{{ $photo->likes()->count() }}</span>

                                        <button type="button" onclick="document.getElementById('likes-{{ $photo->id }}').classList.toggle('hidden')"
                                        class="text-sm text-slate-500 hover:text-indigo-600">
                                          
                                           ver curtidas

                                        </button>

                                        <div id="likes-{{ $photo->id }}" class="hidden mt-2">
                                            @foreach($photo->likes()->with('user')->get() as $like)
                                            @if($like->user)
                                        <p class="text-sm text-slate-600">
                                            {{ $like->user->name }}
                                        </p>
                                            @endif
                                            @endforeach
                                        </div>
                                    </form>
                                </div>
                        @if ($loop->last)
                            </div>
                        @endif
                    @empty
                        <div class="rounded-xl border border-dashed border-slate-300 p-8 text-center text-slate-500">
                            <p>Nenhuma foto cadastrada ainda.</p>
                        </div>
            
                    @endforelse
                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
