<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tour Booking Form</h1>
   
    @if ($errors->any())
<div style="color:red">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


       
    <form action="{{ route('tour-book') }}" method="post" enctype="multipart/form-data">
                @csrf

            <div>
                <label for="name">Name*</label>
                    <input type="text" id="name" name="tour_name" placeholder="YourName">
            </div><br>

            <div class="mail">
                <label for="email">E-mail*</label>
                <input type="email" id="email" name="tour_email" placeholder="">
            </div><br>

            <div class="no">
                <label for="phone">Phone*</label>
                <input type="tel" id="phone" name="tour_ph" placeholder="">
            </div> <br>

            <div>
                <label for="fdate">When are you planning to visit? (From~To)*</label>
                <div class="dt">
                    <input type="date" id="fdate" name="from" placeholder="">
                    <input type="date" id="tdate" name="to" placeholder="">
                </div>
            </div><br>

            <div class="num">
                <label for="people">How many people are in your group?*</label>
                <input type="number" id="people" name="people">
            </div><br>

            <div class="interest">
                <label for="events">Which tours or events are you most interested in?</label>
                <input type="text" id="events" name="tourevents" placeholder="">
            </div><br>

            <div class="con">
            <label for="contact">What is the best way to contact you?</label> <br><br>
                Phone <input type="radio" id="contact1" name="contant" value="1"> <br><br>
                Email <input type="radio" id="contact2" name="contant" value="2"> <br><br>
                Other <input type="radio" id="contact3" name="contant" value="3"> 
            </div><br>

            <div class="file">
                <label for="img">Attach File*</label>
                <input type="file" id="img" name="image">
            </div><br>

            <div>
                <button type="submit" class="save">Save</button>
            </div>
    </form>
</body>
</html>