<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tour Booking Show</h1>

 
            <div>
                <label for="name"></label>
               <label>{{$request->tour_name}}</label>
            </div>

            <div>
                <label for="email"></label>
                <label>{{$request->tour_email}}</label>
            </div>

            <div>
                <label for="phone"></label>
                <label>{{$request->tour_ph}}</label>
            </div>

            <div>
                <label for="fdate"></label>
                <label>{{$request->from}}</label>
            </div>

            <div>
                <label for="tdate"></label>
                <label>{{$request->to}}</label>
            </div>

            <div>
                <label for="people"></label>
                <label>{{$request->people}}</label>
            </div>

            <div>
                <label for="events"></label>
                <label>{{$request->tourevents}}</label>
            </div>

            <div>
                <label for="contact"></label>
                <label>{{$request->contant}}</label>
            </div>


</body>
</html>