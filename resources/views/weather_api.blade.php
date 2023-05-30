<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

    <div class="container my-5">

        <div class="row justify-content-center">

            <div class="col-md-8">
                <form id="weather-form" action="">
                    <div class="input-group mb-3">
                        <input id="city" type="text" class="form-control" placeholder="City Name">
                        <button class="btn btn-secondary">Search</button>
                      </div>
                </form>

                <p>Weather is : <span id="result"></span></p>
            </div>

        </div>

    </div>

    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <script>

        document.getElementById('weather-form').onsubmit = function(e) {

            e.preventDefault();

            let city = document.getElementById('city').value;

            axios.get('https://api.openweathermap.org/data/2.5/weather?q='+city+'&appid=dccab945679f3bb9019537a309e05e47&units=metric')
            .then(res => {
                let icon = res.data.weather[0].icon;

                document.getElementById('result').innerHTML = res.data.main.temp + '<img src="http://openweathermap.org/img/w/'+icon+'.png" />';
            })
            .catch(function (error) {
                document.getElementById('result').innerHTML = city + ' Not Found';
            });
        }
    </script>

</body>
</html>
