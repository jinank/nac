@foreach ($Businesses as $index => $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->email}}</td>
        <td>{{ $item->contact }}</td>
        <td>{{ $item->address }}</td>
        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</td>

        <td>
            <button type="button" title="Click here to changes status"
            onclick="chanStatus({{ $item->id}},{{$index }})"
            class="btn {{ $item->is_approved == 'Yes' ? 'btn-success' : 'btn-danger' }} admin-business-status-{{ $index }}">{{ $item->is_approved == 'Yes' ? 'Active' : 'InActive' }}</button>
            <a title="Click here to Edit" href="{{ url('admin/business/view/?item=' . $item->id) }}" class="btn btn-primary"
                style="margin-right:5px"><i class="fa fa-pen"></i></a>
            <button type="button" title="Click here to Delete" onclick="openModal({{ $item->id }})"
                class="btn btn-danger mt-1   "><i class="fa fa-times"></i></button>
        </td>
    </tr>
@endforeach
<script>
    function openModal(id) {
        $("#modal-default").modal("show");
        $("#deleteId").val(id);
    }
    function chanStatus(id,index) {
        $.ajax({
            url: BASE_URL + "/admin/business/change-status?id=" + id,
            success: function(data) {

                if (data == "Yes") {
                    $(`.admin-business-status-${index}`).removeClass().addClass(
                        `btn btn-success admin-business-status-${index}`);
                    $(`.admin-business-status-${index}`).html("Active")
                } else {
                    $(`.admin-business-status-${index}`).removeClass().addClass(
                        `btn btn-danger admin-business-status-${index}`);
                    $(`.admin-business-status-${index}`).html("InActive")
                }
            }
        })
    }
</script>
