<!DOCTYPE html>
<html>
<head>
    <title>TAX MATRIX Automatic Emails</title>
</head>
<body style="margin: 20px; margin: auto; ">
<hr>
<center>
    <p style="color: white; align-items:center;  ">
    <center>
        <h1>
            <b>Dear : {{ $name }}</b>
        </h1>
        <h2>You are being invited to an </h2>
        <h2><b>ANNUAL TAX CONFERENCE INVITATION :  12 - 13 May 2021</b></h2>
    </center>
    </p>
</center>

<hr>

    <p>
    <table width="100%">
        <tbody>
           <div style="padding: 30px;">
             {{--  <img src="{{ asset('/images/tm.jpg') }}" alt="" width="100%" height="40%">--}}
               <img src="{{ $message->embed(storage_path('images/tm.jpg'))}}" width="100%" height="40%" >
           </div>
        </tbody>
    </table>
    </p>

   <center>
       <p style="align-content: center; justify-content: center;">
           <strong >Thank You.</strong>
       </p>
   </center>

</body>
</html>

