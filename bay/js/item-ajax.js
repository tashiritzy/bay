var page = 1;

var current_page = 1;

var total_page = 0;

var is_ajax_fire = 0;


manageData();


/* manage data list */

function manageData() {

    $.ajax({

        dataType: 'json',

        url: url,

        data: {page:page}

    }).done(function(data){


    	total_page = data.last_page;

    	current_page = data.current_page;


    	$('#pagination').twbsPagination({

	        totalPages: total_page,

	        visiblePages: current_page,

	        onPageClick: function (event, pageL) {

	        	page = pageL;

                if(is_ajax_fire != 0){

	        	  getPageData();

                }

	        }

	    });


    	manageRow(data.data);

        is_ajax_fire = 1;

    });

}


$.ajaxSetup({

    headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

});


/* Get Page Data*/

function getPageData() {

	$.ajax({

    	dataType: 'json',

    	url: url,

    	data: {page:page}

	}).done(function(data){

		manageRow(data.data);

	});

}


/* Add new Item table row */

function manageRow(data) {

	var	rows = '';

	$.each( data, function( key, value ) {

	  	rows = rows + '<tr>';

	  	rows = rows + '<td>'+value.businessname+'</td>';

	  	rows = rows + '<td>'+value.description+'</td>';

	  	rows = rows + '<td data-id="'+value.id+'">';

                rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';

                rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';

                rows = rows + '</td>';

	  	rows = rows + '</tr>';

	});


	$("tbody").html(rows);

}


/* Create new Item */

$(".crud-submit").click(function(e){

    e.preventDefault();

    var form_action = $("#create-item").find("form").attr("action");

    var title = $("#create-item").find("input[name='title']").val();

    var description = $("#create-item").find("textarea[name='description']").val();


    $.ajax({

        dataType: 'json',

        type:'POST',

        url: form_action,

        data:{title:title, description:description}

    }).done(function(data){

        getPageData();

        $(".modal").modal('hide');

        toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 5000});

    });


});


/* Remove Item */

$("body").on("click",".remove-item",function(){

    var id = $(this).parent("td").data('id');

    var c_obj = $(this).parents("tr");

    $.ajax({

        dataType: 'json',

        type:'delete',

        url: url + '/' + id,

    }).done(function(data){

        c_obj.remove();

        toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});

        getPageData();

    });

});


/* Edit Item */

$("body").on("click",".edit-item",function(){

    var id = $(this).parent("td").data('id');

    var businessname = $(this).parent("td").prev("td").prev("td").text();

    var description = $(this).parent("td").prev("td").text();

    $("#edit-item").find("input[name='businessname']").val(businessname);

    $("#edit-item").find("textarea[name='description']").val(description);

    $("#edit-item").find("form").attr("action",url + '/' + id);

});


/* Updated new Item */

$(".crud-submit-edit").click(function(e){

    e.preventDefault();

    var form_action = $("#edit-item").find("form").attr("action");

    var businessname = $("#edit-item").find("input[name='businessname']").val();

    var description = $("#edit-item").find("textarea[name='description']").val();
	
	//document.writeln(form_action);


    $.ajax({

        dataType: 'json',

        type:'PUT',

        url: form_action,

        data:{businessname:businessname, description:description}

    }).done(function(data){
		
        getPageData();
		
		document.writeln(url);

        $(".modal").modal('hide');

        toastr.success('Unit Updated Successfully.', 'Success Alert', {timeOut: 5000});

    });

});

/* User Profile Item */

$("body").on("click",".uprofile-item",function(){

    var id = $(this).parent("td").data('id');

    var businessname = $(this).parent("td").prev("td").prev("td").text();

    var description = $(this).parent("td").prev("td").text();

    $("#uprofile-item").find("input[name='businessname']").val(businessname);

    $("#uprofile-item").find("textarea[name='description']").val(description);

    $("#uprofile-item").find("form").attr("action",url + '/' + id);

});