$(document).ready(function () {
  $('#user-grid').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": baseURL + 'User/get_users'
  });
  
  $(document).delegate('.delete', 'click', function() { 
    if (confirm('Do you really want to delete record?')) {
      var id = $(this).attr('user_id');
      var parent = $(this).parent().parent();
      $.ajax({
        type: "POST",
        url:  baseURL + 'User/delete_user',
        data: 'user_id=' + id,
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
    
    var user_id = parent.children("td:nth-child(1)");
    var name = parent.children("td:nth-child(2)");
    var first_name = parent.children("td:nth-child(3)");
    var surname = parent.children("td:nth-child(4)");
    // var company_name = parent.children("td:nth-child(5)");
    var address = parent.children("td:nth-child(5)");
    var postcode = parent.children("td:nth-child(6)");
    var place = parent.children("td:nth-child(7)");
    var country = parent.children("td:nth-child(8)");
    // var reg_no = parent.children("td:nth-child(10)");
    var email = parent.children("td:nth-child(9)");
    var telephone_no = parent.children("td:nth-child(10)");
    // var password = parent.children("td:nth-child(13)");
    var user_level = parent.children("td:nth-child(11)");
    // var customer_id = parent.children("td:nth-child(14)");
    
    var buttons = parent.children("td:nth-child(12)");
    buttons.css({display: "flex"});

    // user_id.html("<input type='text' id='txtuserid' value='"+user_id.html()+"'/>");
    name.html("<input type='text' id='txtname' value='"+name.html()+"' class='form-control'/>");
    first_name.html("<input type='text' id='txtfirstname' value='"+first_name.html()+"' class='form-control'/>");
    surname.html("<input type='text' id='txtsurname' value='"+surname.html()+"' class='form-control'/>");
    address.html("<input type='text' id='txtaddress' value='"+address.html()+"' class='form-control'/>");
    postcode.html("<input type='text' id='txtpostcode' value='"+postcode.html()+"' class='form-control'/>");
    place.html("<input type='text' id='txtplace' value='"+place.html()+"' class='form-control'/>");
    country.html("<input type='text' id='txtcountry' value='"+country.html()+"' class='form-control'/>");
    // reg_no.html("<input type='text' id='txtregno' value='"+reg_no.html()+"'/>");
    email.html("<input type='text' id='txtemail' value='"+email.html()+"' class='form-control'/>");
    telephone_no.html("<input type='text' id='txttelephoneno' value='"+telephone_no.html()+"' class='form-control'/>");
    // password.html("<input type='text' id='txtpassword' value='"+password.html()+"'/>");
    user_level.html("<select class='form-control'><option value='1'>Admin User</option><option value='2'>Business User</option><option value='3'>Partner User</option><option value='4'>Facility User</option><option value='5'>Driver User</option><option value='6'>Normal User</option></select>");
    // customer_id.html("<input type='text' id='txtcustomerid' value='"+customer_id.html()+"'/>");
    buttons.html("<button type='button' class ='btn btn-outline-danger' id='save'>Save</button>&nbsp;&nbsp;<button type='button' class ='delete btn btn-outline-danger' user_id='" + user_id.html() + "'>Delete</button>");
  });
  
  $(document).delegate('#save', 'click', function() {
    var parent = $(this).parent().parent();
    
    var user_id = parent.children("td:nth-child(1)");
    var name = parent.children("td:nth-child(2)");
    var first_name = parent.children("td:nth-child(3)");
    var surname = parent.children("td:nth-child(4)");
    // var company_name = parent.children("td:nth-child(5)");
    var address = parent.children("td:nth-child(5)");
    var postcode = parent.children("td:nth-child(6)");
    var place = parent.children("td:nth-child(7)");
    var country = parent.children("td:nth-child(8)");
    // var reg_no = parent.children("td:nth-child(10)");
    var email = parent.children("td:nth-child(9)");
    var telephone_no = parent.children("td:nth-child(10)");
    // var password = parent.children("td:nth-child(13)");
    var user_level = parent.children("td:nth-child(11)");
    // var customer_id = parent.children("td:nth-child(14)");
    
    var buttons = parent.children("td:nth-child(12)");
    
    $.ajax({
      type: "POST",
      url: baseURL + 'User/update_user',
      data: 'user_id=' + user_id.html() + 
            '&name=' + name.children("input[type=text]").val() + 
            '&first_name=' + first_name.children("input[type=text]").val() +
            '&surname=' + surname.children("input[type=text]").val() +
            // '&company_name=' + company_name.children("input[type=text]").val() +
            '&address=' + address.children("input[type=text]").val() +
            '&postcode=' + postcode.children("input[type=text]").val() +
            '&place=' + place.children("input[type=text]").val() +
            '&country=' + country.children("input[type=text]").val() +
            // '&reg_no=' + reg_no.children("input[type=text]").val() +
            '&email=' + email.children("input[type=text]").val() +
            '&telephone_no=' + telephone_no.children("input[type=text]").val() +
            // '&password=' + password.children("input[type=text]").val() +
            '&user_level=' + user_level.children().val() 
            // + '&customer_id=' + customer_id.children("input[type=text]").val()
            , 
      cache: false,
      success: function() {
        // user_id.html(user_id.children("input[type=text]").val());
        name.html(name.children("input[type=text]").val());
        first_name.html(first_name.children("input[type=text]").val());
        surname.html(surname.children("input[type=text]").val());
        address.html(address.children("input[type=text]").val());
        postcode.html(postcode.children("input[type=text]").val());
        place.html(place.children("input[type=text]").val());
        country.html(country.children("input[type=text]").val());
        // reg_no.html(reg_no.children("input[type=text]").val());
        email.html(email.children("input[type=text]").val());
        telephone_no.html(telephone_no.children("input[type=text]").val());
        // password.html(password.children("input[type=text]").val());
        var html = '';
        switch (user_level.children().val()) {
          
          case '1':
            html = '<button type=\'button\' class=\'btn btn-sm btn-danger\'>Admin User</button>';
            break;
          case '2':
            html = '<button type=\'button\' class=\'btn btn-sm btn-primary\'>Business User</button>';
            break;
          case '3':
            html = '<button type=\'button\' class=\'btn btn-sm btn-secondary\'>Partner User</button>';
            break;
          case '4':
            html = '<button type=\'button\' class=\'btn btn-sm btn-success\'>Facility User</button>';
            break;
          case '5':
            html = '<button type=\'button\' class=\'btn btn-sm btn-warning\'>Driver User</button>';
            break;
          case '6':
            html = '<button type=\'button\' class=\'btn btn-sm btn-info\'>Normal User</button>';
            break;
        }
        user_level.html(html);
        // customer_id.html(customer_id.children("input[type=text]").val());
        
        buttons.html("<button type='button' class='edit btn  btn-sm btn-outline-danger' user_id='" + user_id.html() + "'>Edit</button>&nbsp;&nbsp;<button type ='button' class='delete btn btn-sm btn-outline-danger' user_id='" + user_id.html() + "'>Delete</button>");
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
      url: baseURL + 'User/add_user',
      data: str,
      cache: false,
      success: function() {
        $("#msgAdd").html( "<span style='color: green'>User added successfully</span>" );
      },
      error: function() {
        $("#msgAdd").html( "<span style='color: red'>Error adding a new user</span>" );
      }
    });
  });
});