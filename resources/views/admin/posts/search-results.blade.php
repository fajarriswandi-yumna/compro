@forelse ($posts as $post)
<tr>
    <td>{{ $posts->firstItem() + $loop->index }}</td>
    <td>{{ $post->title }}</td>
    <td>{{ $post->category->name }}</td>
    <td>
        @if($post->featured_image_path)
        <img src="{{ asset('storage/' . $post->featured_image_path) }}" alt="Gambar Unggulan" width="100">
        @else
        -
        @endif
    </td>
    <td>
        <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-info btn-sm">
            <i class="fas fa-eye"></i> Detail
        </a>
        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i> Edit
        </a>
        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">
                <i class="fas fa-trash"></i> Hapus
            </button>
        </form>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="text-center">Tidak ada data postingan yang sesuai dengan pencarian.</td>
</tr>
@endforelse