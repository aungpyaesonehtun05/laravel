<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>UserRegisterForm</h1>
    
    @if ($errors->any())
            <div style="color:red">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif

    @if (session('message'))
            <div style="color:blue">
                <ul>
                    <li>{{ session('message') }}</li>
                </ul>
            </div>
    @endif

    <form action="{{ url('save-register') }}" method="post"> 
        @csrf
        <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ request()->('name',old('name')) }}"><br><br>

        <label for="fname">fathername:</label>
            <input type="text" id="fname" name="fname"> <br><br>

        <label for="nrc">NRC:</label>
            <input type="text" id="nrc" name="nrc"> <br><br>

        <label for="phoneNo">PhoneNo:</label>
            <input type="number" id="phoneNo" name="phoneNO"> <br><br>

        <label for="email">Email:</label>
            <input type="email" id="email" name="email"> <br><br>

        <label for="address">Address:</label>
            <input type="address" id="address" name="address"> <br><br>

        <label for="gender">Gender:</label>
           Male <input type="radio" id="gender" name="gender" value="1">
           Female <input type="radio" id="gender" name="gender" value="2"> <br><br>

        <label for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday"> <br><br>

        <label>Select Image File:</label>
            <input type="file" name="image">
            <input type="submit" name="submit" value="Upload"> <br><br>

        <button type="submit" class="save">Register</button>
    </form>
</body>
</html>