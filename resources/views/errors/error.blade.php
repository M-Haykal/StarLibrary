<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $statusCode }} Error</title>
    <link rel="icon" type="image/x-icon" href="https://i.ibb.co.com/NCdmBnM/svgviewer-png-output-removebg-preview.png">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
    @import url("https://fonts.googleapis.com/css?family=Bevan");
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }

    body {
      background: #282828;
      overflow: hidden;
    }

    p {
      font-family: "Bevan", cursive;
      font-size: 130px;
      margin: 10vh 0 0;
      text-align: center;
      letter-spacing: 5px;
      background-color: black;
      color: transparent;
      text-shadow: 2px 2px 3px rgba(255, 255, 255, 0.1);
      -webkit-background-clip: text;
      -moz-background-clip: text;
      background-clip: text;
    }
    p span {
      font-size: 1.2em;
    }

    code {
      color: #bdbdbd;
      text-align: center;
      display: block;
      font-size: 16px;
      margin: 0 30px 25px;
    }
    code span {
      color: #f0c674;
    }
    code i {
      color: #b5bd68;
    }
    code em {
      color: #b294bb;
      font-style: unset;
    }
    code b {
      color: #81a2be;
      font-weight: 500;
    }

    a {
      color: #8abeb7;
      font-family: monospace;
      font-size: 20px;
      text-decoration: underline;
      margin-top: 10px;
      display: inline-block;
    }

    @media screen and (max-width: 880px) {
      p {
        font-size: 14vw;
      }
    }
    </style>
</head>
<body>
    <p>HTTP: <span>{{ $statusCode }}</span></p>
    <code><span>if</span> (<b>{{ $message }}</b>) {<span>try_again()</span>;}</code>
    <code><span>else if (<b>we_screwed_up</b>)</span> {<em>alert</em>(<i>"We're really sorry about that."</i>); <span>window</span>.<em>location</em> = home;}</code>
    <center><a href="{{ url('/') }}">HOME</a></center>

    <script>
        function type(n, t) {
            var str = document.getElementsByTagName("code")[n].innerHTML.toString();
            var i = 0;
            document.getElementsByTagName("code")[n].innerHTML = "";

            setTimeout(function() {
                var se = setInterval(function() {
                    i++;
                    document.getElementsByTagName("code")[n].innerHTML =
                        str.slice(0, i) + "|";
                    if (i == str.length) {
                        clearInterval(se);
                        document.getElementsByTagName("code")[n].innerHTML = str;
                    }
                }, 10);
            }, t);
        }

        type(0, 0);
        type(1, 600);
        type(2, 1300);
    </script>
</body>
</html>
