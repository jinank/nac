@foreach ($Users as $user)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
        <td>{{ $user->user_name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone }}</td>
        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}</td>
        <td>
            <a title="Click here to Edit" href="{{ url('admin/users/view/?user=' . $user->id) }}" class="btn btn-primary"
                style="margin-right:5px"><i class="fa fa-pen"></i></a>
            <button type="button" title="Click here to Delete" onclick="openModal({{ $user->id }})"
                class="btn btn-danger mt-1   "><i class="fa fa-times"></i></button>
        </td>
    </tr>
@endforeach
<script>
    function openModal(id) {
        $("#modal-default").modal("show");
        $("#deleteId").val(id);
    }
</script>
