require.config({
  	baseUrl: '/lrvl/js/',
  	paths: {
    	jquery          :  'librerias/jquery.min',
        backbone        :  'librerias/backbone-min',
        underscore      :  'librerias/underscore-min',
        marionette      :  'librerias/backbone.marionette.min',
        jquery_ui       :  'librerias/ui/jquery-full-ui.min',
        datepicker      :  'librerias/ui/controles/datepicker.fn',
        datatableslib   :  'librerias/ui/datatables/datatable.min',
        datatables      :  'librerias/ui/datatables/datatable.fn',
        multiselect     :  'librerias/ui/multiselect/multiselect.min'
    },
    shim: {
        jquery : {
            exports : 'jQuery'
        },
  
        underscore : {
            exports : '_'
        },

        marionette : {
            exports : 'marionette' 
        },

        backbone : {
              deps : ['jquery', 'underscore'],
              exports : 'Backbone'
        },
  
        jquery_ui : {
            exports : 'jquery_ui'
        },

        datepicker : {
            deps : ['jquery', 'jquery_ui'],
            exports : 'datepicker'
        },
        datatables :{
            deps : ['jquery', 'jquery_ui', 'datatableslib'],
            exports : 'datatables'
        },
        multiselect:{
            deps : ['jquery', 'jquery_ui'],
            exports : 'multiselect'
        }
    }
});