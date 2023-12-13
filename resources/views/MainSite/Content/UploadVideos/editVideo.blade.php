@extends('MainSite.Content.index')
@section('content')
    <style>
        .progress {
            position: relative;
            width: 100%;
            border: 1px solid #7F98B2;
            padding: 1px;
            border-radius: 3px;
        }

        .video-thumbanil-bg {
            width: 300px;
            height: 150px;
            background: black
        }

        .video-thumbanil {
            object-fit: scale-down;
            width: 100%;
            height: 100%
        }


        .bar {
            background-color: #B4F5B4;
            width: 0%;
            height: 25px;
            border-radius: 3px;
        }

        .percent {
            position: absolute;
            display: inline-block;
            top: 3px;
            left: 48%;
            color: #7F98B2;
        }
    </style>
    <script>
        $(document).ready(function() {
            $("#myModal").modal('show');
        });
    </script>
    <div class="row">

        <div class="leftcolumn">
            <div class="row">
                <div class="col-sm-6 col-xs-12 column column-left">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h1>Upload Video</h1>
                    <div class="form-group">
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <form method="POST" action="{{ url('/user/video/edit') }}" enctype="multipart/form-data"
                                    id="myForm">
                                    @csrf
                                    <input type="hidden" value="{{$video->id}}" name="video_id">
                                    <label class="videofield">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="video_name" class="form-control"
                                        placeholder="Add Name here" value="{{$video->video_title}}">
                                    @if ($errors->has('video_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('video_name') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="videofield">Creator Name <span class="text-danger">*</span></label>
                                <input type="text" name="creater_name" class="form-control"
                                    placeholder="Add video Creator here" value="{{$video->creator_name}}">
                                @if ($errors->has('creater_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('creater_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Genre <span class="text-danger">*</span></label>
                                <select class="form-control" name="genre">
                                    <option value="0">--Choose--</option>
                                    @foreach ($generes as $item)
                                        <option {{$video->genere_id==$item->id? "selected":''}}   value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('genre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('genre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="videofield">Tags <span class="text-danger">*</span></label>
                                <input type="text" name="tags" class="form-control" placeholder="Add Tags here" value="{{ $video->tags }}">
                                <h6>Multiple tags should be separated by commas.</h6>
                                @if ($errors->has('tags'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="videofield">Zip code <span class="text-danger">*</span></label>
                                <input type="text" name="zipcode" inputmode="numeric" pattern="[0-9]{5}" maxlength="5"
                                    class="form-control" placeholder="Add zip code here" value="{{ $video->zipcode }}">
                                @if ($errors->has('zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-12">
                                <input style="float: left;" type="submit" name="login-submit" id="login-submit"
                                    tabindex="4" class="form-control btn btn-login" value="Submit">
                                <a href="{{ url('/user/profile') }}" style="float: right;" tabindex="4"
                                    class="form-control btn btn-login">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12  column">
                    @csrf
                    <div class="video-thumbanil-bg">

                        <img class="video-thumbanil"
                            src="{{ $video->thumbnail ? asset('Data/Thumbnail/' . $video->thumbnail) : asset('/images/group.png') }}"
                            id="imgFileUpload">
                    </div>

                    <br>
                    <br>

                    <p id="Successfully" style="color: red"></p>
                    <div style="width: 555px">

                        <div class="form-group">
                            <label class="videofield">Thumbnail</label>
                            <input type="file" name="thumbnail" class="form-control">
                            @if ($errors->has('thumbnail'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('thumbnail') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="videofield">Link of Google Drive/Youtube/Vimeo/Dropbox</label>
                            <input type="text" name="other_video_link" class="form-control"
                                placeholder="Add Link of Google Drive/Youtube/Vimeo/Dropbox" value="{{ $video->other_video_link }}">
                            @if ($errors->has('other_video_link'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('other_video_link') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="videofield">Description <span class="text-danger">*</span></label>
                            <!--  <input type="textarea" name="video_description" class="form-control" placeholder="Add video decription here" rows="3"> -->
                            <textarea class="form-control" rows="4" placeholder="Add video decription here" name="video_description"
                                id="comment">{{ $video->description }}</textarea>
                            @if ($errors->has('video_description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('video_description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <input type="file" name="file" id="poster" class="form-control i_file"
                        style="display: none"><br />
                    @if ($errors->has('file'))
                        <span class="help-block">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div>
            </div>
        </div>
        </form>
    </div>
    </div>
    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </section>
    </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

    <script type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            var fileupload = $("#poster");
            var filePath = $("#spnFilePath");
            var image = $("#imgFileUpload");
            image.click(function() {
                fileupload.click();
            });
            fileupload.change(function() {
                var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
                filePath.html("<b>Selected File: </b>" + fileName);
            });
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
@endsection
