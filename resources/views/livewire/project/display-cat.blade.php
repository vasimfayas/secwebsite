<div class="mt-5">
    <h4 class="mb-3 font-weight-bold">Existing Categories</h4>

    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Description</th>
                <th>Card Image</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $index => $category)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $category->category }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    @if ($category->card_img)
                    <img src="{{ asset('storage/' . $category->card_img) }}" width="80" height="50" class="img-thumbnail">
                    @else
                    <span class="text-muted">No image</span>
                    @endif
                </td>
                <td>{{ $category->created_at->format('Y-m-d') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">No categories found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>