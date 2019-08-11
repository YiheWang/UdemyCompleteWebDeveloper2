
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(".toggleForm").click(function () {
        $("#signUpForm").toggle();
        $("#logInForm").toggle();
    });

    //any word change will trick a event
    $("#diary").bind('input propertychange', function() {
        //alert("hsj");
        //be attention about the jquery version. Some slim version
        //does not contain function ajax()
        $.ajax({
            method:"POST",
            url: "updatedDatabase.php",
            data: {content: $("#diary").val() },
            //get the content of textarea diary
            //and store the content into $_POST["content"]
        });
            /*.done(function (msg) {
                alert("Data Saved " + msg);
            });*/
    });
</script>
</body>
</html>
