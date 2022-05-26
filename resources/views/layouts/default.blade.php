<!doctype html>
<html>
<head>
   @include('components.head')
</head>
<body>
<div class="container">
   <header class="row">
       @include('components.header')
   </header>
   <div id="main" class="row">
           @yield('content')
   </div>
</div>
 
       
</body>
</html>