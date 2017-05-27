<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>profile</title>
</head>
<body>
	<form method="POST" id="logout" action="logout">
		{{csrf_field()}}
		<input type="submit" value="Log out" id="logout-btn">
	</form>	
</body>
</html>


<script>
	$("#logout-btn").on('submit', function(event) {

        event.preventDefault();	
        window.location.replace("/logout");
    });
</script>