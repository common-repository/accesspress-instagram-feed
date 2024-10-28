(function ($) {
    $(function () {
      //All the backend js for the plugin

      if($('#instagram_access_token').val() !== ''){
            var access = window.location.hash.substring(14);
            var url = window.location.href;
            var arr = url.split('&');
            arr.pop();
            //console.log(arr[0]);
            window.history.replaceState(null, null, arr[0]);
        }
        
       /*
       Settings Tabs Switching
       */
       $('.apsc-tabs-trigger').click(function(){
        $('.apsc-tabs-trigger').removeClass('apsc-active-tab');
        $(this).addClass('apsc-active-tab');
        var board_id = 'apsc-board-'+$(this).attr('id');
        $('.apsc-boards-tabs').hide();
        $('#'+board_id).show();
       });

       /**
        * For sortable
        */
       $('.apsc-sortable').sortable({containment: "parent"});

	});
}(jQuery));
