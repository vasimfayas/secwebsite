<table class="min-w-full divide-y divide-gray-200 border mt-4">
    <thead class="bg-gray-100 text-left text-sm font-medium text-gray-700">
        <tr>
            <th class="px-4 py-2">#</th>
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">Location</th>
            <th class="px-4 py-2">Experience</th>
            <th class="px-4 py-2">Deadline</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200 text-sm">
        @forelse ($jobs as $index => $job)
        <tr>
            <td class="px-4 py-2">{{ $index + 1 }}</td>
            <td class="px-4 py-2">{{ $job->title }}</td>
            <td class="px-4 py-2">{{ $job->location }}</td>
            <td class="px-4 py-2">{{ $job->experience }}</td>
            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}</td>
            <td class="px-4 py-2 space-x-2">
                <a href=""
                    class="inline-block bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-xs">
                    View
                </a>
                <a href=""
                    class="inline-block bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-xs">
                    Edit
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="px-4 py-4 text-center text-gray-500">No job listings found.</td>
        </tr>
        @endforelse
    </tbody>
</table>