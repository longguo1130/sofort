$(document).ready(function () {
  // $('#product-grid').DataTable({
  //   "processing": true,
  //   "serverSide": true,
  //   "ajax": baseURL + '/Option/get_options/' + $('#m_form_type').val()
  // });
  
  $(document).delegate('.delete', 'click', function() { 
    if (confirm('Do you really want to delete record?')) {
      var id = $(this).attr('repair_id');
      var parent = $(this).parent().parent();
      $.ajax({
        type: "POST",
        url:  baseURL + 'Option/delete_option',
        data: 'repair_id=' + id,
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
    
    var repair_id = parent.children("td:nth-child(1)");
    var repair_or_service = parent.children("td:nth-child(2)");
    var sub_type = parent.children("td:nth-child(3)");
    var repair_title = parent.children("td:nth-child(4)");
    var repair_summary = parent.children("td:nth-child(5)");
    var repair_price = parent.children("td:nth-child(6)");
    var price_down = parent.children("td:nth-child(7)");
    var buttons = parent.children("td:nth-child(8)");

    repair_or_service.html("<input type='text' id='txtRepairOrService' value='"+repair_or_service.html()+"'/>");
    sub_type.html("<input type='text' id='txtSubType' value='"+sub_type.html()+"'/>");
    repair_title.html("<input type='text' id='txtRepairTitle' value='"+repair_title.html()+"'/>");
    repair_summary.html("<input type='text' id='txtRepairSummary' value='"+repair_summary.html()+"'/>");
    repair_price.html("<input type='text' id='txtRepairPrice' value='" + repair_price.html()+"'/>");
    price_down.html("<input type='text' id='txtPriceDown' value='" + price_down.html()+"'/>");
    buttons.html("<button type='button' class ='btn btn-outline-danger' id='save'>Save</button>&nbsp;&nbsp;<button type='button' class ='delete btn btn-outline-danger' repair_id='" + repair_id.html() + "'>Delete</button>");
  });
  
  $(document).delegate('#save', 'click', function() {
    var parent = $(this).parent().parent();
    
    var repair_id = parent.children("td:nth-child(1)");
    var repair_or_service = parent.children("td:nth-child(2)");
    var sub_type = parent.children("td:nth-child(3)");
    var repair_title = parent.children("td:nth-child(4)");
    var repair_summary = parent.children("td:nth-child(5)");
    var repair_price = parent.children("td:nth-child(6)");
    var price_down = parent.children("td:nth-child(7)");
    var buttons = parent.children("td:nth-child(8)");
    
    $.ajax({
      type: "POST",
      url: baseURL + 'Option/update_option',
      data: 'repair_id=' + repair_id.html() + 
            '&repair_or_service=' + repair_or_service.children("input[type=text]").val() + 
            '&sub_type=' + sub_type.children("input[type=text]").val() + 
            '&repair_title=' + repair_title.children("input[type=text]").val() + 
            '&repair_summary=' + repair_summary.children("input[type=text]").val() + 
            '&repair_price=' + repair_price.children("input[type=text]").val() + 
            '&price_down=' + price_down.children("input[type=text]").val(),
      cache: false,
      success: function() {
        repair_or_service.html(repair_or_service.children("input[type=text]").val());
        sub_type.html(sub_type.children("input[type=text]").val());
        repair_title.html(repair_title.children("input[type=text]").val());
        repair_summary.html(repair_summary.children("input[type=text]").val());
        repair_price.html(repair_price.children("input[type=text]").val());
        price_down.html(price_down.children("input[type=text]").val());
        buttons.html("<button type='button' class='edit btn btn-outline-danger' repair_id='" + repair_id.html() + "'>Edit</button>&nbsp;&nbsp;<button type ='button' class='delete btn btn-outline-danger' repair_id='" + repair_id.html() + "'>Delete</button>");
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
    str = str + '&category_id=' + $('#m_form_status').find('option:selected').attr('value') + 
           '&category_title=' + $('#m_form_status').find('option:selected').text() +
           '&product_id=' + $('#m_form_type').find('option:selected').attr('value') +
           '&product_title=' + $('#m_form_type').find('option:selected').text();
    console.log(str);
    $.ajax({
      type: "POST",
      url: baseURL + 'Option/add_option',
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

//== Class definition

var DatatableRemoteAjaxDemo = function() {
  //== Private functions

  // basic demo
  var demo = function() {

    $old_selector = '#None';
    $('#m_form_status').on('change', function() {
      $html = '<option value="-1">None</option>';
      if(typeof options[$('#m_form_status').val()] !== 'undefined'){
        $products = options[$('#m_form_status').val()];
        for(var i = 0; i < $products.length; i++){
           $html += '<option value="' + $products[i]['product_id'] +'">' + $products[i]['product_title'] + '</option>';
        }
      }
      
      $('#m_form_type').html($html);
      $('#m_form_type').selectpicker('refresh');
    });

    $('#m_form_status, #m_form_type').selectpicker();

    $('#m_form_type').on('change', function() {
      // datatable.search($(this).val().toLowerCase(), 'Type');
      $url = baseURL + 'Product/get_one_product/' + $('#m_form_status').val() + "/" + $('#m_form_type').val();
      
      $.ajax({
        url : $url, 
        type: 'get',
        success: function(data){
            var obj = JSON.parse(data);
            // var datatable = $('#m_datatable').data('mDatatable');
            // datatable.data.source = obj;
        }
      });


    });

  };

  return {
    // public functions
    init: function() {
      demo();
    },
  };
}();

jQuery(document).ready(function() {
  DatatableRemoteAjaxDemo.init();
  $url = baseURL + 'Product/get_one_product/' + $('#m_form_status').val() + "/" + $('#m_form_type').val();
  console.log($url);  
  
  $('#show_options').click(function(){
    console.log($('#m_form_type').val());
    // $('#product-grid').destroy();
    $('#product-grid').DataTable({
      "destroy": true,
      "processing": true,
      "serverSide": true,
      "ajax": baseURL + '/Option/get_options/' + $('#m_form_type').val()
    });
    
  })
});