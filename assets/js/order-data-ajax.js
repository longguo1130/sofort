
// $(document).ready(function () {
  // $('#product-grid').DataTable({
  //   "processing": true,
  //   "serverSide": true,
  //   "ajax": baseURL + '/Option/get_options/' + $('#m_form_type').val()
  // });
  
  // $(document).delegate('.delete', 'click', function() { 
  //   if (confirm('Do you really want to delete record?')) {
  //     var id = $(this).attr('repair_id');
  //     var parent = $(this).parent().parent();
  //     $.ajax({
  //       type: "POST",
  //       url:  baseURL + 'Option/delete_option',
  //       data: 'repair_id=' + id,
  //       cache: false,
  //       success: function() {
  //         parent.fadeOut('slow', function() {
  //           $(this).remove();
  //         });
  //       },
  //       error: function() {
  //         $('#err').html('<span style=\'color:red; font-weight: bold; font-size: 30px;\'>Error deleting record').fadeIn().fadeOut(4000, function() {
  //           $(this).remove();
  //         });
  //       }
  //     });
  //   }
  // });
  
  // $(document).delegate('.edit', 'click', function() {
  //   var parent = $(this).parent().parent();
    
  //   var repair_id = parent.children("td:nth-child(1)");
  //   var repair_or_service = parent.children("td:nth-child(2)");
  //   var sub_type = parent.children("td:nth-child(3)");
  //   var repair_title = parent.children("td:nth-child(4)");
  //   var repair_summary = parent.children("td:nth-child(5)");
  //   var repair_price = parent.children("td:nth-child(6)");
  //   var price_down = parent.children("td:nth-child(7)");
  //   var buttons = parent.children("td:nth-child(8)");

  //   repair_or_service.html("<input type='text' id='txtRepairOrService' value='"+repair_or_service.html()+"'  class='form-control'/>");
  //   sub_type.html("<input type='text' id='txtSubType' value='"+sub_type.html()+"' class='form-control'/>");
  //   repair_title.html("<input type='text' id='txtRepairTitle' value='"+repair_title.html()+"'  class='form-control'/>");
  //   repair_summary.html("<input type='text' id='txtRepairSummary' value='"+repair_summary.html()+"'  class='form-control'/>");
  //   repair_price.html("<input type='text' id='txtRepairPrice' value='" + repair_price.html()+"'  class='form-control'/>");
  //   price_down.html("<input type='text' id='txtPriceDown' value='" + price_down.html()+"' class='form-control'/>");
  //   buttons.html("<button type='button' class ='btn btn-outline-danger' id='save'>Save</button>&nbsp;&nbsp;<button type='button' class ='delete btn btn-outline-danger' repair_id='" + repair_id.html() + "'>Delete</button>");
  // });
  
  // $(document).delegate('#save', 'click', function() {
  //   var parent = $(this).parent().parent();
    
  //   var repair_id = parent.children("td:nth-child(1)");
  //   var repair_or_service = parent.children("td:nth-child(2)");
  //   var sub_type = parent.children("td:nth-child(3)");
  //   var repair_title = parent.children("td:nth-child(4)");
  //   var repair_summary = parent.children("td:nth-child(5)");
  //   var repair_price = parent.children("td:nth-child(6)");
  //   var price_down = parent.children("td:nth-child(7)");
  //   var buttons = parent.children("td:nth-child(8)");
    
  //   $.ajax({
  //     type: "POST",
  //     url: baseURL + 'Option/update_option',
  //     data: 'repair_id=' + repair_id.html() + 
  //           '&repair_or_service=' + repair_or_service.children("input[type=text]").val() + 
  //           '&sub_type=' + sub_type.children("input[type=text]").val() + 
  //           '&repair_title=' + repair_title.children("input[type=text]").val() + 
  //           '&repair_summary=' + repair_summary.children("input[type=text]").val() + 
  //           '&repair_price=' + repair_price.children("input[type=text]").val() + 
  //           '&price_down=' + price_down.children("input[type=text]").val(),
  //     cache: false,
  //     success: function() {
  //       repair_or_service.html(repair_or_service.children("input[type=text]").val());
  //       sub_type.html(sub_type.children("input[type=text]").val());
  //       repair_title.html(repair_title.children("input[type=text]").val());
  //       repair_summary.html(repair_summary.children("input[type=text]").val());
  //       repair_price.html(repair_price.children("input[type=text]").val());
  //       price_down.html(price_down.children("input[type=text]").val());
  //       buttons.html("<button type='button' class='edit btn btn-outline-danger' repair_id='" + repair_id.html() + "'>Edit</button>&nbsp;&nbsp;<button type ='button' class='delete btn btn-outline-danger' repair_id='" + repair_id.html() + "'>Delete</button>");
  //     },
  //     error: function() {
  //       $('#err').html('<span style=\'color:red; font-weight: bold; font-size: 30px;\'>Error updating record').fadeIn().fadeOut(4000, function() {
  //         $(this).remove();
  //       });
  //     }
  //   });
  // });
  
  // $(document).delegate('#addNew', 'click', function(event) {
  //   event.preventDefault();
    
  //   var str = $('#add').serialize();
  //   str = str + '&category_id=' + $('#m_form_status').find('option:selected').attr('value') + 
  //          '&category_title=' + $('#m_form_status').find('option:selected').text() +
  //          '&product_id=' + $('#m_form_type').find('option:selected').attr('value') +
  //          '&product_title=' + $('#m_form_type').find('option:selected').text();
  //   console.log(str);
  //   $.ajax({
  //     type: "POST",
  //     url: baseURL + 'Option/add_option',
  //     data: str,
  //     cache: false,
  //     success: function() {
  //       $("#msgAdd").html( "<span style='color: green'>Product added successfully</span>" );
  //     },
  //     error: function() {
  //       $("#msgAdd").html( "<span style='color: red'>Error adding a new product</span>" );
  //     }
  //   });
  // });
// });

//== Class definition

// var DatatableRemoteAjaxDemo = function() {
  //== Private functions

  // basic demo
  // var demo = function() {

  //   $old_selector = '#None';
  //   $('#m_form_status').on('change', function() {
  //     $html = '<option value="-1">None</option>';
  //     if(typeof options[$('#m_form_status').val()] !== 'undefined'){
  //       $products = options[$('#m_form_status').val()];
  //       for(var i = 0; i < $products.length; i++){
  //          $html += '<option value="' + $products[i]['product_id'] +'">' + $products[i]['product_title'] + '</option>';
  //       }
  //     }
      
  //     $('#m_form_type').html($html);
  //     $('#m_form_type').selectpicker('refresh');
  //   });

  //   $('#m_form_status, #m_form_type').selectpicker();

  //   $('#m_form_type').on('change', function() {
  //     // datatable.search($(this).val().toLowerCase(), 'Type');
  //     $url = baseURL + 'Product/get_one_product/' + $('#m_form_status').val() + "/" + $('#m_form_type').val();
      
  //     $.ajax({
  //       url : $url, 
  //       type: 'get',
  //       success: function(data){
  //           var obj = JSON.parse(data);
            // var datatable = $('#m_datatable').data('mDatatable');
            // datatable.data.source = obj;
//         }
//       });


//     });

//   };

//   return {
//     // public functions
//     init: function() {
//       demo();
//     },
//   };
// }();

/* Formatting function for row details - modify as you need */

var table;

$(document).ready(function() {

  $('#m_form_type').selectpicker();

  $('#show_options').click(function(e){
    e.preventDefault();
    $('#order-grid tbody').undelegate();
    console.log($('#m_form_type').val());
    table = $('#order-grid').DataTable({
      "destroy": true,
      "processing": true,
      "serverSide": true,
      "ajax": baseURL + 'Order/get_options?status='+ $('#m_form_type').val(),
      'columns': [
          {
              'className':      'details-control',
              // 'orderable':      false,
              'data':           null,
              'defaultContent': ''
          },{},{},{},{},{},{},{},{},{},{},
          {
              'className':      'show-disabled',
          }
      ],
    });

    // $('#order-grid').DataTable().empty();
    // table = $('#order-grid').DataTable();

    // Add event listener for opening and closing details
    $('#order-grid tbody').delegate('td.details-control' , 'click', function(){
        
        console.log("clicked");
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        //console.log(row.data());
        $selector = '#' + row.data()[5];
        var detail_orders = $($selector).attr('val');

        if(row.child.isShown()){
             // This row is already open - close it
             row.child.hide();
             tr.removeClass('shown');
         } else {
             // Open this row
             var obj = JSON.parse(detail_orders);
             row.child(format(obj)).show();
             tr.addClass('shown');
         }

         return;

    });
  });

  $(document).undelegate('.edit');
  $(document).delegate('.edit', 'click', function() {

    console.log("clicked");
    var parent = $(this).parent().parent().parent();
    
    var invoice_id = $(this).attr('invoice_id');
    var status = parent.children("td:nth-child(8)");
    var end_timstamp = parent.children("td:nth-child(10)");
    var buttons = parent.children("td:nth-child(11)");

    status.html("<select class='form-control'><option value ='1'>Completed</option><option value ='2'>InProgress</option><option value ='3'>Cancel</option></select>");
    end_timstamp.html("<input type='text' id='txtEndDate' value='"+ end_timstamp.html()+"'  class='form-control'/>");
    buttons.html("<div style='display:flex;'><button type='button' class ='btn btn-outline-danger' id='save' invoice_id='" + invoice_id + "'>Save</button>&nbsp;&nbsp;<button type='button' class ='delete btn btn-outline-danger' invoice_id='" + invoice_id + "'>Delete</button></div>");
  });
  
  $(document).delegate('#save', 'click', function() {
    var parent = $(this).parent().parent().parent();
    
    var invoice_id = $(this).attr('invoice_id');
    var status = parent.children("td:nth-child(8)");
    var end_timstamp = parent.children("td:nth-child(10)");
    var buttons = parent.children("td:nth-child(11)");
    
    $.ajax({
      type: "POST",
      url: baseURL + 'Order/update_option',
      data: 'invoice_id=' + invoice_id + 
            '&status=' + status.children().val() + 
            '&end_timestamp=' + end_timstamp.children("input[type=text]").val(),
      cache: false,
      success: function() {
        var status_html = '';
        switch (status.children().val()) {
          case '1':
            status_html = '<button type=\'button\' class=\'btn btn-sm btn-success\'>Completed</button>';
            break;
          case '2':
            status_html = '<button type=\'button\' class=\'btn btn-sm btn-primary\'>InProgress</button>';
            break;
          case '3':
            status_html = '<button type=\'button\' class=\'btn btn-sm btn-danger\'>Cancel</button>';
            break;
        }
        status.html(status_html);
        end_timstamp.html(end_timstamp.children("input[type=text]").val());
        buttons.html("<div style='display:flex'><button type='button' class='edit btn btn-outline-danger btn-sm' invoice_id='" + invoice_id + "'>Edit</button>&nbsp;&nbsp;<button type ='button' class='delete btn btn-outline-danger btn-sm' invoice_id='" + invoice_id + "'>Delete</button></div>");
      },
      error: function() {
        $('#err').html('<span style=\'color:red; font-weight: bold; font-size: 30px;\'>Error updating record').fadeIn().fadeOut(4000, function() {
          $(this).remove();
        });
      }
    });
  });

  $(document).delegate('.delete', 'click', function() { 
      if (confirm('Do you really want to delete record?')) {
        var invoice_id = $(this).attr('invoice_id');
        var parent = $(this).parent().parent().parent();
        $.ajax({
          type: "POST",
          url:  baseURL + 'Order/delete_option',
          data: 'invoice_id=' + invoice_id,
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
});


function format ( d ) {
    if (d !== null) {
      var html = '<table class="table table-bordered table-striped">' +
          '<thead>' +
          '<tr class = "info">' +
          '<td>Category</td>' +
          '<td>Product</td>' +
          '<td>Option</td>' +
          '<td>RepairTitle</td>' +
          '<td>RepairSummary</td>' +
          '<td>Price</td>' +
          '<td>ExtraError</td>' +
          '<td>PriceDown</td>' +
          '</tr></thead>' +
          '<tbody>';
       for (var i = 0; i < d.length; i++) {
         var row = d[i];
         html += '<tr>' +
          '<td>' + row['category_title'] + '</td>' +
          '<td>' + row['product_title'] + '</td>';
          '<td>' + row['repair_or_service'] + '</td>'
         if (row['repair_or_service'] == 1) {
          html += '<td><button class="btn btn-sm btn-success">Repair</button></td>'
         } else if (row['repair_or_service'] == 2){
          html += '<td><button class="btn btn-sm btn-primary">Service</button></td>'
         }
         html+= 
          '<td>' + row['repair_title'] +'</td>' +
          '<td>' + row['repair_summary'] +'</td>' +
          '<td>'+ row['repair_price'] +'</td>' +
          '<td>'+ row['extra_error'] +'</td>' +
          '<td>'+ row['price_down'] +'</td>' +
          '</tr>';
       }
         html += '</tbody>' 
      + '</table>';
      
    }
    return html;
    
}

