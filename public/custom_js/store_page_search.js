$(document).ready(function () {

    //search bar work

   $('#search_on_cat_name').on('keyup', function () {

    var search_value = $(this).val();

    $.ajax({
    url: "store_pagination_start_search",
    type: "GET",
    data: {search_value:search_value},
    success: function (data) {

        $("#main_content_table").html('');
        $('#main_content_table').html(data.options);

    }
});

});


$("[id^=page_link]").click(function(){

    var search_value = $('#search_value').val();
 var main_id = $(this).attr('id');
 var id_for_pass = main_id.slice(9);
 //alert(id_for_pass);

 //var token = $("input[name='_token']").val();
 $.ajax({
 url: "store_pagination_start_search_ajax",
 method: 'GET',
 data: {id_for_pass:id_for_pass,search_value:search_value},
 success: function(data) {
  $("#main_content_table").html('');
  $("#main_content_table").html(data.options);
 }
 });

 });

 //next page button
 $("#npage_link").click(function(){
    var search_value = $('#search_value').val();
 var id_for_pass = 2;

 $.ajax({
 url: "store_pagination_start_search_ajax",
 method: 'GET',
 data: {id_for_pass:id_for_pass,search_value:search_value},
 success: function(data) {
  $("#main_content_table").html('');
  $("#main_content_table").html(data.options);
 }
 });

 });


 $("[id^=apage_link]").click(function(){

    var search_value = $('#search_value').val();
var main_id = $(this).attr('id');
var id_for_pass = main_id.slice(10);
//alert(id_for_pass);

// var token = $("input[name='_token']").val();
$.ajax({
url: "store_pagination_start_search_ajax",
method: 'GET',
data: {id_for_pass:id_for_pass,search_value:search_value},
success: function(data) {
  $("#main_content_table").html('');
  $("#main_content_table").html(data.options);
}
});

});

//next button
$("[id^=napage_link]").click(function(){
    var search_value = $('#search_value').val();
var main_id = $(this).attr('id');
var id_for_pass1 = main_id.slice(11);
var id_for_pass = parseInt(id_for_pass1) + parseInt(1);

// alert(id_for_pass);

$.ajax({
url: "store_pagination_start_search_ajax",
method: 'GET',
data: {id_for_pass:id_for_pass,search_value:search_value},
success: function(data) {
  $("#main_content_table").html('');
  $("#main_content_table").html(data.options);
}
});

});
//end next button


//previous button
$("[id^=papage_link]").click(function(){
    var search_value = $('#search_value').val();
var main_id = $(this).attr('id');
var id_for_pass1 = main_id.slice(11);
var id_for_pass = parseInt(id_for_pass1) - parseInt(1);

// alert(id_for_pass);

$.ajax({
url: "store_pagination_start_search_ajax",
method: 'GET',
data: {id_for_pass:id_for_pass,search_value:search_value},
success: function(data) {
  $("#main_content_table").html('');
  $("#main_content_table").html(data.options);
}
});

});
//end previous button


});
