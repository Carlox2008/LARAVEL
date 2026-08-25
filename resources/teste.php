                                <form action="{{ route('photos.like') }}" method="POST">

                                    <input type="hidden" name="teste" value="teste">

                                    {{ --
                                    @php

                                    $liked = $photo->likes()
                                    ->where('user_id', auth()->id())
                                    ->exists();

                                    @endphp
                                     -- }}

                                    <button type="submit">
                                        {{ $liked ? '❤️' : '♡' }}
                                    </button>
                                    <span>{{ $photo->likes()->count() }}</span>
                                </form>