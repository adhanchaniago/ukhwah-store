<form id="data" method="post" enctype="multipart/form-data">
    <input type="text" name="first" value="Bob" />
    <input type="text" name="middle" value="James" />
    <input type="text" name="last" value="Smith" />
    <input name="image" type="file" />
    <button>Submit</button>
</form>
jQuery + Ajax

$("form#data").submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);

    $.ajax({
        url: window.location.pathname,
        type: 'POST',
        data: formData,
        success: function (data) {
            alert(data)
        },
        cache: false,
        contentType: false,
        processData: false,
        // dataType: (xml, json, script, text, html)
    });
});
Short Version

$("form#data").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);    

    $.post($(this).attr("action"), formData, function(data) {
        alert(data);
    });
});