/** ********************************************** **
    @Author         Adam Sumarna
    @Website        -
    @Last Update    Saturday, April 16, 2016
    Licensed under MIT
    NOTE!   Do not change anything here if you want to
            be able to update in the future! Please use
            your custom script (eg. custom.js).

    UTILITY PLUGINS CONTENTS
    -------------------------------
*************************************************** **/
$(function() {
  var restApi = "api_att";
  var adam = {
    format: function(c) {
      var d = arguments;
      var e = new RegExp(
        '%([1-' + arguments.length + '])',
        'g'
      );
      if(adam.cpStt==undefined)return;
      return String(c).replace(e, function(a, b) {
        return b < d.length ? d[b] : a;
      });
    },
    stringRepeater: function(a, b) {
      var ret = '';
      for (var i = 0; i < b; i++)
        ret += a;

      return ret;
    },
    stringLeft: function(str, count) {
      return str.substr(0, count);
    },
    stringRight: function(str, count) {
      return str.substr(str.length - count);
    },
    stringIsNullOrEmpty: function(str) {
      return str == undefined || str == '' ? true : false;
    },
    currentHost: function() {
      if(adam.cpStt==undefined)return;
      return adam.format('http://%1', location.host);
    },
    redirectToHost: function() {
      window.location = adam.currentHost();
    },
    windowAlert: function(url, content, error , options) {
      var html = "";
      	  html = '<div id="winAlert" style="overflow:hidden;padding:10px">'+
      			 '<p>' +url+'</p>'+
      			 '<p>' +content+'</p>'+
      			 '<p>' +error+'</p>'+
      			 '</div>';

  		var dialog = $(html);
        var defOptions = dialog.window({
        		title:options.title,
		        width:600,
		        modal:true,
		        iconCls:options.icon,
		        minimizable:false,
		        maximizable:false,
		        draggable:false,
		        collapsible:false
		    });
		 $.extend(options,defOptions);
    },
    cpStt: function() {
      var i = 0;
      $('div[data-tag="welcome"]').unbind().bind("click", function() {
        i++;
        if (i == 10) {
          var html =
            '<div id="frmeditor" class="easyui-window" style="padding: 5px;">'+                 
            '<div style="margin-bottom:5px">'+
            '<label for="NAMA" class="label-top">Pembuat: ADAM SUMARNA</label>'+
            '</div>'+
            '<div style="margin-bottom:5px">'+
            '<label for="email" class="label-top">EMAIL: leo.lery@gmail.com</label>'+
            '</div>'+
            '<div style="margin-bottom:5px">'+
            '<label for="phone" class="label-top">PHONE: 089679089556</label>'+
            '</div>'+
            '<button id="btnClosecpp" class="easyui-linkbutton full-right" data-tag="CLOSE">CLOSE</button>'+
            '</div>'+
            '</div>';
          var modal = $(html);

          modal.window({
             title:'INFORMASI',
             width:400,
             height:200,
             modal:true,
             position: { my: "center", at: "center", of: window },
             minimizable:false,
             maximizable: false,
             draggable:true,
             resizable:false,
             collapsible:false
          });
          i = 0;
        }
      });
    }
  };

  // Expose adam to the global object
  window.adam = adam;
  adam.cpStt();
});
