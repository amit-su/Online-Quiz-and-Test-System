<tbody>
    @foreach ($users as $user)
        <tr class="hover:bg-gray-100">
            <td class="px-4 py-2 border">{{ $user->name }}</td>
            <td class="px-4 py-2 border">{{ $user->email }}</td>
        </tr>
    @endforeach
</tbody>
