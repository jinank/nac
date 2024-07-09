<!DOCTYPE html>

<html>

<head>

	<title>Coming Soon</title>

	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"><meta name="viewport" content="width=device-width, initial-scale=1.0">

	<style>

        .card-container {
            padding-top: 5rem;
        }

        .custom-card-body {
            padding: 4rem 1rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 3rem;
        }

	</style>

</head>

<body>

   <div class="container card-container">

        <div class="card bg-light shadow">

            <div class="card-body custom-card-body">

                <img src="{{ asset('images/mainlogo.png') }}">

                <div class="text-center">

                    <div class="display-4">Coming Soon</div>

                    <h4 class="font-weight-normal mt-4">We're working hard to bring you something amazing. Stay tuned!</h4>

                </div>

                <a href="{{ url('/') }}" class="btn btn-success button">Back to Home</a>

            </div>

        </div>

    </div>

</body>

</html>

