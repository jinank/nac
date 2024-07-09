<!DOCTYPE html>
<html>
<head>
    <title>JSON Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        @if(session()->has('msg-success'))
        <div class="alert alert-warning" role="alert">
            {{session('msg-success')}}
        </div>
        @endif
        <h1 class="text-center">JSON Form</h1>
        <div id="arrayCount" class="text-center mt-3"></div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form id="jsonForm" action="{{url('zillow/data/add')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="jsonInput">Paste JSON:</label>
                        <textarea name="data" class="form-control" id="jsonInput" rows="10"></textarea>
                    </div>
                    <button type="button" class="btn btn-primary btn-block" onclick="processJSON()">Count Array</button>
                    <button type="sbumit" class="btn btn-danger btn-block" onclick="processJSON()">Submit Data</button>
                </form>
                
            </div>
        </div>
    </div>

    <script>
        function processJSON() {
            var jsonInput = document.getElementById("jsonInput").value;
            var json;

            try {
                json = JSON.parse(jsonInput);
                if (Array.isArray(json)) {
                    document.getElementById("arrayCount").innerHTML = "Array count: " + json.length;
                } else {
                    document.getElementById("arrayCount").innerHTML = "Please provide a valid JSON array.";
                }
            } catch (error) {
                document.getElementById("arrayCount").innerHTML = "Invalid JSON format.";
            }
        }
    </script>
</body>
</html>
