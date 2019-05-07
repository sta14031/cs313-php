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
        <?php
        $majors = [
            "Computer Science",
            "Web Design and Development",
            "Computer Information Technology",
            "Software Engineering",
            "Video Game Designer",
            "Yu-Gi-Oh Card Making",
            "Fan Fiction Writing",
            "The Art Of Trolling"
        ];

        foreach($majors as $major)
        {
            echo "<input type='radio' name='major' value='$major' />$major <br />\n";
        }

        ?>

        <br />
        Which continents have you visited?<br />
        <input type="checkbox" name="continent[]" value="na">
        North America <br />
        <input type="checkbox" name="continent[]" value="sa">
        South America <br />
        <input type="checkbox" name="continent[]" value="eu">
        Europe <br />
        <input type="checkbox" name="continent[]" value="as">
        Asie <br />
        <input type="checkbox" name="continent[]" value="au">
        Australia <br />
        <input type="checkbox" name="continent[]" value="af">
        Africa <br />
        <input type="checkbox" name="continent[]" value="an">
        Antarctica <br />
        <input type="checkbox" name="continent[]" value="0">
        None, I am from another planet. <br />
        
        <br />
        Comments: <br />
        <textarea rows="4" cols="50" name="comment"></textarea> <br />

        <button type="reset">Reset</button>
        <button type="submit">Submit</button>
    </form>
</body>
</html>