<html lang="en">
<head>
<style>
.ui-datepicker-calendar {
   display: none;
}
.ui-datepicker-month {
   display: none;
}
.ui-datepicker-prev{
   display: none;
}
.ui-datepicker-next{
   display: none;
}
</style>
</head>
<body>

<p>Date: <input type="text" id="datepicker" /></p>

</body>
</html>
<script type="text/javascript">
$(function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy',  changeYear: true,  changeMonth: false});
    });
	</script>