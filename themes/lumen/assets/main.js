$(function() {
    $('.modalButton').click(function(e){
       e.preventDefault(); //for prevent default behavior of <a> tag.
       var tagname = $(this)[0].tagName;
       $('#editModalId').modal('show').find('.modalContent').load($(this).attr('href'));
   });

    $('#modalButtonBrand').click(function(){
     $('#modal').modal('show')
             .find('#modalContent')
             .load($(this).attr('value'));
  });

});


$(function() {
    $("body").on("beforeSubmit", "form#lesson-learned-form-id", function () {
        var form = $(this);
        // return false if form still have some validation errors
        if (form.find(".has-error").length) {
            return false;
        }
        // submit form
        $.ajax({
            url    : form.attr("action"),
            type   : "post",
            data   : form.serialize(),
            success: function (response) {
                $("#editModalId").modal("toggle");
                $.pjax.reload({container:"#lotcontrol-grid-container-id"}); //for pjax update
            },
            error  : function () {
                //console.log("internal server error");
            }
        });
        return false;
     });
});


//Yii 2 Delete Modal Confirm Box
yii.allowAction = function ($e) {
   var message = $e.data('confirm');
   return message === undefined || yii.confirm(message, $e);
};
yii.confirm = function (message, $e) {
   bootbox.confirm({
       title: 'Confirm',
       message: 'คุณต้องการลบ ข้อมูล ใช่หรือไม่ ?',            
       callback: function (result) {
           if (result) {
              yii.handleAction($e);
           }
       }
   });
   // confirm will always return false on the first call
   // to cancel click handler
  return false;
}

// --- Delete action (bootbox) ---
yii.confirm = function (message, ok, cancel) {
 
    bootbox.confirm(
        {
            message: message,
            buttons: {
                confirm: {
                    label: "ตกลง"
                },
                cancel: {
                    label: "ยกเลิก"
                }
            },
            callback: function (confirmed) {
                if (confirmed) {
                    !ok || ok();
                } else {
                    !cancel || cancel();
                }
            }
        }
    );
    // confirm will always return false on the first call
    // to cancel click handler
    return false;
}