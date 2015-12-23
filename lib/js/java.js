someFunction = function(resultit){
    var table = $('#kaltura').DataTable({
        "sPaginationType": "full_numbers",
        "bDestroy": true,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
        "iDisplayLength": 5,
        "responsive": true,
        "order": [[ 4, "asc" ]],
        "autoWidth": true,
        "paging":         true,
        "dom": '<"top"lf>t<"bottom"pi><"clear">'
    });
    $('#kaltura tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeAttr('data-toggle');
            $(this).removeAttr('data-target');
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $("td").click(function(e) {
        var checkbox = $(':radio', $(this).parent()).get(0);
        var checked = checkbox.checked;
        if (checked == false) checkbox.checked = true;
        else checkbox.checked = false;
    });
    $('.modal-backdrop').css({
        'position': 'relative'
    });
    $('#kaltura tbody').on( 'click', 'img', function () {
        var resultit = $(this).closest('tr').find('td:first').text();
        var titlecontent = $(this).closest('tr').find('td:eq(2)').text();
        var endtitle = "<h3 id='termsLabel' class='modal-title'>"+titlecontent+"</h3>"
        var spa = document.createElement('span');
        var titleget = document.getElementById('zaglavieto');
            $(this)[0].setAttribute('data-toggle', 'modal');
            $(this)[0].setAttribute('data-target', '#myModal');
            console.log(titlecontent);
            document.getElementById('embedbutton').setAttribute('value', resultit);
        titleget.innerHTML = endtitle;
        spa.content = KALTURA_SERVICE_URL+"/p/"+KALTURA_PARTNER_ID+"/sp/"+KALTURA_PARTNER_ID+"00/thumbnail/entry_id/"+resultit+"/version/100000/acv/162";
        document.getElementById("kaltura_player_1437197987").innerHTML=spa;
        kaltpalyer(resultit);
    });
};
kaltpalyer = function (resultit){
    kWidget.embed({
        'targetId': 'kaltura_player_1437197987',
        'wid': '_'+KALTURA_PARTNER_ID,
        'uiconf_id' : KALTURA_PARTNER_UI_CONFIG,
        'entry_id' : resultit,
        'readyCallback': function( playerId ){
            var kdp = $( '#' + playerId ).get(0);
        },
        'flashvars':{'autoPlay': false},
        'params':{'wmode': 'transparent'}
    });
};
stopVideo = function(){
    kWidget.addReadyCallback( function( playerId ){
        var kdp = $( '#' + playerId ).get(0);
        kdp.sendNotification("doPause");
    });
};

formDropDown = function(){
  $( ".btn_form_sumbmit" ).click(function () {
    if ( $( "table:first" ).is( ":hidden" ) ) {
      $( "table" ).show( "slow" );
    } else {
      $( "table" ).hide( "slow" );
    }
  });
};


code_snippet = function () {
  function html(s) {
    return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
  }
  var in_embed_code = document.getElementById('frm_emebed_code').innerHTML;
  var quineHtml = html(in_embed_code);
  quineHtml = quineHtml.replace(
    /&lt;script src[\s\S]*?&gt;&lt;\/script&gt;|&lt;!--\?[\s\S]*?--&gt;|&lt;pre\b[\s\S]*?&lt;\/pre&gt;/g,
    '<span class="operative">$&</span>');
  document.getElementById("quine").innerHTML = quineHtml;
};
