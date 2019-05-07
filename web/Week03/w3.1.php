<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../assignments.css">
    <title>Form Handling</title>
</head>
<body>
    <h1>Enter your information below:</h1>
    <form id="form1" action="form_validator.php" method="post">
        Name: <input type="text" size="30" name="name" /> <br />
        Email: <input type="text" size="30" name="email" /> <br />

        Major: <br />
        <input type="radio" name="major" value="cs" />
        Computer Science <br />
        <input type="radio" name="major" value="wdd" />
        Web Design and Development<br />
        <input type="radio" name="major" value="cit" />
        Computer Information Technology<br />
        <input type="radio" name="major" value="ce" />
        Computer Engineering<br />
        <input type="radio" name="major" value="se">
        Software Engineering<br />
        <input type="radio" name="major" value="vgd"> 
        Video Game Design<br />
        <input type="radio" name="major" value="ycm">
        Yu-Gi-Oh Card Making<br />
        <input type="radio" name="major" value="ffw">
        Fan Fiction Writing<br />
        <input type="radio" name="major" value="tat">
        The Art Of Trolling<br />

        <br />
        Which continents have you visited?<br />
        <input type="checkbox" name="continent[]" value="North America">
        North America <br />
        <input type="checkbox" name="continent[]" value="South America">
        South America <br />
        <input type="checkbox" name="continent[]" value="Europe">
        Europe <br />
        <input type="checkbox" name="continent[]" value="Asia">
        Asie <br />
        <input type="checkbox" name="continent[]" value="Australia">
        Australia <br />
        <input type="checkbox" name="continent[]" value="Africa">
        Africa <br />
        <input type="checkbox" name="continent[]" value="Antarctica">
        Antarctica <br />
        <input type="checkbox" name="continent[]" value="none">
        None, I am from another planet. <br />
        
        <br />
        Comments: <br />
        <textarea rows="4" cols="50" name="comment"></textarea> <br />

        <button type="reset">Reset</button>
        <button type="submit">Submit</button>
    </form>
</body>
</html>