
@foreach ($videos as $index => $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
            <div class="embed-responsive embed-responsive-16by9">
                <video width="320" height="240" controls poster="{{ asset('Data/Thumbnail/' . $item->thumbnail) }}">
                    <source src="{{ asset('Data/Video/' . $item->file_name) }}" type="video/mp4">

                </video>
            </div>
        </td>
        <td>{{ $item->video_title }}</td>
        <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</td>

        <td>
            <a title="Click here to show likes" href="{{ url('admin/video/likes/?item=' . $item->video_id) }}"
                class="btn btn-primary" style="margin-right:5px"><i class="fa fa-heart pr-1"></i>Likes</a>
            <button type="button" title="Click here to changes status"
                onclick="changeVideoStatus({{ $item->video_id }},{{ $index }})"
                class="btn {{ $item->is_approved == 'Yes' ? 'btn-success' : 'btn-primary' }} admin-video-status-{{ $index }}">{{ $item->is_approved == 'Yes' ? 'Published' : 'Unpublished' }}</button>
            <button class="btn btn-secondary"
                onclick="AdsAssignModal({{ $item->video_id }},'{{ $item->ads_button_text ?? 'Buy T-Shirt' }}','{{ $item->ads_button_link }}')">Manage
                Link</button>
            <button type="button" title="Click here to Delete" onclick="openModal({{ $item->video_id }})"
                class="btn btn-danger"><i class="fa fa-trash pr-1"></i></button>
            {{-- assign ads --}}
        </td>
    </tr>
@endforeach

{{-- ads link modal --}}
<div class="modal fade show" id="ads-link-modal" style=" padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ads Button</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ url('/admin/video/update/button') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="videoId" id="video-id" type="text">
                        <label>Button inner text</label>
                        <input type="" class="form-control" id="buttonText" name="buttonText" type="text"
                            value="Buy T-Shirt">
                    </div>
                    <div class="form-group">
                        <label>Button Link</label>
                        <input type="" class="form-control" id="buttonLink" name="buttonLink" type="text"
                            placeholder="Paste your link here">
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-danger">Add</button>
            </form>
        </div>
    </div>
</div>
<script>
    function AdsAssignModal(videoId, buttonText, buttonLink) {
        $("#ads-link-modal").modal("show");
        $("#video-id").val(videoId);
        $("#buttonText").val(buttonText ?? null);
        $("#buttonLink").val(buttonLink ?? null);
    }

    function openModal(id) {
        $("#modal-default").modal("show");
        $("#deleteId").val(id);
    }


    function changeVideoStatus(id, index, currentStatus) {
        $.ajax({
            url: BASE_URL + "/admin/video/change-status?id=" + id,
            success: function(data) {

                if (data == "Yes") {
                    $(`.admin-video-status-${index}`).removeClass().addClass(
                        `btn btn-success admin-video-status-${index}`);
                    $(`.admin-video-status-${index}`).html("Published")
                } else {
                    $(`.admin-video-status-${index}`).removeClass().addClass(
                        `btn btn-danger admin-video-status-${index}`);
                    $(`.admin-video-status-${index}`).html("Unpublished")
                }
            }
        });
    }
</script>
