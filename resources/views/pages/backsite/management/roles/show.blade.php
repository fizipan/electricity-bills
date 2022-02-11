<table class="table table-bordered">
    <tr>
        <th>Role</th>
        <td>{{ isset($role->title) ? $role->title : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Permission</th>
        <td>
            @foreach($role->permissions as $id => $permissions)
                <span class="badge bg-yellow text-dark mr-1 mb-1">{{ isset($permissions->title) ? $permissions->title : 'N/A' }}</span>
            @endforeach
        </td>
    </tr>
</table>