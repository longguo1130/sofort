$(document).ready(function () {
  // initialize datepicker
  // var datepickerDivSelector = '.datepicker';

  // $('#datepicker').datepicker();
  //Date picker
  // $('#datepicker').datepicker({
    // autoclose: true
  // })

  //there should be one datepicker initiated so that means one hidden .datepicker div
  // equal($(datepickerDivSelector).length, 1);
  // this.component.datepicker('destroy');
  // equal($(datepickerDivSelector).length, 0);//hidden HTML should be gone
  // end initializing datepicker

  $('#delivery-grid').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": baseURL + 'Manage_delivery/get_deliveries'
  });
  
  $(document).delegate('.delete', 'click', function() { 
    if (confirm('Do you really want to delete record?')) {
      var id = $(this).attr('invoice_id');
      var parent = $(this).parent().parent();
      $.ajax({
        type: "POST",
        url:  baseURL + 'Manage_delivery/delete_delivery',
        data: 'invoice_id=' + id,
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
    
    var invoice_id = parent.children("td:nth-child(1)");
    var type = parent.children("td:nth-child(2)").children().html();
    console.log(type);
    var user = parent.children("td:nth-child(5)");
    var pickup_date = parent.children("td:nth-child(6)");
    var buttons = parent.children("td:nth-child(7)");

    $userhtml = '<select name="user_level" class="form-control">';
    if(fac_users.length > 0){
       for(var i =0 ; i < fac_users.length; i++){
          $userhtml += '<option value="' + fac_users[i]['user_id'] +'"><span style="background-color:#f00;">FU:</span>' + fac_users[i]['name'] + '</option>';
       }
    }

    if(dri_users.length > 0){
       for(var i =0 ; i < dri_users.length; i++){
          $userhtml += '<option value="' + dri_users[i]['user_id'] +'">DU:' + dri_users[i]['name'] + '</option>';
       }
    }
    $userhtml += '</select>';

    user.html($userhtml);  

    if (type == 'Postal') {
      // $datehtml = '<div class="input-group date">' + 
      //   '<div class="input-group-addon">' +
      //     '<i class="fa fa-calendar"></i>' + 
      //   '</div>' +
      //   '<input type="text" class="form-control pull-right" id="datepicker" name="pickup_date">' +
      // '</div>';
      pickup_date.html("<input type='text' name='pickup_date' value='" + pickup_date.html() + "'  class='form-control' placeholder='1/28/2020'/>");  
    
    } 

    buttons.html("<button type='button' class ='btn btn-outline-danger' id='save'>Save</button>&nbsp;&nbsp;<button type='button' class ='delete btn btn-outline-danger' invoice_id='" + invoice_id.html() + "'>Delete</button>");
  });
  
  $(document).delegate('#save', 'click', function() {
    var parent = $(this).parent().parent();
    
    var invoice_id = parent.children("td:nth-child(1)");
    var type = parent.children("td:nth-child(2)").children().html();
    console.log(type);
    var user = parent.children("td:nth-child(5)");
    var pickup_date = parent.children("td:nth-child(6)");
    var buttons = parent.children("td:nth-child(7)");
    
    if(type == 'Postal'){
        var data = 'invoice_id=' + invoice_id.html() + 
            '&user_id=' + user.children().find('option:selected').attr('value') + 
            '&user_name=' + user.children().find('option:selected').text() + 
            '&pickup_date=' + pickup_date.children("input[type=text]").val();
    } else {
        var data = 'invoice_id=' + invoice_id.html() + 
            '&user_id=' + user.children().find('option:selected').attr('value') +
            '&user_name=' + user.children().find('option:selected').text();
    }
    $.ajax({
      type: "POST",
      url: baseURL + 'Manage_delivery/update_delivery',
      data: data, 
      cache: false,
      success: function() {
        user.html(user.children().find('option:selected').text());
        pickup_date.html(pickup_date.children("input[type=text]").val());
        buttons.html("<button type='button' class='edit btn btn-sm btn-outline-danger' invoice_id='" + invoice_id.html() + "'>Edit</button>&nbsp;&nbsp;<button type ='button' class='delete btn btn-sm btn-outline-danger' invoice_id='" + invoice_id.html() + "'>Delete</button>");
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