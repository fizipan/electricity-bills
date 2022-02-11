<table class="table table-bordered">
    <tr>
        <th>Permission</th>
        <td>{{ isset($permission->title) ? $permission->title : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Menu</th>
        <td>{{ isset($permission->menus->name) ? $permission->menus->name : 'N/A' }}</td>
    </tr>
</table>