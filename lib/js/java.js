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
        $('#myModal').attr('data_id', resultit);
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
  $( ".btn_form_show" ).click(function () {
    if ( $( "table:first" ).is( ":hidden" ) ) {
      $( "table" ).show( "slow" );
    } else {
      $( "table" ).hide( "slow" );
    }
  });
};

select_all_text = function(){
  jQuery.fn.selectText = function(){
    this.find('input').each(function() {
      if($(this).prev().length == 0 || !$(this).prev().hasClass('p_copy')) {
        $('<p class="p_copy" style="position: absolute; z-index: -1;"></p>').insertBefore($(this));
      }
      $(this).prev().html($(this).val());
    });
    var doc = document;
    var element = this[0];
    console.log(this, element);
      if (doc.body.createTextRange) {
        var range = document.body.createTextRange();
          range.moveToElementText(element);
            range.select();
          } else if (window.getSelection) {
            var selection = window.getSelection();
            var range = document.createRange();
              range.selectNodeContents(element);
              selection.removeAllRanges();
              selection.addRange(range);
            }
          };
          $(function() {
            $('#btncopy').click(function() {
              $('#quine').selectText();
            });
          });
        };
        

        formEmbedDropDown = function( med_entry_id ){
          $( "#btncopy" ).click(function () {
            if ( $( "#frm_code_snipet" ).is( ":hidden" ) ) {
              $( "#frm_code_snipet" ).show( "slow" );
              function html(s) {
                return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
              }
              var line_two =  "\n\
              <script>\n\
                kWidget.thumbEmbed({ \n\
                  'targetId': 'kaltura_player_1437197987', \n\
                  'wid': '_"+KALTURA_PARTNER_ID+"',\n\
                  'uiconf_id' : '"+KALTURA_PARTNER_UI_CONFIG+"',\n\
                  'entry_id' : '"+ $("#myModal").attr("data_id") +"', \n\
                  'flashvars':{ \n\
                    'autoPlay': false \n\
                  },\n\
                  'params':{ \n\
                    'wmode': 'transparent' \n\
                  } \n\
                });\n\
             <\/script>";

              var in_embed_code = document.getElementById('frm_emebed_code').innerHTML + line_two;
              var quineHtml = html(in_embed_code);
              quineHtml = quineHtml.replace(
                /&lt;script src[\s\S]*?&gt;&lt;\/script&gt;|&lt;!--\?[\s\S]*?--&gt;|&lt;pre\b[\s\S]*?&lt;\/pre&gt;/g,
                '<span class="operative">$&</span>');
              document.getElementById("quine").innerHTML = quineHtml;
            } else {
              $( "#frm_code_snipet" ).hide( "slow" );
            }
          });
        };
