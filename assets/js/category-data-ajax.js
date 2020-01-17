$(document).ready(function () {
  $('#category-grid').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": baseURL + 'Category/get_categories'
  });
  
  $(document).delegate('.delete', 'click', function() { 
    if (confirm('Do you really want to delete record?')) {
      var id = $(this).attr('category_id');
      var parent = $(this).parent().parent();
      $.ajax({
        type: "POST",
        url:  baseURL + 'Category/delete_category',
        data: 'category_id=' + id,
        cache: false,
        success: function() {
          parent.fadeOut('slow', function() {
            $(this).remove();
          });
        },
        error: function() {
          $('#err').html('<span style=\'color:red; font-weight: bold; font-size: 30px;\'>Error deleting record').fadeIn().fadeOut(4000, function() {
            $(this).remove();
          });
        }
      });
    }
  });
  
  $(document).delegate('.edit', 'click', function() {
    var parent = $(this).parent().parent();
    
    var category_id = parent.children("td:nth-child(1)");
    var category_title = parent.children("td:nth-child(2)");
    var category_desc = parent.children("td:nth-child(3)");
    var buttons = parent.children("td:nth-child(4)");

    category_title.html("<input type='text' id='txtCategoryTitle' value='"+category_title.html()+"' class='form-control'/>");
    category_desc.html("<input type='text' id='txtSubType' value='"+category_desc.html()+"'  class='form-control'/>");
    buttons.html("<button type='button' class ='btn btn-outline-danger' id='save'>Save</button>&nbsp;&nbsp;<button type='button' class ='delete btn btn-outline-danger' category_id='" + category_id.html() + "'>Delete</button>");
  });
  
  $(document).delegate('#save', 'click', function() {
    var parent = $(this).parent().parent();
    
    var category_id = parent.children("td:nth-child(1)");
    var category_title = parent.children("td:nth-child(2)");
    var category_desc = parent.children("td:nth-child(3)");
    var buttons = parent.children("td:nth-child(4)");
    
    $.ajax({
      type: "POST",
      url: baseURL + 'Category/update_category',
      data: 'category_id=' + category_id.html() + 
            '&category_title=' + category_title.children("input[type=text]").val() + 
            '&category_desc=' + category_desc.children("input[type=text]").val(), 
      cache: false,
      success: function() {
        category_id.html(category_id.children("input[type=text]").val());
        category_title.html(category_title.children("input[type=text]").val());
        category_desc.html(category_desc.children("input[type=text]").val());
        buttons.html("<button type='button' class='edit btn btn-sm btn-outline-danger' category_id='" + category_id.html() + "'>Edit</button>&nbsp;&nbsp;<button type ='button' class='delete btn btn-sm btn-outline-danger' category_id='" + category_id.html() + "'>Delete</button>");
      },
      error: function() {
        $('#err').html('<span style=\'color:red; font-weight: bold; font-size: 30px;\'>Error updating record').fadeIn().fadeOut(4000, function() {
          $(this).remove();
        });
      }
    });
  });
  
  $(document).delegate('#addNew', 'click', function(event) {
    event.preventDefault();
    
    var str = $('#add').serialize();

    console.log(str);
    $.ajax({
      type: "POST",
      url: baseURL + 'Category/add_category',
      data: str,
      cache: false,
      success: function() {
        $("#msgAdd").html( "<span style='color: green'>Product added successfully</span>" );
      },
      error: function() {
        $("#msgAdd").html( "<span style='color: red'>Error adding a new product</span>" );
      }
    });
  });
});