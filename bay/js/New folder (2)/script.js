$(document).ready(function($){
    $('#make').change(function(){
        $.get("{{ url('api/dropdown')}}", 
        { option: $(this).val() }, 
        function(data) {
            $('#model').empty(); 
            $.each(data, function(key, element) {
                $('#model').append("<option value='" + key +"'>" + element + "</option>");
            });
        });
    });
});