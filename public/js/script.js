function checkInput()
{
    $("#errorMsg").html('');
    var input = document.getElementById('fileId');
    if (input && input.files&& input.files[0])
    {
        if(!validateFileExtension(input))
        {
            $("#errorMsg").html('Upload image.');
            return;
        }
        if(input.files[0].size > 102400)
        {
            $("#errorMsg").html('Upload image less than 100 kb.');
            return;
        }
        validateImageSize(input);
    }
    if(!$("#errorMsg").is(':empty'))
    {
        return;
    }

    var message = $('#messageId').val();

    $("#errorMsg").html('');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
            type: "POST",
            accept: "application/json",
            dataType: "json",
            data: {
                'message': message
            },
            url: $('#validateMessageUrl').val(),
            statusCode: {
                422: function(xhr, ajaxOptions, thrownError) {
                    var response =  JSON.parse(xhr.responseText);
                    if(response.hasOwnProperty('message')) {
                        $("#errorMsg").html(response.message[0]);
                    }
                }
            },
        }
    ).done(function (res)  {
        if(res.hasOwnProperty('success')){
            $('#signupId').submit();
        }
        else{
            $("#errorMsg").html('Try to add message latter.');
        }
    });
}
function validateFileExtension(file)
{
    var fileName = file.files[0].name;

    var extArr = new Array("jpg","pdf","jpeg","gif","png")
    var flag=0;
    var ext=fileName.substring(fileName.lastIndexOf('.')+1).toLowerCase();
    for(i=0;i<extArr.length;i++){
        if(ext==extArr[i]){
            return true;
        }
    }
    return false;
}

function validateImageSize(input)
{
    var img = new Image();

    img.src = window.URL.createObjectURL( input.files[0] );

    img.onload = function() {
        var width = img.naturalWidth,
            height = img.naturalHeight;

        window.URL.revokeObjectURL( img.src );

        if( width < 100 || width > 500 || height < 100 || height > 500) {
            $("#errorMsg").html('Image should be more than 100x100 and less than 500x500.');
        }
    };

}