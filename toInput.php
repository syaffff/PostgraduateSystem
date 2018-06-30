<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php include 'committee/basic/import.php'; ?>
</head>

<body>
	<div style="margin:80px">
    	<span id="lbl1" class="editable"> First Name </span> &nbsp;
        <span id="lbl2" class="editable"> Last Name </span>
    </div>
    
    <script>
	$('.editable').each(function(){
		var label = $(this)
		label.after("<input type='text' style='display:none'/>")
		var edittext = $(this).next()
		edittext[0].name = this.id.replace('lbl','txt')
		edittext.val(label.html())
		label.click(function(){
			$(this).hide()
			$(this).next().show()
		})
		edittext.focusout(function(){
			$(this).hide()
			$(this).prev().html($(this).val())
			$(this).prev().show()
		})
	})
	</script>
    
    <p id="container">The <span>colored items</span> in this paragraph
    are <span>editable</span>.</p>
    
    <script>
    window.onload = function() {
    document.getElementById('container').onclick = function(event) {
        var span, input, text;

        // Get the event (handle MS difference)
        event = event || window.event;

        // Get the root element of the event (handle MS difference)
        span = event.target || event.srcElement;

        // If it's a span...
        if (span && span.tagName.toUpperCase() === "SPAN") {
            // Hide it
            span.style.display = "none";

            // Get its text
            text = span.innerHTML;

            // Create an input
            input = document.createElement("input");
            input.type = "text";
            input.value = text;
            input.size = Math.max(text.length / 4 * 3, 4);
            span.parentNode.insertBefore(input, span);

            // Focus it, hook blur to undo
            input.focus();
            input.onblur = function() {
                // Remove the input
                span.parentNode.removeChild(input);

                // Update the span
                span.innerHTML = input.value == "" ? "&nbsp;" : input.value;

                // Show the span again
                span.style.display = "";
			};
        }
    };
};
				</script>

</body>
</html>