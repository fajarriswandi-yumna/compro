@if ($paginator->hasPages())
    <div class="d-flex justify-content-between align-items-center">
        <p class="text-muted">Total Data: {{ $paginator->total() }}</p>
        <ul class="pagination mb-0">
            {{-- Tombol Previous Dihilangkan --}}

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol Next Dihilangkan --}}
        </ul>
    </div>
@endif