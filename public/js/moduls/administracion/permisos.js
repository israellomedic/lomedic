require(['datatables', 'backbone', 'marionette'],
    function(datatables, Backbone, marionette) {

        require([                    
                    'models/administracion/ModelPermisos',
                    'views/administracion/ViewPermisos',
                    'controllers/administracion/ControllerPermisos'
                ], 
            function(model, view, controller){

                var admin = new AdministracionController({name: ''});
                    admin.mostrarEnConsola();
                    admin.mostrarCollView();

        });

});