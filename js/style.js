$( document ).ready(function() {
    $( "#btn_addMfg" ).click(function() {
         $('#md_addMfg').modal('show');
      });

      $( "#btn_addModel").click(function() {
        $('#md_addModel').modal('show');
     });
    
     //validation for forms

     $('#fm_mfgadd')
  .form({
    fields: {
      name: {
        identifier: 'in_MfgName',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please enter Manufacturer'
          }
        ]
      }
    }
    });

    $('#frm_addModel')
    .form({
      fields: {
        name: {
          identifier: 'in_ModelName',
          rules: [
            {
              type   : 'empty',
              prompt : 'Please enter Manufacturer'
            }
          ]
        },
        year: {
          identifier: 'in_ModelYear',
          rules: [
            {
              type   : 'empty',
              prompt : 'Please select at least two skills'
            }
          ]
        },
        number: {
          identifier: 'in_ModelNumber',
          rules: [
            {
              type   : 'empty',
              prompt : 'Please select at least two skills'
            }
          ]
        },
        
      }
      });
  

});
