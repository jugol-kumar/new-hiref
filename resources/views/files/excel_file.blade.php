<table>
    <thead>
    <tr>
        <th>image</th>
        <th>Name</th>
        <th>Email</th>
        <th>phone</th>
    </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td><img src="{{ public_path($user->photo) }}" width="80" height="100" alt=""></td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
