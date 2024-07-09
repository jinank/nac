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
                                <form method="POST" action="{{ url('/upload/video') }}" enctype="multipart/form-data"
                                    id="myForm">
                                    @csrf
                                    <label class="videofield">Title <span class="text-danger">*</span></label>
                                    <input value="{{old('video_name')}}" type="text" name="video_name" class="form-control"
                                        placeholder="Add Name here">
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
                                <input value="{{old('creater_name')}}"  type="text" name="creater_name" class="form-control"
                                    placeholder="Add video Creator here">
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
                                <select value="{{old('genre')}}" class="form-control" name="genre">
                                    <option value="0">--Choose--</option>
                                    @foreach ($generes as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
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
                                <input type="text" name="tags" class="form-control" placeholder="Add Tags here" value="{{old('tags')}}">
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
                                <input type="text" name="zipcode" inputmode="numeric"  maxlength="6"
                                    class="form-control" placeholder="Add zip code here" value="{{old('zipcode')}}">
                                @if ($errors->has('zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">    
                                <input type="checkbox" id="podcast" name="podcast" value="1">
                                <label for="podcast" class="videofield">Is this also a podcast?</label>
                            </div>
                            <div class="row form-group input">
                              <div class="col-sm-6">
                                <label for="facebook">Facebook<span class="required"></span></label>
                                <input type="text" id="facebook" name="facebook" value="{{ old('facebook') }}" placeholder="Facebook link" class="form-control register-input">
                                @if ($errors->has('facebook'))
                                <span class="text-danger">{{ $errors->first('facebook') }}</span>
                                @endif
                              </div>
                              <div class="col-sm-6">
                                <label for="instagram">Instagram<span class="required"></span></label>
                                <input type="text" id="instagram" name="instagram" value="{{ old('instagram') }}" placeholder="Instagram link" class="form-control register-input">
                                
                                @if ($errors->has('instagram'))
                                <span class="text-danger">{{ $errors->first('instagram') }}</span>
                                @endif
                              </div>
                            </div>
                            <div class="row form-group input">
                              <div class="col-sm-6">
                                  <label for="twitter">Twitter<span class="required"></span></label>
                                  <input type="text" id="twitter" name="twitter" value="{{ old('twitter') }}" placeholder="Twitter link" class="form-control register-input">
                                  
                                  @if ($errors->has('twitter'))
                                  <span class="text-danger">{{ $errors->first('twitter') }}</span>
                                  @endif
                              </div>
                              <div class="col-sm-6">
                                <label for="youtube">YouTube<span class="required"></span></label>
                                <input type="text" id="youtube" name="youtube" value="{{ old('youtube') }}" placeholder="YouTube link" class="form-control register-input">
                                
                                @if ($errors->has('youtube'))
                                <span class="text-danger">{{ $errors->first('youtube') }}</span>
                                @endif
                              </div>
                            </div>
                            
                        </div>
                        <div class="col-sm-12">
                            <input style="float: left;" type="submit" name="login-submit" id="login-submit"
                                tabindex="4" class="form-control btn btn-login" value="Submit">
                            <a href="{{ url('home') }}" style="float: right;" tabindex="4"
                                class="form-control btn btn-login">Cancel</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12  column">
                    @csrf
                    <div class="row" style="background:url('{{ asset('/images/rectangle.png') }}') no-repeat ">
                        <img src="{{ asset('/images/group.png') }}" class="card" id="imgFileUpload" height="200px">
                        <br>
                        <br>

                        <p id="Successfully" style="color: red"></p>

                        <div style="width: 555px">
                            <h6> Please be sure to upload your 11 minute video submission in .mp4 or .mov format. The
                                maximum size of the video should be 1500 MB. If your video file is greater than 1500MB,
                                please check the box below and we will contact you to assist. The upload time may vary
                                depending on the size of your file. You'll receive an email notification once your video is
                                queued for review and approval.</h6>
                                 <div id="previewContainer" style="display: none;">
                                    <video id="videoPreview" width="200" height="100" controls></video>
                                </div>
                                <div class="form-group">
                                    <label class="videofield">Thumbnail</label>
                                    <input type="file" name="thumbnail" class="form-control" id="imageInput" accept="image/*" onchange="displayImage(this)"
                                        >
                                    <img id="selectedImage" src="#" alt="Selected Image" style="display:none; max-width: 50px; max-height: 50px;">
                                    @if ($errors->has('thumbnail'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('thumbnail') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            <div class="form-group">
                                <label class="videofield">Link of Google Drive/Youtube/Vimeo/Dropbox</label>
                                <input value="{{old('other_video_link')}}" type="text" name="other_video_link" class="form-control"
                                    placeholder="Add Link of Google Drive/Youtube/Vimeo/Dropbox">
                                @if ($errors->has('other_video_link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('other_video_link') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="videofield">Description <span class="text-danger">*</span></label>
                                <!--  <input type="textarea" name="video_description" class="form-control" placeholder="Add video decription here" rows="3"> -->
                                <textarea class="form-control" rows="2" placeholder="Add video decription here" name="video_description"
                                    id="comment">{{old('video_description')}}</textarea>
                                @if ($errors->has('video_description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('video_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="row form-group input">
                              <div class="col-sm-6">
                                <label for="patreon">Patreon<span class="required"></span></label>
                                <input type="text" id="patreon" name="patreon" value="{{ old('patreon') }}" placeholder="Patreon link" class="form-control register-input">
                                
                                @if ($errors->has('patreon'))
                                <span class="text-danger">{{ $errors->first('patreon') }}</span>
                                @endif
                              </div>

                              <div class="col-sm-6">
                                <label for="vimeo">Vimeo<span class="required"></span></label>
                                <input type="text" id="vimeo" name="vimeo" value="{{ old('vimeo') }}" placeholder="Vimeo link" class="form-control register-input">
                                
                                @if ($errors->has('vimeo'))
                                <span class="text-danger">{{ $errors->first('vimeo') }}</span>
                                @endif
                              </div>
                            </div>
                        </div>
                        <input type="file" name="file" id="poster" class="form-control i_file" accept="video/*" onchange="previewVideo()"
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

    <script type="text/javascript">
        /
        //    document.getElementById("poster").addEventListener("change", function () {
        //      var file = this.files[0];

        //      if (file) {
        //          var mbSize = file.size / 1024 / 1024;
        //          var fileIsMp4 = (file.type === "video/mp4");
        //          var fileIsMov = (file.type === "video/quicktime");
        //          // if (mbSize > 10 || !fileIsMp4) {
        //          //     if (!fileIsMp4) {
        //          //     document.getElementById("Successfully").innerHTML = "please upload .mp4 or .mov file";
        //          //   }else if(mbSize > 10){
        //          //     // document.getElementById("Successfully").innerHTML = "please upload video less than 15 MB.";
        //          //     sendEmail();
        //          //   }
        //          // } else {
        //          //    document.getElementById("Successfully").innerHTML = " ";
        //          // }
        //          if (fileIsMp4 || fileIsMov) {
        //          if (mbSize > 1500) {
        //              document.getElementById("Successfully").innerHTML = "please upload video less than 1500 MB.";
        //              sendEmail();
        //            }else{
        //             document.getElementById("Successfully").innerHTML = " ";
        //            }
        //          } else {
        //             document.getElementById("Successfully").innerHTML = "please upload .mp4 or .mov file";
        //          }
        //      }
        //    });
    </script>
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
    {{-- <script type="text/javascript">
   function validate(formData, jqForm, options) {
       var form = jqForm[0];
       if (!form.file.value) {
           $("p").html("File not found.");
           return false;
       }
       var form = jqForm[0];
       if (!form.video_name.value) {
           $("p").html("Title not found.");
           return false;
       }
       var form = jqForm[0];
       if (!form.video_description.value) {
           $("p").html("Description not found.");
           return false;
       }
       var form = jqForm[0];
       if (!form.creater_name.value) {
           $("p").html("Creator name not found.");
           return false;
       }
       var form = jqForm[0];
       if (!form.genre.value) {
           $("p").html("Genre not found.");
           return false;
       }
       var form = jqForm[0];
       if (!form.tags.value) {
           $("p").html("Tags not found.");
           return false;
       }
       var form = jqForm[0];
       if (!form.zipcode.value) {
           $("p").html("Zip code not found.");
           return false;
       }
   }

   (function() {

   var bar = $('.bar');
   var percent = $('.percent');
   var status = $('#status');

   $('form').ajaxForm({

        beforeSubmit: validate,
       beforeSend: function() {
           $('.progress').css('display','block');
           status.empty();
           var percentVal = '0%';
           var posterValue = $('input[name=file]').fieldValue();
           bar.width(percentVal)
           percent.html(percentVal);

       },
       uploadProgress: function(event, position, total, percentComplete) {
           var percentVal = percentComplete + '%';
           bar.width(percentVal)
           percent.html(percentVal);
       },
       success: function() {
           var percentVal = '';
           bar.width(percentVal)
           percent.html(percentVal);
       },
       complete: function(xhr) {
       document.location = '{{url('sucesshome')}}';


       $('.progress').css('display','none');


   $("#Successfully").delay(2500).fadeOut();
   $('.alert').css('display','block');
       }
   });

   })();
</script>   --}}
<script>
        function displayImage(input) {
            var file = input.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('selectedImage').src = e.target.result;
                    document.getElementById('selectedImage').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

       function previewVideo() {
            var videoInput = document.getElementById('poster');
            var videoPreview = document.getElementById('videoPreview');
            var previewContainer = document.getElementById('previewContainer');

            var file = videoInput.files[0];

            if (file) {
                var videoUrl = URL.createObjectURL(file);

                videoPreview.src = videoUrl;
                previewContainer.style.display = 'block';
            } else {
                // No file selected, hide the preview container
                previewContainer.style.display = 'none';
            }
        }

    </script>
@endsection
