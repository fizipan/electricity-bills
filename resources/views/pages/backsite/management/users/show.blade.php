<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <td>{{ isset($user->name) ? $user->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ isset($user->email) ? $user->email : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Mobile Phone</th>
        <td>{{ isset($detail_user->mobile_phone) ? $detail_user->mobile_phone : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Role</th>
        <td>
            @foreach($user->roles as $id => $roles)
                <span class="badge bg-yellow text-dark mr-1 mb-1">{{ isset($roles->title) ? $roles->title : 'N/A' }}</span>
            @endforeach
        </td>
    </tr>
    <tr>
        <th>Address</th>
        <td>{{ isset($detail_user->address) ? $detail_user->address : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Information</th>
        <td>{{ isset($detail_user->information) ? $detail_user->information : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if (isset($detail_user->status))
                @if ($detail_user->status == 1)
                    <span class="badge badge-success">{{ 'Active' }}</span>
                @else
                    <span class="badge badge-danger">{{ 'Suspend' }}</span>
                @endif
            @else
                {{ 'N/A' }}
            @endif
        </td>
    </tr>
</table>