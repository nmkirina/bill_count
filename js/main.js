//changing style of upload button
$('input[type=file]').bootstrapFileInput();
$('.file-inputs').bootstrapFileInput();
//submit form after file uploading
$("#uploadButton").change(function(){
    $('#uploadForm').submit();
});

